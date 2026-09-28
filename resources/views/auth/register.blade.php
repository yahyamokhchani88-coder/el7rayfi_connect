<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>إنشاء حساب - 7rayfi Connect</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background-color: #020617; font-family: 'Tajawal', sans-serif; margin: 0; overflow-x: hidden; }
        .auth-visual { background: linear-gradient(135deg, #0f172a 0%, #020617 100%); position: relative; overflow: hidden; }
        .orb { position: absolute; width: 600px; height: 600px; background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, transparent 70%); filter: blur(100px); animation: move 25s infinite alternate; }
        @keyframes move { from { transform: translate(-10%, -10%); } to { transform: translate(20%, 20%); } }
        
        .glass-input { background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08); backdrop-filter: blur(10px); color: white; transition: 0.3s; }
        .glass-input:focus { border-color: #6366f1; background: rgba(255, 255, 255, 0.07); box-shadow: 0 0 20px rgba(99, 102, 241, 0.2); outline: none; }
        
        .role-btn { flex: 1; padding: 15px; border-radius: 18px; font-weight: 900; transition: 0.4s; border: 1px solid rgba(255,255,255,0.05); color: #64748b; cursor: pointer; }
        .role-btn.active { background: rgba(99, 102, 241, 0.1); border-color: #6366f1; color: white; box-shadow: 0 0 20px rgba(99, 102, 241, 0.2); }
        
        .btn-neon { background: linear-gradient(90deg, #6366f1, #a855f7); color: white; font-weight: 900; transition: 0.3s; box-shadow: 0 0 20px rgba(99, 102, 241, 0.4); }
        .btn-neon:hover { transform: translateY(-2px); box-shadow: 0 0 35px rgba(99, 102, 241, 0.6); }
        
        #artisan-fields { display: none; }
        .grid-2 { display: grid; grid-template-cols: 1fr 1fr; gap: 15px; }
    </style>
</head>
<body>
    <div class="flex min-h-screen">
        
        <!-- 1. الجهة البصرية (Visual Side) - Desktop -->
        <div class="hidden lg:flex lg:w-1/3 auth-visual flex-col justify-center items-center p-12 text-right">
            <div class="orb" style="top: 0; right: 0;"></div>
            <div class="orb" style="bottom: 0; left: 0; background: radial-gradient(circle, rgba(251, 191, 36, 0.05) 0%, transparent 70%);"></div>
            
            <div class="relative z-10 max-w-sm">
                <h1 class="text-6xl font-black text-white mb-6 leading-tight italic">
                    ابدأ <br> <span class="text-indigo-500">مغامرتك</span> <br> اليوم.
                </h1>
                <p class="text-slate-400 text-lg font-medium">سواء كنت حريفي باغي تخدم أو زبون كايقلب على الجودة، بلاصتك هنا.</p>
            </div>
        </div>

        <!-- 2. جهة الفورم (Form Side) -->
        <div class="w-full lg:w-2/3 bg-[#020617] flex items-center justify-center p-8 relative overflow-hidden">
            <div class="w-full max-w-2xl z-10">
                
                <!-- Header -->
                <div class="flex justify-between items-center mb-10">
                    <a href="/" class="text-xl font-black italic text-white flex items-center gap-2">
                        <span class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center not-italic text-sm">7</span>
                        7rayfi Connect
                    </a>
                    <p class="text-slate-500 text-sm font-bold">عندك حساب؟ <a href="{{ route('login') }}" class="text-indigo-500 hover:text-white transition-colors">دخل من هنا</a></p>
                </div>

                <h2 class="text-4xl font-black text-white mb-8 italic">إنشاء حساب جديد..</h2>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Role Selector -->
                    <div class="flex gap-4 mb-8">
                        <button type="button" id="btn-client" class="role-btn active" onclick="switchRole('client')">👤 أنا زبون</button>
                        <button type="button" id="btn-artisan" class="role-btn" onclick="switchRole('artisan')">🛠️ أنا حريفي</button>
                        <input type="hidden" name="role" id="role-input" value="client">
                    </div>

                    <!-- Name & Phone -->
                    <div class="grid-2">
                        <div>
                            <label id="label-name" class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 mr-2">الإسم الكامل</label>
                            <input type="text" name="name" value="{{ old('name') }}" required 
                                   class="w-full glass-input rounded-2xl p-4 font-bold placeholder-slate-700" placeholder="محمد العلمي">
                            @error('name') <p class="text-red-500 text-[10px] mt-1 mr-2">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 mr-2">رقم الهاتف</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" required 
                                   class="w-full glass-input rounded-2xl p-4 font-bold placeholder-slate-700 text-left" dir="ltr" placeholder="06XXXXXXXX">
                            @error('phone') <p class="text-red-500 text-[10px] mt-1 mr-2">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 mr-2">البريد الإلكتروني</label>
                        <input type="email" name="email" value="{{ old('email') }}" required 
                               class="w-full glass-input rounded-2xl p-4 font-bold placeholder-slate-700" placeholder="email@example.com">
                        @error('email') <p class="text-red-500 text-[10px] mt-1 mr-2">{{ $message }}</p> @enderror
                    </div>

                    <!-- Artisan Specific Fields (Dynamic) -->
                    <div id="artisan-fields" class="p-6 rounded-3xl bg-indigo-600/5 border border-indigo-500/20 space-y-6">
                        <p class="text-indigo-400 text-xs font-black uppercase tracking-widest">معلومات الحرفة والمدينة:</p>
                        <div class="grid-2">
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 mb-2 mr-2">شنو هي حرفتك؟</label>
                                <select name="service_id" id="service_select" class="w-full glass-input rounded-xl p-4 font-bold appearance-none">
                                    <option value="" class="bg-slate-900">-- اختر الحرفة --</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" class="bg-slate-900">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 mb-2 mr-2">المدينة</label>
                                <select name="city" id="city_select" class="w-full glass-input rounded-xl p-4 font-bold appearance-none">
                                    <option value="" class="bg-slate-900">-- اختر المدينة --</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->name }}" class="bg-slate-900">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Passwords -->
                    <div class="grid-2">
                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 mr-2">كلمة المرور</label>
                            <input type="password" name="password" required 
                                   class="w-full glass-input rounded-2xl p-4 font-bold" placeholder="••••••••">
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 mr-2">تأكيد كلمة المرور</label>
                            <input type="password" name="password_confirmation" required 
                                   class="w-full glass-input rounded-2xl p-4 font-bold" placeholder="••••••••">
                        </div>
                    </div>
                    @error('password') <p class="text-red-500 text-[10px] mt-1 mr-2">{{ $message }}</p> @enderror

                    <!-- Submit -->
                    <button type="submit" class="w-full btn-neon py-5 rounded-2xl text-xl font-black flex items-center justify-center gap-3 active:scale-95 mt-4">
                        <span>إنشاء الحساب الآن</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

    </div>

    <script>
        function switchRole(role) {
            const artisanFields = document.getElementById('artisan-fields');
            const roleInput = document.getElementById('role-input');
            const btnClient = document.getElementById('btn-client');
            const btnArtisan = document.getElementById('btn-artisan');
            const labelName = document.getElementById('label-name');
            const serviceSelect = document.getElementById('service_select');
            const citySelect = document.getElementById('city_select');

            roleInput.value = role;

            if (role === 'artisan') {
                artisanFields.style.display = 'block';
                btnArtisan.classList.add('active');
                btnClient.classList.remove('active');
                labelName.innerText = 'إسم الحرفة / المقاولة';
                serviceSelect.required = true;
                citySelect.required = true;
            } else {
                artisanFields.style.display = 'none';
                btnClient.classList.add('active');
                btnArtisan.classList.remove('active');
                labelName.innerText = 'الإسم الكامل';
                serviceSelect.required = false;
                citySelect.required = false;
            }
        }
    </script>
</body>
</html>