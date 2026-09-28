<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تغيير كلمة المرور - 7rayfi Connect</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background-color: #020617; font-family: 'Tajawal', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08); backdrop-filter: blur(20px); }
        .glass-input { background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08); color: white; transition: 0.3s; }
        .btn-neon { background: linear-gradient(90deg, #6366f1, #a855f7); color: white; font-weight: 900; }
    </style>
</head>
<body class="flex min-h-screen items-center justify-center px-6">
    <div class="w-full max-w-md">
        <h2 class="text-4xl font-black text-white mb-10 italic text-center">تغيير المودباس.. ✨</h2>

        <div class="glass-card rounded-[40px] p-10">
            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email (Read Only) -->
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 mr-2">البريد الإلكتروني</label>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" required readonly
                           class="w-full glass-input rounded-2xl p-4 font-bold opacity-50 cursor-not-allowed">
                </div>

                <!-- New Password -->
                <div>
                    <label class="block text-xs font-black text-amber-500 uppercase tracking-widest mb-2 mr-2">المودباس الجديد</label>
                    <input type="password" name="password" required autofocus
                           class="w-full glass-input rounded-2xl p-4 font-bold" placeholder="••••••••">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-xs font-black text-amber-500 uppercase tracking-widest mb-2 mr-2">تأكيد المودباس</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full glass-input rounded-2xl p-4 font-bold" placeholder="••••••••">
                </div>

                <button type="submit" class="w-full btn-neon py-5 rounded-2xl text-xl font-black shadow-xl shadow-indigo-500/20">
                    تحديث كلمة المرور
                </button>
            </form>
        </div>
    </div>
</body>
</html>