<x-app-layout>
    <style>
        /* Modern Dark UI Enhancements */
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) rotate(3deg); }
            50% { transform: translateY(-20px) rotate(0deg); }
        }
        .animate-float { animation: float-slow 6s ease-in-out infinite; }
        
        .hero-shine {
            background: linear-gradient(to right, #fff 20%, #6366f1 50%, #fbbf24 80%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 200% auto;
            animation: shine 5s linear infinite;
        }
        @keyframes shine { to { background-position: 200% center; } }

        .glass-search {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .service-card:hover {
            transform: translateY(-15px);
            border-color: #6366f1;
            box-shadow: 0 30px 60px -12px rgba(99, 102, 241, 0.3);
        }
    </style>

    <div class="relative min-h-screen">
        <!-- Mesh Background -->
        <div class="mesh-bg"></div>

        <!-- 1. HERO SECTION -->
        <header class="relative pt-32 pb-20 px-6">
            <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-16">
                
                <!-- Content Right (Arabic RTL) -->
                <div class="flex-1 text-right z-10" dir="rtl">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass-panel mb-8 border-indigo-500/30">
                        <span class="w-2 h-2 bg-indigo-500 rounded-full animate-ping"></span>
                        <span class="text-[10px] font-black text-indigo-300 tracking-widest uppercase italic">المنصة الذكية رقم #1 فالمغرب</span>
                    </div>

                    <h1 class="text-6xl md:text-8xl font-black mb-8 leading-[1.1] hero-shine italic">
                        الحريفي لي <br> كايستحقك.
                    </h1>
                    
                    <p class="text-xl text-slate-400 mb-12 max-w-xl font-medium leading-relaxed italic">
                        ما تضيعش وقتك فالتقلاب. حط طلبك فـ ثواني، قارن الأثمنة، واختار أحسن معلم قريب ليك بكل أمان.
                    </p>

                    <!-- SEARCH BAR (The Core Logic) -->
                    <div class="glass-search p-3 rounded-[35px] flex flex-col md:flex-row gap-2 max-w-4xl shadow-2xl"
                         x-data="{ 
                            openCity: false, 
                            citySearch: '', 
                            cities: {{ $cities->pluck('name') }},
                            get filtered() { 
                                if(this.citySearch === '') return this.cities.slice(0, 5);
                                return this.cities.filter(c => c.includes(this.citySearch)).slice(0, 10);
                            }
                         }">
                        
                        <!-- City Select -->
                        <div class="flex-1 relative">
                            <label class="block text-[10px] font-black text-indigo-400 mb-1 mr-4 uppercase italic">المدينة</label>
                            <input type="text" 
                                   id="city-input"
                                   x-model="citySearch" 
                                   @click="openCity = true" 
                                   @click.away="openCity = false"
                                   placeholder="فين مدينة؟" 
                                   class="w-full p-3 bg-transparent border-none focus:ring-0 text-white font-black text-right placeholder-slate-600 text-lg"
                                   autocomplete="off">
                            
                            <!-- Dropdown -->
                            <div x-show="openCity && citySearch" x-transition class="absolute z-50 w-full bg-slate-900/95 backdrop-blur-xl mt-4 rounded-2xl border border-white/10 overflow-hidden shadow-2xl">
                                <template x-for="city in filtered">
                                    <div @click="citySearch = city; openCity = false" x-text="city" class="p-4 hover:bg-indigo-600 cursor-pointer transition-colors border-b border-white/5 font-bold text-right text-white"></div>
                                </template>
                            </div>
                        </div>

                        <div class="hidden md:block w-px bg-white/10 h-12 self-center"></div>

                        <!-- Service Select -->
                        <div class="flex-1 text-right">
                            <label class="block text-[10px] font-black text-indigo-400 mb-1 mr-4 uppercase italic">شنو محتاج؟</label>
                            <select id="service-select" class="w-full p-3 bg-transparent border-none focus:ring-0 text-white font-black text-right appearance-none cursor-pointer text-lg">
                                <option value="" class="bg-slate-900 text-slate-500">كل الحرف..</option>
                                @foreach($services as $s) 
                                    <option value="{{ $s->id }}" class="bg-slate-900 text-white">{{ $s->name }}</option> 
                                @endforeach
                            </select>
                        </div>

                        <!-- Search Button -->
                        <button onclick="doSearch()" class="bg-indigo-600 hover:bg-indigo-500 text-white px-12 py-5 rounded-[28px] font-black transition-all transform active:scale-95 shadow-xl shadow-indigo-500/40 text-xl">
                            بحث
                        </button>
                    </div>

                    <!-- InDrive CTA -->
                    <div class="mt-12 flex items-center gap-6">
                        <a href="{{ route('jobs.create') }}" class="group flex items-center gap-4 text-amber-500 font-black text-xl italic">
                            <span class="bg-amber-500/10 p-4 rounded-2xl group-hover:scale-110 transition-transform shadow-lg">🚀</span>
                            <span class="underline underline-offset-[12px] decoration-4 decoration-indigo-500/50 hover:text-white transition-colors">حط طلبك ووصل بـ عروض الأثمنة</span>
                        </a>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="flex-1 relative hidden lg:block">
                    <div class="relative z-10 animate-float">
                        <div class="glass-panel p-5 rounded-[60px] border-white/10 shadow-2xl rotate-3">
                            <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?q=80&w=2069" class="rounded-[40px] w-full h-[600px] object-cover grayscale-[0.2] hover:grayscale-0 transition-all duration-1000 shadow-inner">
                        </div>
                        <div class="absolute -bottom-10 -right-10 glass-panel p-8 rounded-[30px] border-amber-500/30 -rotate-6 backdrop-blur-3xl shadow-2xl">
                            <p class="text-5xl font-black text-amber-500 italic">+250</p>
                            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">مدينة مغربية 🇲🇦</p>
                        </div>
                    </div>
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[130%] h-[130%] bg-indigo-500/10 rounded-full blur-[120px] -z-10"></div>
                </div>
            </div>
        </header>

        <!-- 2. SERVICES GRID -->
        <section id="services" class="py-32 px-6 max-w-7xl mx-auto relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-24 gap-8" dir="rtl">
                <div class="text-right">
                    <h2 class="text-5xl md:text-7xl font-black text-white italic mb-6">خدمات <span class="text-indigo-500 underline decoration-amber-500 decoration-8 underline-offset-[15px]">احترافية.</span></h2>
                    <p class="text-slate-400 font-bold text-xl italic">أحسن المعلمين فـ كاع التخصصات واجدين للخدمة</p>
                </div>
                <div class="h-px flex-1 bg-gradient-to-l from-white/5 to-transparent mx-12 hidden md:block"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10" dir="rtl">
                @foreach($services as $service)
                    <a href="{{ route('search', ['service' => $service->id]) }}" class="group service-card glass-panel p-12 rounded-[50px] relative overflow-hidden text-right">
                        <div class="absolute -right-12 -bottom-12 text-[150px] opacity-[0.02] group-hover:opacity-[0.08] transition-all duration-700 group-hover:rotate-12">🛠️</div>
                        
                        <div class="w-24 h-24 bg-indigo-600/10 text-indigo-500 rounded-[35px] flex items-center justify-center text-5xl mb-10 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500 shadow-2xl">
                             @if($service->name == 'سباكة') 🚰 @elseif($service->name == 'كهرباء') ⚡ @elseif($service->name == 'صباغة') 🎨 @elseif($service->name == 'نجارة') 🪚 @else 🛠️ @endif
                        </div>
                        
                        <h3 class="text-3xl font-black mb-4 group-hover:text-amber-500 transition-colors italic text-white">{{ $service->name }}</h3>
                        <p class="text-slate-500 leading-relaxed text-lg font-medium italic">{{ $service->description }}</p>
                        
                        <div class="mt-12 flex items-center gap-4 text-indigo-400 font-black">
                            <span class="group-hover:translate-x-[-15px] transition-transform underline decoration-amber-500/30 underline-offset-[10px] text-sm italic">تصفح المعلمين</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- 3. HOW IT WORKS -->
        <section class="py-24 px-6 relative">
            <div class="max-w-7xl mx-auto text-center">
                <h2 class="text-4xl font-black mb-24 text-white italic">كيفاش <span class="text-indigo-500">كايخدم</span> السيت؟ ⚙️</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-20" dir="rtl">
                    <div class="relative group">
                        <div class="text-9xl font-black text-white/5 absolute -top-20 right-0 group-hover:text-indigo-500/10 transition-colors italic">01</div>
                        <h3 class="text-2xl font-black text-amber-500 mb-4 italic relative z-10">حط الطلب ديالك</h3>
                        <p class="text-slate-400 font-medium italic">اشرح المشكل فـ ثواني وحدد ميزانيتك وبلاصتك فـ الخريطة.</p>
                    </div>
                    <div class="relative group">
                        <div class="text-9xl font-black text-white/5 absolute -top-20 right-0 group-hover:text-indigo-500/10 transition-colors italic">02</div>
                        <h3 class="text-2xl font-black text-amber-500 mb-4 italic relative z-10">استقبل العروض</h3>
                        <p class="text-slate-400 font-medium italic">الحريفية اللي قراب ليك غايعطيوك أثمنة منافسة فـ البلاصة.</p>
                    </div>
                    <div class="relative group">
                        <div class="text-9xl font-black text-white/5 absolute -top-20 right-0 group-hover:text-indigo-500/10 transition-colors italic">03</div>
                        <h3 class="text-2xl font-black text-amber-500 mb-4 italic relative z-10">اختار المعلم</h3>
                        <p class="text-slate-400 font-medium italic">قارن التقييمات، شوف معرض الأعمال، واختار أحسن حريفي ليك.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. FINAL CTA -->
        <section class="py-32 px-6">
            <div class="max-w-6xl mx-auto glass-panel rounded-[60px] p-20 text-center border-indigo-500/20 relative overflow-hidden shadow-2xl">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/20 to-transparent"></div>
                <div class="relative z-10">
                    <h2 class="text-5xl md:text-6xl font-black mb-10 leading-tight text-white italic">باغي تخدم وتزيد مدخولك؟ <br> <span class="text-amber-500">ولي حريفي معانا دابا!</span></h2>
                    <a href="{{ route('register') }}" class="inline-block bg-white text-slate-950 px-16 py-6 rounded-[28px] font-black text-2xl hover:bg-amber-500 hover:text-white transition-all transform hover:scale-110 shadow-2xl shadow-white/5 italic">
                        سجل كحريفي 🛠️
                    </a>
                </div>
            </div>
        </section>
    </div>

    <!-- SCRIPT FOR SEARCH -->
    <script>
        function doSearch() {
            // نجبدو القيمة ديال المدينة من الـ input (مربوط بـ id)
            const city = document.getElementById('city-input').value.trim();
            // نجبدو الـ ID ديال الحرفة من الـ select
            const service = document.getElementById('service-select').value;

            // بناء الرابط (URL)
            // الرابط غايمشي لـ /search وخا يكونوا خاويين
            let url = "{{ route('search') }}?";
            
            if (city) {
                url += "city=" + encodeURIComponent(city) + "&";
            }
            
            if (service) {
                url += "service=" + service;
            }

            // توجيه المستعمل لباج النتائج
            window.location.href = url;
        }
    </script>
</x-app-layout>