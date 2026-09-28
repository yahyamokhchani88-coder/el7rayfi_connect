<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>نسيت كلمة المرور - 7rayfi Connect</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background-color: #020617; font-family: 'Tajawal', sans-serif; margin: 0; }
        .glass-card { background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08); backdrop-filter: blur(20px); }
        .glass-input { background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08); color: white; transition: 0.3s; }
        .glass-input:focus { border-color: #6366f1; background: rgba(255, 255, 255, 0.07); box-shadow: 0 0 20px rgba(99, 102, 241, 0.2); outline: none; }
        .btn-neon { background: linear-gradient(90deg, #6366f1, #a855f7); color: white; font-weight: 900; transition: 0.3s; }
    </style>
</head>
<body class="flex min-h-screen items-center justify-center px-6">
    <div class="w-full max-w-md">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-black text-white italic">نسيتي المودباس؟ 🔑</h2>
            <p class="text-slate-500 mt-4 font-bold italic">ماشي مشكل! دخل الإيميل ديالك ونصيفطو ليك رابط باش تبدلو.</p>
        </div>

        <div class="glass-card rounded-[40px] p-10">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-green-400 font-bold text-sm" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 mr-2 italic">البريد الإلكتروني</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                           class="w-full glass-input rounded-2xl p-5 font-bold placeholder-slate-700" placeholder="your@email.com">
                    @error('email') <p class="text-red-500 text-[10px] mt-2 mr-2">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full btn-neon py-5 rounded-2xl text-lg font-black active:scale-95 shadow-lg shadow-indigo-500/20">
                    صيفط ليا رابط التغيير
                </button>
            </form>
        </div>
        <div class="mt-8 text-center">
            <a href="{{ route('login') }}" class="text-slate-500 font-bold hover:text-white transition-colors underline underline-offset-8">رجوع لتسجيل الدخول</a>
        </div>
    </div>
</body>
</html>