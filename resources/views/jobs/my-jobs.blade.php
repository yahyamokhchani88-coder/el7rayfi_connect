<x-app-layout>
    <style>
        /* Mesh Background خاص بهاد الصفحة */
        .results-mesh {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at 10% 10%, rgba(99, 102, 241, 0.1) 0%, transparent 40%),
                        radial-gradient(circle at 90% 90%, rgba(251, 191, 36, 0.05) 0%, transparent 40%);
            z-index: -1;
        }
        .job-card {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s ease;
        }
        .bid-card {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }
        .bid-card.accepted {
            border-color: #10b981;
            background: rgba(16, 185, 129, 0.05);
            box-shadow: 0 0 30px rgba(16, 185, 129, 0.1);
        }
        .btn-whatsapp { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
    </style>

    <div class="results-mesh"></div>

    <div class="relative min-h-screen pt-32 pb-20 px-6" dir="rtl">
        <div class="max-w-5xl mx-auto">
            
            <!-- Header -->
            <div class="mb-12 text-right">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 mb-4">
                    <span class="text-[10px] font-black text-indigo-400 uppercase tracking-widest italic">تتبع الطلبات 📡</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-black text-white italic leading-tight">
                    طلباتي <span class="text-amber-500 underline decoration-indigo-500 decoration-8 underline-offset-[12px]">والعروض..</span>
                </h1>
                <p class="text-slate-500 mt-6 text-xl font-medium italic">هنا غاتلقى كاع الحريفية اللي عطاوك أثمنة على الخدمة ديالك.</p>
            </div>

            <!-- Jobs List -->
            @forelse($myJobs as $job)
                <div class="job-card rounded-[45px] p-8 md:p-12 mb-10 shadow-2xl relative overflow-hidden">
                    <!-- Status Badge -->
                    <div class="absolute top-8 left-8">
                        <span class="px-5 py-2 rounded-full text-xs font-black uppercase italic tracking-widest {{ $job->status === 'open' ? 'bg-indigo-500 text-white shadow-lg shadow-indigo-500/20' : 'bg-white/5 text-slate-500 border border-white/10' }}">
                            {{ $job->status === 'open' ? 'مفتوح للطلبات 🟢' : 'تم الإغلاق 🔴' }}
                        </span>
                    </div>

                    <!-- Job Info -->
                    <div class="flex flex-col md:flex-row justify-between items-start mb-10 border-b border-white/5 pb-10 gap-6">
                        <div class="text-right">
                            <h3 class="text-3xl font-black text-white italic mb-3">{{ $job->service->name }} - {{ $job->city }}</h3>
                            <p class="text-slate-400 text-lg font-medium italic leading-relaxed">"{{ $job->description }}"</p>
                            <p class="text-xs text-slate-600 mt-4 font-bold italic">نشرتيه: {{ $job->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="bg-white/5 p-6 rounded-3xl border border-white/5 text-center min-w-[180px]">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">الميزانية المقترحة</p>
                            <p class="text-3xl font-black text-amber-500 italic">{{ $job->min_price }} - {{ $job->max_price }} <span class="text-sm">DH</span></p>
                        </div>
                    </div>

                    <!-- Bids Section -->
                    <div class="space-y-6">
                        <h4 class="text-xl font-black text-indigo-400 mb-6 italic flex items-center gap-3">
                            <span>عروض الحريفية</span>
                            <span class="w-8 h-8 bg-indigo-500/20 rounded-full flex items-center justify-center text-xs text-indigo-300">{{ $job->bids->count() }}</span>
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($job->bids as $bid)
                                <div class="bid-card rounded-[35px] p-8 flex flex-col justify-between {{ $bid->status === 'accepted' ? 'accepted' : '' }}">
                                    
                                    <div class="flex justify-between items-center mb-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center text-3xl shadow-lg">👨‍🔧</div>
                                            <div>
                                                <p class="font-black text-white text-lg italic">المعلم {{ $bid->artisan->name }}</p>
                                                <p class="text-xs font-bold text-slate-500 italic">تقييم: ⭐ {{ number_format($bid->artisan->averageRating(), 1) }}</p>
                                            </div>
                                        </div>
                                        <div class="text-left">
                                            <p class="text-2xl font-black text-amber-500 italic">{{ $bid->price }} DH</p>
                                        </div>
                                    </div>

                                    <!-- Logic: Accept Button OR Contact Info -->
                                    @if($job->status === 'open')
                                        <form action="{{ route('bids.accept', $bid->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white py-4 rounded-2xl font-black text-sm transition-all transform active:scale-95 shadow-xl shadow-indigo-500/20">
                                                قبول هاد العرض ✅
                                            </button>
                                        </form>
                                    @elseif($bid->status === 'accepted')
                                        <!-- هاد الجزء كيبان غير يلا كان العرض مقبول -->
                                        <div class="space-y-4 animate-in fade-in slide-in-from-bottom-2 duration-700">
                                            <div class="bg-green-500/10 border border-green-500/20 p-4 rounded-2xl text-center">
                                                <p class="text-green-400 font-black text-sm italic">تم الاختيار! تواصل مع المعلم دابا:</p>
                                            </div>
                                            <div class="flex gap-3">
                                                <a href="tel:{{ $bid->artisan->phone }}" class="flex-1 bg-white text-slate-900 py-4 rounded-2xl font-black text-xs text-center hover:bg-amber-500 transition-colors flex items-center justify-center gap-2">
                                                    <span>📞</span> {{ $bid->artisan->phone }}
                                                </a>
                                                <a href="https://wa.me/212{{ substr($bid->artisan->phone, 1) }}" target="_blank" class="flex-1 btn-whatsapp text-white py-4 rounded-2xl font-black text-xs text-center hover:opacity-90 transition-opacity flex items-center justify-center gap-2">
                                                    <span>💬</span> واتساب
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <!-- العروض الأخرى اللي ما تقبلوش والطلب تسد -->
                                        <div class="text-center py-4 opacity-30">
                                            <p class="text-slate-500 font-bold italic text-sm">لم يتم اختياره</p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="job-card rounded-[50px] p-20 text-center border-dashed border-white/10">
                    <div class="text-8xl mb-8 opacity-20">📭</div>
                    <h2 class="text-2xl font-black text-white mb-4 italic">مازال ما حطيتي حتى طلب</h2>
                    <p class="text-slate-500 mb-10 max-w-md mx-auto text-lg leading-relaxed font-medium">حط طلبك دابا فـ ثواني وخلي الحريفية هوما اللي يقلبو عليك.</p>
                    <a href="{{ route('jobs.create') }}" class="inline-block bg-indigo-600 hover:bg-indigo-500 text-white px-12 py-5 rounded-[22px] font-black text-xl shadow-2xl shadow-indigo-500/20 transition-all transform hover:scale-105">
                        🚀 حط أول طلب ليك
                    </a>
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>