<x-app-layout>
    <style>
        .profile-mesh {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, transparent 50%);
            z-index: -1;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .btn-call { background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); }
        .btn-whatsapp { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
        .avatar-glow { box-shadow: 0 0 50px rgba(99, 102, 241, 0.3); }
    </style>

    <div class="profile-mesh"></div>

    <div class="relative min-h-screen pt-32 pb-20 px-6" dir="rtl">
        <div class="max-w-6xl mx-auto">
            
            <!-- 1. Top Header Card -->
            <div class="glass-card rounded-[50px] p-8 md:p-12 mb-8 relative overflow-hidden shadow-2xl">
                <!-- Background Decoration -->
                <div class="absolute -left-20 -top-20 w-64 h-64 bg-indigo-600/10 rounded-full blur-3xl"></div>

                <div class="relative z-10 flex flex-col md:flex-row items-center gap-10">
                    <!-- Avatar Section -->
                    <div class="relative">
                        <div class="w-44 h-44 bg-slate-900 rounded-[45px] flex items-center justify-center text-8xl border-4 border-indigo-500/30 avatar-glow">
                            👨‍🔧
                        </div>
                        <div class="absolute -bottom-2 -right-2 bg-indigo-500 text-white px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border-4 border-[#020617]">
                            متوفر دابا
                        </div>
                    </div>

                    <!-- Info Section -->
                    <div class="flex-1 text-center md:text-right">
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/20 mb-6">
                            <span class="text-amber-500 text-xs font-black uppercase tracking-wider italic">حريفي بلاتيني مميز ✨</span>
                        </div>
                        <h1 class="text-5xl md:text-6xl font-black text-white italic mb-4 leading-tight">
                            المعلم {{ $artisan->name }}
                        </h1>
                        <div class="flex flex-wrap justify-center md:justify-start gap-4 text-xl text-slate-400 font-bold italic">
                            <span class="text-indigo-400 underline decoration-indigo-500/30 underline-offset-8">{{ $artisan->service->name }}</span>
                            <span class="text-slate-600">/</span>
                            <span>{{ $artisan->city }}</span>
                        </div>
                    </div>

                    <!-- Actions Desktop -->
                    <div class="hidden lg:flex flex-col gap-4 min-w-[250px]">
                        <a href="tel:{{ $artisan->phone }}" class="btn-call text-white p-5 rounded-[22px] font-black text-center text-xl shadow-xl shadow-indigo-500/20 hover:scale-105 transition-all active:scale-95 flex items-center justify-center gap-3">
                            <span>📞</span> عيط دابا
                        </a>
                        <a href="https://wa.me/212{{ substr($artisan->phone, 1) }}" target="_blank" class="btn-whatsapp text-white p-5 rounded-[22px] font-black text-center text-xl shadow-xl shadow-emerald-500/20 hover:scale-105 transition-all active:scale-95 flex items-center justify-center gap-3">
                            <span>💬</span> واتساب
                        </a>
                    </div>
                </div>
            </div>

            <!-- 2. Grid Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Right Side: Portfolio & Bio -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- About Section -->
                    <div class="glass-card rounded-[40px] p-10">
                        <h3 class="text-2xl font-black text-white mb-6 italic border-r-4 border-amber-500 pr-4">على المعلم {{ $artisan->name }}:</h3>
                        <p class="text-slate-400 text-xl leading-relaxed font-medium italic">
                            "أنا معلم متخصص فـ {{ $artisan->service->name }} بمدينة {{ $artisan->city }}. كنقدم ليكم خدمة احترافية، سريعة، وبأثمنة معقولة. شعاري هو المعقول والخدمة اللي ترضي الكليان. مرحبا بيكم فـ أي وقت."
                        </p>
                    </div>

                    <!-- Portfolio Grid -->
                    <div class="glass-card rounded-[40px] p-10">
                        <div class="flex justify-between items-center mb-10">
                            <h3 class="text-2xl font-black text-white italic underline decoration-indigo-500 decoration-4 underline-offset-8">معرض الأعمال (Portfolio)</h3>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-widest italic">{{ $artisan->portfolios->count() }} تصويرة</span>
                        </div>
                        
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @forelse($artisan->portfolios as $photo)
                                <div class="group relative aspect-square rounded-[28px] overflow-hidden border border-white/5">
                                    <img src="{{ asset('storage/' . $photo->image_path) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-indigo-600/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                </div>
                            @empty
                                <div class="col-span-full py-20 text-center glass-card border-dashed rounded-3xl">
                                    <p class="text-slate-500 italic text-lg font-bold">المعلم مازال ما حط تصاور لخدمتو.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Reviews Section -->
                    <div class="glass-card rounded-[40px] p-10">
                        <h3 class="text-2xl font-black text-white mb-10 italic">شنو قالو الكليان؟ ⭐</h3>
                        <div class="space-y-6">
                            @forelse($artisan->reviews as $review)
                                <div class="bg-white/5 p-6 rounded-[30px] border border-white/5">
                                    <div class="flex justify-between items-center mb-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-indigo-500/20 rounded-xl flex items-center justify-center text-sm font-black text-indigo-400">
                                                {{ substr($review->client->name, 0, 1) }}
                                            </div>
                                            <p class="font-black text-white">{{ $review->client->name }}</p>
                                        </div>
                                        <div class="flex text-amber-500 text-xs">
                                            @for($i=1; $i<=$review->rating; $i++) ⭐ @endfor
                                        </div>
                                    </div>
                                    <p class="text-slate-400 font-medium italic">"{{ $review->comment }}"</p>
                                </div>
                            @empty
                                <p class="text-center text-slate-500 italic">مازال ماكاين حتى تقييم.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Left Side: Stats & Booking -->
                <div class="space-y-8">
                    <!-- Stats Card -->
                    <div class="glass-card rounded-[40px] p-8 text-center border-amber-500/10 shadow-2xl">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/5 p-6 rounded-3xl">
                                <p class="text-3xl font-black text-amber-500 italic">{{ number_format($artisan->averageRating(), 1) }}</p>
                                <p class="text-[10px] font-black text-slate-500 uppercase mt-1">التقييم العام</p>
                            </div>
                            <div class="bg-white/5 p-6 rounded-3xl">
                                <p class="text-3xl font-black text-indigo-400 italic">+5</p>
                                <p class="text-[10px] font-black text-slate-500 uppercase mt-1">سنوات الخبرة</p>
                            </div>
                        </div>
                    </div>

                    <!-- Bidding/Booking Form -->
                    @auth
                        @if(auth()->user()->role === 'client')
                        <div class="glass-card rounded-[40px] p-10 border-indigo-500/20 sticky top-32 shadow-indigo-500/10">
                            <h4 class="text-2xl font-black text-white mb-6 italic">حط طلبك دابا.. 🚀</h4>
                            <p class="text-slate-400 text-sm mb-8 font-medium">صيفط تفاصيل المشكل للمعلم باش يعطيك أول عرض ثمن.</p>
                            
                            <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
                                @csrf
                                <input type="hidden" name="artisan_id" value="{{ $artisan->id }}">
                                <textarea name="message" rows="5" class="w-full bg-slate-900 border-white/10 rounded-3xl p-6 text-white font-bold focus:ring-amber-500 outline-none placeholder-slate-700" placeholder="مثلاً: عندي تسرب فـ المطبخ ومحتاج إصلاح سريع..."></textarea>
                                <button type="submit" class="w-full bg-amber-500 hover:bg-amber-400 text-slate-900 py-5 rounded-[22px] font-black text-xl shadow-xl transition-all transform active:scale-95">
                                    تأكيد الطلب 🔥
                                </button>
                            </form>
                        </div>
                        @endif
                    @endauth
                </div>

            </div>
        </div>
    </div>

    <!-- Mobile Actions Bar -->
    <div class="lg:hidden fixed bottom-0 left-0 w-full glass-card border-t border-white/10 p-6 z-[100] flex gap-4 backdrop-blur-3xl">
        <a href="tel:{{ $artisan->phone }}" class="flex-1 btn-call text-white py-4 rounded-2xl font-black text-center shadow-lg">اتصال</a>
        <a href="https://wa.me/212{{ substr($artisan->phone, 1) }}" class="flex-1 btn-whatsapp text-white py-4 rounded-2xl font-black text-center shadow-lg">واتساب</a>
    </div>

</x-app-layout>