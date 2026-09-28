<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تأكيد الحساب - 7rayfi Connect</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background-color: #020617; font-family: 'Tajawal', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08); backdrop-filter: blur(20px); }
    </style>
</head>
<body class="flex min-h-screen items-center justify-center px-6">
    <div class="w-full max-w-lg text-center">
        <div class="text-7xl mb-8">📧</div>
        <h2 class="text-4xl font-black text-white mb-6 italic">باقي خطوة واحدة!</h2>
        
        <div class="glass-card rounded-[40px] p-10 text-right">
            <p class="text-slate-400 text-xl leading-relaxed font-bold italic mb-10">
                شكراً على التسجيل! قبل ما تبدا، عافاك فيريفي الإيميل ديالك بالرابط اللي صيفطنا ليك. <br>
                إلى ما وصلك والو، نقدروا نصيفطوه مرة أخرى.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-8 font-bold text-sm text-green-400 bg-green-500/10 p-4 rounded-2xl border border-green-500/20">
                    ✅ صيفطنا ليك رابط جديد للإيميل ديالك.
                </div>
            @endif

            <div class="flex flex-col md:flex-row gap-4">
                <form method="POST" action="{{ route('verification.send') }}" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white py-5 rounded-2xl font-black transition-all">
                        إعادة إرسال الإيميل
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full bg-white/5 hover:bg-white/10 text-slate-400 py-5 rounded-2xl font-bold border border-white/10 transition-all">
                        تسجيل الخروج
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>