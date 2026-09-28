<nav x-data="{ scrolled: false }" 
     @scroll.window="scrolled = (window.pageYOffset > 20) ? true : false"
     :class="scrolled ? 'bg-slate-950/80 backdrop-blur-xl border-b border-white/10 py-3' : 'bg-transparent py-5'"
     class="fixed top-0 w-full z-[100] transition-all duration-500 px-6">
    
    <div class="max-w-7xl mx-auto flex justify-between items-center" dir="rtl">
        
        <!-- Logo & Main Links -->
        <div class="flex items-center gap-10">
            <a href="/" class="text-2xl font-black italic tracking-tighter text-white group">
                7rayfi <span class="text-indigo-500 group-hover:text-amber-500 transition-colors">Connect</span>
            </a>

            <div class="hidden md:flex items-center gap-8 text-sm font-bold text-slate-400">
                <a href="/" class="hover:text-white transition-colors italic">الرئيسية</a>
                @auth
                    @if(Auth::user()->role === 'client')
                        <a href="{{ route('jobs.create') }}" class="text-amber-500 hover:scale-105 transition-transform flex items-center gap-2">
                            <span class="text-lg">🚀</span> حط طلبك
                        </a>
                        <a href="{{ route('jobs.my-jobs') }}" class="hover:text-white transition-colors italic">طلباتي</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors italic">لوحة التحكم</a>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Auth Actions -->
        <div class="flex items-center gap-4">
            @auth
                <div class="flex items-center gap-3 bg-white/5 p-1 pr-4 rounded-2xl border border-white/10">
                    <div class="text-right hidden sm:block">
                        <p class="text-[10px] font-black text-slate-500 leading-none">مرحباً بك</p>
                        <p class="text-xs font-bold text-white italic">{{ Auth::user()->name }}</p>
                    </div>
                    @auth
<!-- Notification Dropdown -->
<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="relative p-2 text-slate-400 hover:text-white transition-colors">
        <span class="text-2xl">🔔</span>
        @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="absolute top-0 right-0 w-4 h-4 bg-red-500 text-white text-[10px] font-black rounded-full flex items-center justify-center animate-bounce">
                {{ auth()->user()->unreadNotifications->count() }}
            </span>
        @endif
    </button>

    <div x-show="open" @click.away="open = false" x-transition 
         class="absolute left-0 mt-4 w-80 glass-panel rounded-3xl border-white/10 shadow-2xl overflow-hidden z-[200]">
        <div class="p-4 border-b border-white/5 bg-white/5">
            <h4 class="text-sm font-black text-white italic">الإشعارات الأخيرة</h4>
        </div>
        <div class="max-h-96 overflow-y-auto">
            @forelse(auth()->user()->notifications->take(5) as $notification)
                <a href="{{ $notification->data['url'] }}" class="block p-4 border-b border-white/5 hover:bg-white/5 transition-colors">
                    <p class="text-xs font-medium text-slate-300">{{ $notification->data['message'] }}</p>
                    <span class="text-[10px] text-slate-600 mt-1 block">{{ $notification->created_at->diffForHumans() }}</span>
                </a>
            @empty
                <p class="p-8 text-center text-xs text-slate-600 italic">ماعندك حتى إشعار دابا.</p>
            @endforelse
                </div>
            </div>
        </div>
        @endauth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2.5 rounded-xl text-xs font-black transition-all shadow-lg shadow-indigo-500/20 active:scale-95 italic">
                            خروج
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-slate-300 font-black text-xs hover:text-white transition-colors italic">دخول</a>
                <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white px-7 py-3 rounded-2xl text-xs font-black transition-all shadow-xl shadow-indigo-500/20 transform hover:scale-105 active:scale-95 italic uppercase tracking-widest">
                    ولي حريفي
                </a>
            @endauth
            @if(session('play_sound'))
                <script>
                    window.onload = function() {
                        playNotifSound();
                    };
                </script>
            @endif
        </div>
    </div>
</nav>