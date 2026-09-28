<?php 

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\City;
use Illuminate\Http\Request;

class SearchController extends Controller
{
   public function index(Request $request)
{
    // 1. كنبداو البحث غير فالحريفية
    $query = User::where('role', 'artisan');

    // 2. فيلتر ديال الحرفة (Service)
    if ($request->filled('service')) {
        $query->where('service_id', $request->service);
    }

    // 3. فيلتر ديال المدينة (City)
    if ($request->filled('city')) {
    $cityName = trim($request->city);
    $query->where('city', 'LIKE', '%' . $cityName . '%'); // كايقلب على أي حاجة كتشبه ليها
}

    $artisans = $query->with('service')->get();
    
    // هادو كيبقاو باش نرجعوهم للـ View إذا بغينا نعاودو البحث
    $services = \App\Models\Service::all();
    $cities = \App\Models\City::all();

    return view('search-results', compact('artisans', 'services', 'cities'));
}
public function show($id)
{
    // كنجبدو الحريفي بالـ ID ديالو ومعاه الحرفة ديالو
    $artisan = User::where('role', 'artisan')->with('service')->findOrFail($id);
    
    return view('artisan-profile', compact('artisan'));
}
}