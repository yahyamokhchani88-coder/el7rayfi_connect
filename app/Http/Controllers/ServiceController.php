<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\City; // <--- هادي ضرورية
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $cities = City::all(); // <--- هادي ضرورية

        return view('welcome', compact('services', 'cities'));
    }
}