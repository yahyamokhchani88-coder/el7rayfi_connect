<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>حط طلبك - 7rayfi Connect</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background-color: #020617; font-family: 'Tajawal', sans-serif; color: white; }
        .glass-card { background: rgba(255, 255, 255, 0.02); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .step-indicator { transition: all 0.5s ease; }
        .step-active { background: #6366f1; width: 40px; box-shadow: 0 0 15px rgba(99, 102, 241, 0.5); }
        .input-glass { background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); outline: none; transition: 0.3s; }
        .input-glass:focus { border-color: #6366f1; box-shadow: 0 0 20px rgba(99, 102, 241, 0.2); }
        #map { height: 350px; border-radius: 24px; border: 2px solid rgba(255,255,255,0.05); }
    </style>
</head>
<body x-data="{ 
    step: 1, 
    service: '', 
    minPrice: '', 
    maxPrice: '',
    description: '' 
}">
    <x-navbar />

    <div class="relative min-h-screen pt-32 pb-20 px-6 overflow-hidden">
        <!-- Background Glows -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-600/10 rounded-full blur-[120px] -z-10"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-amber-500/5 rounded-full blur-[120px] -z-10"></div>

        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-5xl font-black italic mb-4">حط طلبك <span class="text-indigo-500">دابا..</span></h1>
                <p class="text-slate-400 font-bold italic">شرح لينا شنو محتاج، وحدد ميزانيتك، وخلي الحريفية يتنافسو عليك!</p>
            </div>

            <!-- Steps Indicators -->
            <div class="flex justify-center gap-3 mb-12">
                <div class="h-2 rounded-full bg-white/10 step-indicator" :class="step >= 1 ? 'step-active' : 'w-8'"></div>
                <div class="h-2 rounded-full bg-white/10 step-indicator" :class="step >= 2 ? 'step-active' : 'w-8'"></div>
                <div class="h-2 rounded-full bg-white/10 step-indicator" :class="step >= 3 ? 'step-active' : 'w-8'"></div>
            </div>

            <form action="{{ route('jobs.store') }}" method="POST">
                @csrf
                <input type="hidden" name="lat" id="lat">
                <input type="hidden" name="lng" id="lng">

                <!-- STEP 1: Service Selection -->
                <div x-show="step === 1" x-transition class="space-y-8">
                    <div class="glass-card rounded-[40px] p-10">
                        <label class="block text-amber-500 font-black mb-4 mr-2 italic">شنو نوع الخدمة اللي محتاج؟</label>
                        <select name="service_id" x-model="service" class="w-full input-glass rounded-2xl p-5 text-2xl font-black text-white appearance-none cursor-pointer">
                            <option value="">-- اختر الحرفة --</option>
                            @foreach($services as $s)
                                <option value="{{ $s->id }}" class="bg-slate-900">{{ $s->name }}</option>
                            @endforeach
                        </select>
                        
                        <label class="block text-amber-500 font-black mt-8 mb-4 mr-2 italic">فـ أي مدينة؟</label>
                        <select name="city" class="w-full input-glass rounded-2xl p-5 text-xl font-bold text-white appearance-none cursor-pointer">
                            @foreach($cities as $c)
                                <option value="{{ $c->name }}" {{ auth()->user()->city == $c->name ? 'selected' : '' }} class="bg-slate-900">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" @click="step = 2" :disabled="!service" class="w-full bg-indigo-600 hover:bg-indigo-500 py-6 rounded-3xl font-black text-xl shadow-xl transition-all disabled:opacity-30">
                        المرحلة التالية ⚡
                    </button>
                </div>

                <!-- STEP 2: Budget & Details -->
                <div x-show="step === 2" x-transition class="space-y-8">
                    <div class="glass-card rounded-[40px] p-10">
                        <div class="grid grid-cols-2 gap-6 mb-8">
                            <div>
                                <label class="block text-indigo-400 font-black mb-3 italic">أقل ثمن (DH)</label>
                                <input type="number" name="min_price" x-model="minPrice" placeholder="100" class="w-full input-glass rounded-2xl p-5 font-black text-2xl">
                            </div>
                            <div>
                                <label class="block text-indigo-400 font-black mb-3 italic">أكثر ثمن (DH)</label>
                                <input type="number" name="max_price" x-model="maxPrice" placeholder="500" class="w-full input-glass rounded-2xl p-5 font-black text-2xl">
                            </div>
                        </div>
                        <label class="block text-indigo-400 font-black mb-3 italic">شرح لينا المشكل بالتفصيل</label>
                        <textarea name="description" x-model="description" rows="4" class="w-full input-glass rounded-3xl p-6 font-medium text-lg" placeholder="مثلاً: عندي تسرب فـ المطبخ ومحتاج إصلاح سريع..."></textarea>
                    </div>
                    <div class="flex gap-4">
                        <button type="button" @click="step = 1" class="flex-1 bg-white/5 border border-white/10 py-6 rounded-3xl font-bold italic">رجوع</button>
                        <button type="button" @click="step = 3" :disabled="!minPrice || !description" class="flex-[2] bg-indigo-600 hover:bg-indigo-500 py-6 rounded-3xl font-black text-xl shadow-xl transition-all">آخر مرحلة 🚀</button>
                    </div>
                </div>

                <!-- STEP 3: Map Localization -->
                <!-- STEP 3: الموقع (تعديل) -->
<div x-show="step === 3" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-x-10">
    <h2 class="text-5xl font-black text-white mb-4 italic">فين <span class="text-green-500">كاين؟</span></h2>
    <p class="text-slate-400 mb-10">غادي نحتاجو موقعك باش يوصلك الحريفي لي قريب ليك دقة وحدة.</p>

    <div class="glass-dark p-10 rounded-[40px] border-white/10 mb-8 text-center">
        <div id="location-status" class="mb-6">
            <div class="w-20 h-20 bg-green-500/10 text-green-500 rounded-full flex items-center justify-center text-4xl mx-auto mb-4 border border-green-500/20">
                📍
            </div>
            <p class="text-white font-bold italic">كليكي باش نحددوا موقعك أوتوماتيكياً</p>
        </div>

        <!-- بوطون تحديد الموقع -->
        <button type="button" onclick="getLocation()" id="btn-location" class="bg-white/5 hover:bg-white/10 text-white px-8 py-4 rounded-2xl font-black border border-white/10 transition-all flex items-center justify-center gap-3 mx-auto">
            <span>تحديد موقعي دابا</span>
            <div id="loader" class="hidden w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
        </button>

        <!-- Hidden Inputs اللي غايتعمرو بالـ GPS -->
        <input type="hidden" name="lat" id="lat">
        <input type="hidden" name="lng" id="lng">
    </div>

    <div class="flex gap-4">
        <button type="button" @click="step = 2" class="flex-1 bg-white/5 text-white py-6 rounded-3xl font-bold border border-white/10">رجع للور</button>
        <button type="submit" id="submit-job" disabled class="flex-[2] bg-amber-500 text-slate-900 py-6 rounded-3xl font-black text-2xl shadow-xl shadow-amber-500/20 opacity-30 cursor-not-allowed transition-all">
            تأكيد ونشر الطلب 🔥
        </button>
    </div>
</div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
    function getLocation() {
        const btn = document.getElementById('btn-location');
        const loader = document.getElementById('loader');
        const statusText = document.querySelector('#location-status p');
        const submitBtn = document.getElementById('submit-job');

        // تبديل الواجهة لـ "جاري البحث"
        loader.classList.remove('hidden');
        btn.disabled = true;
        statusText.innerText = "جاري تحديد موقعك... عافاك وافق على الطلب";

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                // نجاح العملية
                function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    // حط القيم فـ الخانات
                    document.getElementById('lat').value = lat;
                    document.getElementById('lng').value = lng;

                    // تحديث الواجهة
                    loader.classList.add('hidden');
                    statusText.innerHTML = "<span class='text-green-500'>✅ تم تحديد موقعك بنجاح!</span>";
                    btn.classList.add('bg-green-500/20', 'text-green-500', 'border-green-500/30');
                    btn.innerText = "تم التحديد";
                    
                    // تفعيل بوطون النشر
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-30', 'cursor-not-allowed');
                },
                // فشل العملية (مثلا الزبون رفض GPS)
                function(error) {
                    loader.classList.add('hidden');
                    btn.disabled = false;
                    statusText.innerHTML = "<span class='text-red-500'>❌ وقع مشكل! حاول تفتح الـ GPS فـ تيليفونك.</span>";
                    alert("عافاك خاصك توافق على الـ GPS باش الحريفي يلقاك.");
                },
                { enableHighAccuracy: true } // دقة عالية
            );
        } else {
            alert("المتصفح ديالك ما كيدعمش الـ GPS.");
        }
    }
</script>
</body>
</html>