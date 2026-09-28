<?php

namespace App\Http\Controllers;

use App\Models\JobRequest;
use App\Models\Service;
use App\Models\City;
use Illuminate\Http\Request;
use App\Notifications\NewJobAvailable;
use App\Models\User;

// داخل الدالة store وبعد JobRequest::create

class JobController extends Controller
{
   

    // عرض صفحة إنشاء طلب جديد
    public function create()
    {
        $services = Service::all();
        $cities = City::all();
        return view('jobs.create', compact('services', 'cities'));
    }

    // تسجيل الطلب فـ la base
    public function store(Request $request)
{
    $request->validate([
        'service_id' => 'required|exists:services,id',
        'city' => 'required|string',
        'description' => 'required|string|min:20',
        'min_price' => 'required|numeric',
        'max_price' => 'required|numeric|gt:min_price',
        'lat' => 'nullable|numeric',
        'lng' => 'nullable|numeric',
    ]);

    // 1. هنا سمينا المتغير $job
    $job = JobRequest::create([
        'client_id' => auth()->id(),
        'service_id' => $request->service_id,
        'city' => $request->city,
        'description' => $request->description,
        'min_price' => $request->min_price,
        'max_price' => $request->max_price,
        'lat' => $request->lat,
        'lng' => $request->lng,
        'status' => 'open',
    ]);

    // 2. كنجبدو الحريفية لي فـ نفس المدينة والحرفة
    $artisans = \App\Models\User::where('role', 'artisan')
                    ->where('city', $request->city)
                    ->where('service_id', $request->service_id)
                    ->get();

    // 3. هنا كنصيفطو الإشعار ونستعملو نفس المتغير $job
    foreach ($artisans as $artisan) {
        $artisan->notify(new \App\Notifications\NewJobAvailable($job));
    }

    return redirect()->route('jobs.my-jobs')->with('success', 'تم نشر طلبك بنجاح! انتظر عروض الحريفية.');
}

    

    // عرض الطلبات الخاصة بالزبون باش يشوف المزايدات (Bids)
    public function myJobs()
    {
        $myJobs = JobRequest::where('client_id', auth()->id())
            ->with(['bids.artisan', 'service'])
            ->latest()
            ->get();
            
        return view('jobs.my-jobs', compact('myJobs'));
    }
}