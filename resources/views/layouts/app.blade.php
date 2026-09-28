<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>7rayfi Connect</title>

    <!-- Fonts - Tajawal -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root { --primary: #6366f1; --accent: #fbbf24; --dark: #020617; }
        body { background-color: var(--dark); font-family: 'Tajawal', sans-serif; color: #fff; overflow-x: hidden; }
        
        /* Mesh Gradient Background */
        .mesh-bg {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at 15% 15%, rgba(99, 102, 241, 0.1) 0%, transparent 40%),
                        radial-gradient(circle at 85% 85%, rgba(251, 191, 36, 0.05) 0%, transparent 40%);
            z-index: -1; filter: blur(80px);
        }
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--dark); }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary); }
    </style>
</head>
<body class="antialiased">
    <div class="mesh-bg"></div>

    <div class="min-h-screen">
        <!-- Navbar Component -->
        <x-navbar />

        <!-- Page Content -->
        <main class="pt-24">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="py-12 border-t border-white/5 mt-20 opacity-50 text-center">
            <p class="text-sm font-bold italic">7rayfi Connect &copy; 2024 - كولشي محفظ</p>
        </footer>
    </div>

    <!-- Flash Messages (Success) -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" 
             class="fixed bottom-10 right-10 z-[200] bg-indigo-600 text-white px-8 py-4 rounded-2xl font-black shadow-2xl border border-white/10 animate-bounce">
            <span>✅ {{ session('success') }}</span>
        </div>
    @endif
    <!-- Notification Sound -->
<audio id="notif-sound" src="{{ asset('sounds/Chord - Apple iOS 7 Notification Sound.mp3') }}" preload="auto"></audio>

<script>
    function playNotifSound() {
        var sound = document.getElementById('notif-sound');
        sound.play().catch(function(error) {
            console.log("Browser blocked autoplay, waiting for interaction.");
        });
    }

    let lastNotifCount = {{ auth()->check() ? auth()->user()->unreadNotifications->count() : 0 }};

    setInterval(function() {
        fetch('/api/notifications/count') // خاصنا نكرييو هاد الـ Route
            .then(response => response.json())
            .then(data => {
                if (data.count > lastNotifCount) {
                    playNotifSound();
                    // تحديث العدد فـ الجرس (UI) بـ JavaScript
                    lastNotifCount = data.count;
                }
            });
    }, 10000); // كايقلب كل 10 ثواني
</script>
</body>
</html>