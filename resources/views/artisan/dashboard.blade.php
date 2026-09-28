<x-app-layout>
    <style>
        .dash-mesh {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at 0% 0%, rgba(99, 102, 241, 0.1) 0%, transparent 40%),
                        radial-gradient(circle at 100% 0%, rgba(251, 191, 36, 0.05) 0%, transparent 40%);
            z-index: -1;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .job-feed-card {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(99, 102, 241, 0.1);
        }
        .distance-badge {
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.2);
            color: #818cf8;
        }
        .btn-whatsapp { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
    </style>

    <div class="dash-mesh"></div>

    <div class="relative min-h-screen pt-32 pb-20 px-6" dir="rtl">
        <div class="max-w-7xl mx-auto">
            
            <!-- 1. Header Section -->
            <div class="glass-card rounded-[40px] p-8 md:p-10 mb-10 flex flex-col md:flex-row items-center justify-between gap-6 shadow-2xl">
                <div class="flex items-center gap-6">
                    <div class="w-24 h-24 bg-indigo-600 rounded-[30px] flex items-center justify-center text-5xl shadow-xl shadow-indigo-500/20 relative">
                        👨‍🔧
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-4 border-[#020617]"></div>
                    </div>
                    <div class="text-right">
                        <h1 class="text-3xl md:text-4xl font-black text-white italic leading-tight">مرحباً بك، المعلم {{ $user->name }}</h1>
                        <p class="text-slate-400 font-bold mt-2 italic text-lg">📍 {{ $user->city }} | 🛠️ {{ $user->service->name ?? 'حرفة غير محددة' }}</p>
                    </div>
                </div>
                <div class="flex gap-4 text-center">
                    <a href="{{ route('artisan.profile', $user->id) }}" class="bg-white/5 hover:bg-white/10 text-white px-8 py-4 rounded-2xl font-black border border-white/10 transition-all italic">
                        شوف بروفيلك العام
                    </a>
                </div>
            </div>

            <!-- 2. Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="glass-card p-8 rounded-[35px] text-center group border-indigo-500/10">
                    <div class="text-4xl mb-3 group-hover:scale-110 transition-transform">📩</div>
                    <div class="text-4xl font-black text-white mb-1">{{ $availableJobs->count() }}</div>
                    <div class="text-slate-500 font-bold text-xs uppercase italic tracking-widest">طلبات فـ مدينتك</div>
                </div>
                <div class="glass-card p-8 rounded-[35px] text-center group border-amber-500/10">
                    <div class="text-4xl mb-3 group-hover:scale-110 transition-transform">⭐</div>
                    <div class="text-4xl font-black text-amber-500 mb-1">{{ number_format($user->averageRating(), 1) }}</div>
                    <div class="text-slate-500 font-bold text-xs uppercase italic tracking-widest">تقييم الزبناء</div>
                </div>
                <div class="glass-card p-8 rounded-[35px] text-center group border-green-500/10">
                    <div class="text-4xl mb-3 group-hover:scale-110 transition-transform">💰</div>
                    <div class="text-4xl font-black text-white mb-1">
                        {{ \App\Models\Bid::where('artisan_id', $user->id)->where('status', 'accepted')->count() }}
                    </div>
                    <div class="text-slate-500 font-bold text-xs uppercase italic tracking-widest">خدمات مقبولة</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                <!-- 3. SMART JOB FEED (Column Column) -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="flex items-center justify-between px-4">
                        <h2 class="text-2xl font-black text-white italic">هموز قريبة منك فـ <span class="text-indigo-500 underline decoration-amber-500 decoration-4 underline-offset-8">{{ $user->city }}</span></h2>
                        <span class="bg-indigo-500/10 text-indigo-400 px-3 py-1 rounded-full text-[10px] font-black uppercase animate-pulse italic">تحديث مباشر ⚡</span>
                    </div>

                    @forelse($availableJobs as $job)
                        <div class="glass-card job-feed-card rounded-[40px] p-8 md:p-10 relative overflow-hidden group">
                            <!-- Background Accent -->
                            <div class="absolute -right-20 -top-20 w-40 h-40 bg-indigo-600/5 rounded-full blur-3xl group-hover:bg-indigo-600/10 transition-all"></div>

                            <div class="flex justify-between items-start mb-6 relative z-10">
                                <div class="text-right">
                                    <h3 class="text-2xl font-black text-white mb-1 italic">طلب {{ $job->service->name }}</h3>
                                    <div class="flex items-center gap-3 mt-2">
                                        <span class="text-xs text-slate-500 font-bold italic">{{ $job->created_at->diffForHumans() }}</span>
                                        
                                        <!-- [هنا كود المسافة الهربان] -->
                                        @if($job->distance !== null)
                                            <span class="distance-badge px-3 py-1 rounded-full text-[10px] font-black italic">
                                                📍 بعيد عليك بـ {{ $job->distance }} km
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="bg-amber-500/10 border border-amber-500/20 px-5 py-2 rounded-2xl">
                                    <span class="text-amber-500 font-black italic">{{ $job->min_price }} - {{ $job->max_price }} DH</span>
                                </div>
                            </div>

                            <div class="bg-white/5 p-6 rounded-3xl border border-white/5 mb-8 relative z-10">
                                <p class="text-slate-300 text-lg font-medium italic leading-relaxed">"{{ $job->description }}"</p>
                            </div>

                            <!-- Bidding Form -->
                            <form action="{{ route('bids.store') }}" method="POST" class="flex flex-col md:flex-row gap-4 relative z-10">
                                @csrf
                                <input type="hidden" name="job_request_id" value="{{ $job->id }}">
                                <div class="relative flex-1">
                                    <input type="number" name="price" placeholder="عطي ثمنك (DH)" class="w-full bg-slate-900/50 border-white/10 rounded-2xl p-5 text-white font-black text-xl focus:ring-indigo-500 outline-none transition-all" required>
                                    <span class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-600 font-black">DH</span>
                                </div>
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-10 py-5 rounded-2xl font-black text-lg transition-all shadow-xl shadow-indigo-500/20 transform active:scale-95 italic">
                                    إرسال العرض 🚀
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="glass-card rounded-[40px] p-20 text-center border-dashed border-white/10">
                            <p class="text-slate-500 italic text-xl font-bold">ما كاين حتى طلب جديد فـ مدينتك حالياً. <br> <span class="text-sm font-medium">غير يطيح شي همزة غاتبان ليك هنا!</span></p>
                        </div>
                    @endforelse
                </div>

                <!-- 4. RIGHT COLUMN (ACCEPTED BIDS & PORTFOLIO) -->
                <div class="space-y-10">
                    
                    <!-- Accepted Bids Section -->
                    <div class="glass-card p-8 rounded-[40px] border-green-500/20 shadow-2xl">
                        <h2 class="text-xl font-black text-white italic mb-8 flex items-center gap-3">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-ping"></span>
                            كليان قبلو عرضك 🎉
                        </h2>
                        
                        <div class="space-y-4">
                            @php
                                $acceptedBids = \App\Models\Bid::where('artisan_id', auth()->id())
                                                ->where('status', 'accepted')
                                                ->with('jobRequest.client')
                                                ->latest()
                                                ->get();
                            @endphp

                            @forelse($acceptedBids as $bid)
                                <div class="bg-green-500/5 border border-green-500/10 p-5 rounded-3xl space-y-4 shadow-inner">
                                    <div class="flex justify-between items-center text-right">
                                        <p class="font-black text-white italic">{{ $bid->jobRequest->client->name }}</p>
                                        <span class="text-[10px] font-black text-green-400 uppercase tracking-widest italic">تم القبول ✅</span>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="tel:{{ $bid->jobRequest->client->phone }}" class="flex-1 bg-white text-slate-900 py-3 rounded-xl font-black text-[10px] text-center hover:bg-amber-500 transition-colors italic">📞 اتصال</a>
                                        <a href="https://wa.me/212{{ substr($bid->jobRequest->client->phone, 1) }}" target="_blank" class="flex-1 btn-whatsapp text-white py-3 rounded-xl font-black text-[10px] text-center italic">💬 واتساب</a>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-slate-600 italic text-sm py-4">مازال ما قبل حتى زبون العرض ديالك.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Portfolio Management -->
                    <div class="glass-card p-8 rounded-[40px] border-white/5 shadow-2xl">
                        <h2 class="text-xl font-black text-white italic mb-8">معرض أعمالك 📸</h2>
                        
                        <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data" class="mb-8">
                            @csrf
                            <label class="group cursor-pointer block w-full bg-white/5 border-2 border-dashed border-white/10 rounded-3xl p-8 text-center hover:border-indigo-500 transition-all">
                                <input type="file" name="image" class="hidden" onchange="this.form.submit()">
                                <div class="text-4xl mb-3 group-hover:scale-110 transition-transform">📤</div>
                                <p class="text-xs font-black text-slate-400 group-hover:text-white uppercase italic">زيد تصويرة</p>
                            </label>
                        </form>

                        <div class="grid grid-cols-2 gap-4">
                            @foreach($user->portfolios as $photo)
                                <div class="relative group aspect-square rounded-2xl overflow-hidden border border-white/5 shadow-inner">
                                    <img src="{{ asset('storage/' . $photo->image_path) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    <form action="{{ route('portfolio.destroy', $photo->id) }}" method="POST" class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        @csrf @method('DELETE')
                                        <button class="bg-red-500/20 hover:bg-red-500 text-white p-3 rounded-2xl transition-all">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- [سكريبت تحديث موقع الحريفي] -->
    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                fetch("{{ route('profile.location.update') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    })
                });
            });
        }
    </script>
</x-app-layout>