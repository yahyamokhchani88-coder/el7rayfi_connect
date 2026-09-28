<section class="space-y-6">
    <header>
        <h3 class="text-2xl font-black text-white italic">معلومات البروفيل ✨</h3>
        <p class="mt-1 text-sm text-slate-400 font-medium">عدل معلوماتك الشخصية والبريد الإلكتروني ديالك.</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('الإسم الكامل')" class="text-amber-500 font-black italic mb-2 mr-2" />
                <input id="name" name="name" type="text" class="w-full bg-slate-900/50 border-white/10 rounded-2xl p-4 text-white font-bold focus:ring-indigo-500 outline-none" value="{{ old('name', $user->name) }}" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('البريد الإلكتروني')" class="text-amber-500 font-black italic mb-2 mr-2" />
                <input id="email" name="email" type="email" class="w-full bg-slate-900/50 border-white/10 rounded-2xl p-4 text-white font-bold focus:ring-indigo-500 outline-none" value="{{ old('email', $user->email) }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <!-- Phone (New) -->
            <div>
                <x-input-label for="phone" :value="__('رقم الهاتف')" class="text-amber-500 font-black italic mb-2 mr-2" />
                <input id="phone" name="phone" type="text" class="w-full bg-slate-900/50 border-white/10 rounded-2xl p-4 text-white font-bold focus:ring-indigo-500 outline-none text-left" dir="ltr" value="{{ old('phone', $user->phone) }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <!-- City (For Artisans or Everyone) -->
            <div>
                <x-input-label for="city" :value="__('المدينة')" class="text-amber-500 font-black italic mb-2 mr-2" />
                <select id="city" name="city" class="w-full bg-slate-900/50 border-white/10 rounded-2xl p-4 text-white font-bold focus:ring-indigo-500 outline-none">
                    @foreach(\App\Models\City::all() as $city)
                        <option value="{{ $city->name }}" {{ old('city', $user->city) == $city->name ? 'selected' : '' }} class="bg-slate-900">{{ $city->name }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-10 py-4 rounded-2xl font-black transition-all shadow-xl shadow-indigo-500/20 active:scale-95">
                حفظ التغييرات 💾
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-400 font-bold italic">✅ تم الحفظ بنجاح</p>
            @endif
        </div>
    </form>
</section>