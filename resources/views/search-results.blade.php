<x-app-layout>
    <style>
        .results-mesh {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at 0% 0%, rgba(99, 102, 241, 0.1) 0%, transparent 40%),
                        radial-gradient(circle at 100% 100%, rgba(251, 191, 36, 0.05) 0%, transparent 40%);
            z-index: -1;
        }
        .artisan-card {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .artisan-card:hover {
            transform: translateY(-10px);
            border-color: rgba(99, 102, 241, 0.4);
            background: rgba(255, 255, 255, 0.04);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5);
        }
        .filter-glass {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>

    <div class="results-mesh"></div>

    <div class="relative min-h-screen pt-32 pb-20 px-6" dir="rtl">
        <div class="max-w-7xl mx-auto">
            
            <!-- 1. Search Header & Mini-Filter -->
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
                <div class="text-right">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 mb-4">
                        <span class="text-[10px] font-black text-indigo-400 uppercase tracking-widest italic">نتائج البحث المباشرة ⚡</span>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-black text-white italic leading-tight">
                        لقينا ليك <span class="text-amber-500 underline decoration-indigo-500 decoration-8 underline-offset-[12px]">{{ $artisans->count() }}</span> حريفي
                    </h1>
                    <p class="text-slate-500 mt-6 text-xl font-medium italic">أحسن المعلمين فـ {{ request('city') ?: 'المغرب' }} واجدين للخدمة</p>
                </div>

                <!-- Mini Filter Bar -->
                <form action="{{ route('search') }}" method="GET" class="filter-glass p-2 rounded-3xl flex flex-wrap md:flex-nowrap gap-2 border-white/5 shadow-2xl w-full md:w-auto">
                    <select name="service" class="flex-1 bg-transparent border-none focus:ring-0 font-bold text-white text-sm min-w-[140px] cursor-pointer">
                        <option value="" class="bg-slate-900">كاع الحرف</option>
                        @foreach($services as $s)
                            <option value="{{ $s->id }}" {{ request('service') == $s->id ? 'selected' : '' }} class="bg-slate-900">{{ $s->name }}</option>
                        @endforeach
                    </select>
                    <div class="hidden md:block w-px h-6 bg-white/10 self-center"></div>
                    <input type="text" name="city" value="{{ request('city') }}" placeholder="المدينة..." 
                           class="flex-1 bg-transparent border-none focus:ring-0 font-bold text-white text-sm w-32 placeholder-slate-600 text-right">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-3 rounded-2xl font-black text-xs transition-all shadow-lg shadow-indigo-500/20 active:scale-95">
                        تحديث البحث
                    </button>
                </form>
            </div>

            <!-- 2. Results Grid -->
            @if($artisans->isEmpty())
                <!-- Empty State -->
                <div class="artisan-card rounded-[50px] p-20 text-center border-dashed border-white/10">
                    <div class="text-8xl mb-8 opacity-20">🏜️</div>
                    <h2 class="text-3xl font-black text-white mb-4 italic">مالقينا حتى حريفي بهاد المواصفات</h2>
                    <p class="text-slate-500 mb-12 max-w-md mx-auto text-lg leading-relaxed">ما تضيعش وقتك فالتماعير، حط طلبك دابا وخلي الحريفية هوما اللي يتواصلو معاك ويعطيوك أثمنة منافسة.</p>
                    <a href="{{ route('jobs.create') }}" class="inline-block bg-amber-500 hover:bg-amber-400 text-slate-900 px-12 py-5 rounded-[22px] font-black text-xl shadow-2xl shadow-amber-500/20 transition-all transform hover:scale-105">
                        🚀 حط طلبك بنظام المزايدة
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($artisans as $artisan)
                        <div class="group relative artisan-card p-8 rounded-[40px] overflow-hidden">
                            <!-- Background Decoration -->
                            <div class="absolute -right-10 -top-10 w-32 h-32 bg-indigo-600/5 rounded-full blur-2xl group-hover:bg-indigo-600/10 transition-all"></div>

                            <!-- Top Info: Rating & Status -->
                            <div class="flex justify-between items-start mb-8 relative z-10">
                                <div class="bg-white/5 border border-white/10 px-4 py-1.5 rounded-full flex items-center gap-2">
                                    <span class="text-amber-500 font-black text-sm italic">⭐ {{ number_format($artisan->averageRating(), 1) }}</span>
                                </div>
                                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(34,197,94,0.5)]"></div>
                            </div>

                            <!-- Artisan Profile Info -->
                            <div class="flex items-center gap-5 mb-10 relative z-10">
                                <div class="w-20 h-20 bg-slate-900 rounded-[28px] flex items-center justify-center text-4xl border border-white/5 shadow-inner group-hover:scale-110 transition-transform duration-500">
                                    👨‍🔧
                                </div>
                                <div class="text-right">
                                    <h3 class="text-2xl font-black text-white italic group-hover:text-amber-500 transition-colors leading-tight mb-1">المعلم {{ $artisan->name }}</h3>
                                    <span class="text-indigo-400 font-bold text-sm tracking-wide">{{ $artisan->service->name }}</span>
                                </div>
                            </div>

                            <!-- Details List -->
                            <div class="space-y-4 mb-10 border-t border-white/5 pt-8 relative z-10">
                                <div class="flex items-center gap-3 text-slate-400 group-hover:text-slate-200 transition-colors">
                                    <span class="text-xl">📍</span>
                                    <span class="font-bold text-sm italic">مدينة {{ $artisan->city }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-slate-400 group-hover:text-slate-200 transition-colors">
                                    <span class="text-xl">🛠️</span>
                                    <span class="font-bold text-sm">خدمة احترافية وسريعة</span>
                                </div>
                                <div class="flex items-center gap-3 text-indigo-400">
                                    <span class="text-xl">✅</span>
                                    <span class="font-black text-[10px] uppercase tracking-[0.1em]">حساب مفحوص وموثوق</span>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <a href="{{ route('artisan.profile', $artisan->id) }}" class="relative z-10 block w-full text-center py-5 bg-white/5 hover:bg-indigo-600 text-white rounded-[24px] font-black text-lg transition-all border border-white/10 hover:border-transparent shadow-xl active:scale-95">
                                تواصل مع المعلم
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>