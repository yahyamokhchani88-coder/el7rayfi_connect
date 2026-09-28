<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobRequest; // <--- هاد السطر هو لي ناقصك

class DashboardController extends Controller
{
public function index()
{
    $user = auth()->user();

    if ($user->role === 'artisan') {
        // نجبدو الطلبات لي فـ مدينة الحريفي وفـ حرفتو بـ "LIKE" باش نتفاداو مشاكل الهمزة
        $availableJobs = \App\Models\JobRequest::where('status', 'open')
            ->where('service_id', $user->service_id)
            ->where('city', 'LIKE', '%' . trim($user->city) . '%') // كايقلب على السمية وخا تكون ناقصة همزة
            ->latest()
            ->get();

        return view('artisan.dashboard', compact('user', 'availableJobs'));
    }

    return view('dashboard', compact('user'));
}
private function calculateDistance($lat1, $lon1, $lat2, $lng2) {
    if (!$lat1 || !$lon1 || !$lat2 || !$lng2) return null;
    
    $earthRadius = 6371; // بالكيلومتر
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lng2 - $lon1);
    
    $a = sin($dLat/2) * sin($dLat/2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * 
         sin($dLon/2) * sin($dLon/2);
    
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    return round($earthRadius * $c, 1); // كايعطيك المسافة بـ 1.2km مثلاً
}
}
