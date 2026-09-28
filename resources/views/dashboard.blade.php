<x-app-layout>
    <div class="relative min-h-screen pt-32 pb-20 px-6">
        <!-- Mesh Background Effect -->
        <div class="mesh-gradient opacity-30"></div>

        <div class="max-w-6xl mx-auto relative z-10" dir="rtl">
            
            <!-- 1. Hero Welcome Section -->
            <div class="glass-panel rounded-[40px] p-10 border-indigo-500/20 mb-12 relative overflow-hidden shadow-2xl">
                <!-- Decoration -->
                <div class="absolute -left-20 -top-20 w-64 h-64 bg-indigo-600/10 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="text-right">
                        <h1 class="text-4xl md:text-5xl font-black text-white italic mb-4">
                            مرحباً بك، <span class="text-indigo-400">{{ Auth::user()->name }}</span> 👋
                        </h1>
                        <p class="text-slate-400 text-xl font-medium italic">شنو هو المشكل اللي باغي تحل اليوم؟ لقا أحسن الحريفية فـ منطقتك.</p>
                    </div>
                    <a href="{{ route('jobs.create') }}" class="bg-amber-500 hover:bg-amber-400 text-slate-900 px-10 py-5 rounded-[22px] font-black text-xl shadow-xl shadow-amber-500/20 transition-all transform hover:scale-105 active:scale-95">
                        🚀 حط طلبك دابا
                    </a>
                </div>
            </div>

            <!-- 2. Action Grid (The 3 Cards) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Card 1: Search -->
                <a href="/" class="group glass-panel p-10 rounded-[40px] border-white/5 hover:border-indigo-500/50 transition-all duration-500 text-center relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 text-9xl opacity-[0.03] group-hover:opacity-10 transition-all">🔍</div>
                    <div class="w-20 h-20 bg-indigo-600/10 text-indigo-500 rounded-3xl flex items-center justify-center text-4xl mb-6 mx-auto group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-xl">
                        🔍
                    </div>
                    <h3 class="text-2xl font-black text-white mb-2 italic">بحث عن حريفي</h3>
                    <p class="text-slate-500 font-bold text-sm italic">قلب على معلم فـ مدينتك</p>
                </a>

                <!-- Card 2: My Jobs -->
                <a href="{{ route('jobs.my-jobs') }}" class="group glass-panel p-10 rounded-[40px] border-white/5 hover:border-amber-500/50 transition-all duration-500 text-center relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 text-9xl opacity-[0.03] group-hover:opacity-10 transition-all">📅</div>
                    <div class="w-20 h-20 bg-amber-500/10 text-amber-500 rounded-3xl flex items-center justify-center text-4xl mb-6 mx-auto group-hover:bg-amber-500 group-hover:text-white transition-all shadow-xl">
                        📅
                    </div>
                    <h3 class="text-2xl font-black text-white mb-2 italic">طلباتي السابقة</h3>
                    <p class="text-slate-500 font-bold text-sm italic">تتبع العروض والطلبات ديالك</p>
                </a>

                <!-- Card 3: Profile Settings -->
                <a href="{{ route('profile.edit') }}" class="group glass-panel p-10 rounded-[40px] border-white/5 hover:border-indigo-500/50 transition-all duration-500 text-center relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 text-9xl opacity-[0.03] group-hover:opacity-10 transition-all">⚙️</div>
                    <div class="w-20 h-20 bg-slate-800 text-slate-400 rounded-3xl flex items-center justify-center text-4xl mb-6 mx-auto group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-xl">
                        ⚙️
                    </div>
                    <h3 class="text-2xl font-black text-white mb-2 italic">إعدادات الحساب</h3>
                    <p class="text-slate-500 font-bold text-sm italic">بدل معلوماتك الشخصية</p>
                </a>

            </div>

            <!-- 3. Recent Activity / Tips (Optional) -->
            <div class="mt-16 glass-panel p-8 rounded-[40px] border-white/5 border-dashed">
                <div class="flex items-center gap-4 text-slate-400 italic">
                    <span class="text-2xl">💡</span>
                    <p class="font-medium">نصيحة: ملي تختار حريفي، تأكد من تقييم الخدمة ديالو باش تعاون مستعملين آخرين.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>