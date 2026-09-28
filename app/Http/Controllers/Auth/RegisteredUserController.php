<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service; // تأكد من هادي
use App\Models\City;    // وتأكد من هادي
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // هنا فين كان المشكل، خاصنا نجبدوهم بجوج ونصيفطوهم
        $services = Service::all();
        $cities = City::all(); 

        return view('auth.register', compact('services', 'cities'));
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string'],
            'role' => ['required', 'in:client,artisan'],
            'service_id' => ['required_if:role,artisan', 'nullable', 'exists:services,id'],
            'city' => ['required_if:role,artisan', 'nullable', 'string'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => $request->role,
            'service_id' => $request->service_id,
            'city' => $request->city,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // التوجيه على حساب الدور
        return $user->role === 'artisan' 
            ? redirect()->intended(route('dashboard')) 
            : redirect('/');
    }
}