<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        
$services = [
    ['name' => 'سباكة', 'description' => 'إصلاح التسربات، تركيب الأدوات الصحية وتسليك المجاري.', 'icon' => 'tap'],
    ['name' => 'كهرباء', 'description' => 'إصلاح الأعطال، تركيب المقابس واللوحات الكهربائية.', 'icon' => 'bolt'],
    ['name' => 'صباغة', 'description' => 'تجديد الجدران، الديكور والأسقف المستعارة.', 'icon' => 'paint-roller'],
    ['name' => 'نجارة', 'description' => 'صناعة وإصلاح الأثاث الخشبي أو الألمنيوم.', 'icon' => 'hammer'],
    ['name' => 'تكييف', 'description' => 'تركيب وصيانة أنظمة التكييف والتبريد.', 'icon' => 'snowflake'],
    ['name' => 'تنظيف', 'description' => 'خدمات التنظيف المنزلي وتنظيف ما بعد الأشغال.', 'icon' => 'broom'],
    ['name' => 'حدادة', 'description' => 'تصنيع وإصلاح الأبواب والنوافذ والهياكل الحديدية.', 'icon' => 'tools'],
    ['name' => 'زليج', 'description' => 'تركيب الزليج والسيراميك باحترافية.', 'icon' => 'th-large'],
    ['name' => 'جبص', 'description' => 'ديكورات الجبس والأسقف العصرية والتشطيبات.', 'icon' => 'border-style'],
    ['name' => 'لحام', 'description' => 'أعمال التلحيم وصيانة القطع المعدنية.', 'icon' => 'fire'],
    ['name' => 'ميكانيك', 'description' => 'إصلاح وصيانة السيارات والدراجات.', 'icon' => 'car'],
    ['name' => 'كهرباء السيارات', 'description' => 'تشخيص وإصلاح أعطال كهرباء السيارات.', 'icon' => 'car-battery'],
    ['name' => 'إصلاح الهواتف', 'description' => 'صيانة الهواتف الذكية وتبديل القطع.', 'icon' => 'mobile-alt'],
    ['name' => 'إصلاح الحواسيب', 'description' => 'إصلاح وصيانة أجهزة الكمبيوتر والشبكات.', 'icon' => 'laptop'],
    ['name' => 'خياطة', 'description' => 'خياطة وتصميم الملابس التقليدية والعصرية.', 'icon' => 'tshirt'],
    ['name' => 'حلاقة', 'description' => 'خدمات الحلاقة والعناية الشخصية.', 'icon' => 'cut'],
    ['name' => 'تجميل', 'description' => 'خدمات التجميل والعناية بالبشرة والشعر.', 'icon' => 'spa'],
    ['name' => 'طبخ', 'description' => 'خدمات الطبخ وتحضير المناسبات.', 'icon' => 'utensils'],
    ['name' => 'حلويات', 'description' => 'تحضير الحلويات والكيكات المنزلية.', 'icon' => 'birthday-cake'],
    ['name' => 'بستنة', 'description' => 'تنسيق الحدائق والعناية بالنباتات.', 'icon' => 'leaf'],
    ['name' => 'حراسة', 'description' => 'خدمات الأمن والحراسة للمنازل والشركات.', 'icon' => 'shield-alt'],
    ['name' => 'نقل الأثاث', 'description' => 'خدمات نقل وتوصيل الأثاث والبضائع.', 'icon' => 'truck'],
    ['name' => 'تصوير', 'description' => 'تصوير المناسبات والمنتجات باحترافية.', 'icon' => 'camera'],
    ['name' => 'تصميم غرافيك', 'description' => 'تصميم الشعارات والمنشورات والإعلانات.', 'icon' => 'palette'],
    ['name' => 'برمجة', 'description' => 'تطوير المواقع والتطبيقات والأنظمة.', 'icon' => 'code'],
    ['name' => 'تسويق رقمي', 'description' => 'إدارة الحملات الإعلانية وصفحات التواصل.', 'icon' => 'bullhorn'],
];


        foreach ($services as $service) {
            Service::create([
                'name' => $service['name'],
                'description' => $service['description'],
                'icon' => $service['icon'],
                'slug' => Str::slug($service['name']),
            ]);
        }
    }
}