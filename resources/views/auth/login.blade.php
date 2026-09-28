<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>دخول - 7rayfi Connect</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background-color: #020617; font-family: 'Tajawal', sans-serif; margin: 0; overflow-x: hidden; }
        .auth-visual { background: linear-gradient(135deg, #0f172a 0%, #020617 100%); position: relative; overflow: hidden; }
        .orb { position: absolute; width: 500px; height: 500px; background: radial-gradient(circle, rgba(99, 102, 241, 0.2) 0%, transparent 70%); filter: blur(80px); animation: move 20s infinite alternate; }
        @keyframes move { from { transform: translate(-10%, -10%); } to { transform: translate(20%, 20%); } }
        .glass-input { background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08); backdrop-filter: blur(10px); color: white; transition: 0.3s; }
        .glass-input:focus { border-color: #6366f1; background: rgba(255, 255, 255, 0.07); box-shadow: 0 0 20px rgba(99, 102, 241, 0.2); outline: none; }
        .btn-neon { background: linear-gradient(90deg, #6366f1, #a855f7); color: white; font-weight: 900; transition: 0.3s; box-shadow: 0 0 20px rgba(99, 102, 241, 0.4); }
        .btn-neon:hover { transform: translateY(-2px); box-shadow: 0 0 35px rgba(99, 102, 241, 0.6); }
    </style>
</head>
<body>
    <div class="flex min-h-screen">
        
        <!-- 1. الجهة البصرية (Visual Side) - Desktop Only -->
        <div class="hidden lg:flex lg:w-1/2 auth-visual flex-col justify-center items-center p-12 text-right">
            <div class="orb" style="top: 0; right: 0;"></div>
            <div class="orb" style="bottom: 0; left: 0; background: radial-gradient(circle, rgba(251, 191, 36, 0.05) 0%, transparent 70%);"></div>
            
            <div class="relative z-10 max-w-md">
                <h1 class="text-7xl font-black text-white mb-6 leading-tight italic">
                    مرحباً <br> فـ <span class="text-indigo-500">مستقبل</span> <br> الحرفة.
                </h1>
                <p class="text-slate-400 text-xl font-medium">انضم لأول منصة مغربية ذكية كتربط الحريفية بالزبناء فـ دقة وحدة.</p>
            </div>
        </div>

        <!-- 2. جهة الفورم (Form Side) -->
        <div class="w-full lg:w-1/2 bg-[#020617] flex items-center justify-center p-8 relative overflow-hidden">
            <div class="w-full max-w-md z-10">
                <!-- Header -->
                <div class="mb-12">
                    <a href="/" class="text-2xl font-black italic text-white flex items-center gap-2 mb-8">
                        <span class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center not-italic">7</span>
                        7rayfi <span class="text-indigo-500">Connect</span>
                    </a>
                    <h2 class="text-4xl font-black text-white mb-2 italic">سجل دخولك..</h2>
                    <p class="text-slate-500 font-bold italic">توحشناك! دخل المعلومات ديالك</p>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 mr-2">البريد الإلكتروني</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                               class="w-full glass-input rounded-2xl p-5 font-bold placeholder-slate-600" 
                               placeholder="your@email.com">
                        @error('email') <p class="text-red-500 text-xs mt-2 mr-2">{{ $message }}</p> @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex justify-between items-center mb-2 px-2">
                            <label class="text-xs font-black text-slate-500 uppercase tracking-widest">كلمة المرور</label>
                            <a href="{{ route('password.request') }}" class="text-[10px] font-black text-indigo-500 hover:text-white transition-colors">نسيتيها؟</a>
                        </div>
                        <input type="password" name="password" required 
                               class="w-full glass-input rounded-2xl p-5 font-bold placeholder-slate-600" 
                               placeholder="••••••••">
                        @error('password') <p class="text-red-500 text-xs mt-2 mr-2">{{ $message }}</p> @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center px-2">
                        <label class="flex items-center cursor-pointer group">
                            <input type="checkbox" name="remember" class="w-5 h-5 rounded-lg bg-white/5 border-white/10 text-indigo-600 focus:ring-0">
                            <span class="mr-3 text-sm font-bold text-slate-500 group-hover:text-slate-300 transition-colors italic">بقيني متصل</span>
                        </label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="w-full btn-neon py-5 rounded-2xl text-xl flex items-center justify-center gap-3 active:scale-95">
                        <span>دخول للحساب</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
                        </svg>
                    </button>
                </form>

                <!-- Footer -->
                <div class="mt-12 text-center">
                    <p class="text-slate-500 font-bold italic">
                        جديد معانا؟ 
                        <a href="{{ route('register') }}" class="text-white hover:text-indigo-400 transition-colors underline underline-offset-8 decoration-indigo-500 decoration-2">سجل حسابك دابا</a>
                    </p>
                </div>
            </div>
        </div>

    </div>
</body>
</html>