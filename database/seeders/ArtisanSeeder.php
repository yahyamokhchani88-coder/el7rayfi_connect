<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ArtisanSeeder extends Seeder
{
    public function run(): void
    {
        $services = Service::all();
        $cities = City::all();

        if ($services->isEmpty() || $cities->isEmpty()) {
            $this->command->error("خاصك تعمر المهن والمدن هما الأولين!");
            return;
        }

        $prefixes = ['المعلم', 'حريفي', 'خدمات', 'مقاولة', 'ورشة'];
        $names = ['أحمد', 'ياسين', 'عمر', 'إدريس', 'حمزة', 'مراد', 'سعيد', 'يوسف', 'أنس', 'إسماعيل'];

        $this->command->info("جاري إنشاء حريفي لكل مدينة (تقريباً " . $cities->count() . " حريفي)...");

        foreach ($cities as $city) {
            // نختارو سمية عشوائية
            $randomName = $prefixes[array_rand($prefixes)] . ' ' . $names[array_rand($names)];
            $service = $services->random();
            
            // نكرييو الحريفي
            User::create([
                'name' => $randomName . ' (' . $service->name . ')',
                'email' => Str::slug($randomName) . '.' . Str::slug($city->name) . rand(1, 999) . '@7rayfi.com',
                'password' => Hash::make('password123'),
                'phone' => '06' . rand(11111111, 99999999),
                'role' => 'artisan',
                'city' => $city->name,
                'service_id' => $service->id,
            ]);
        }
        
        $this->command->info("تم إنشاء " . $cities->count() . " حريفية بنجاح!");
    }
}