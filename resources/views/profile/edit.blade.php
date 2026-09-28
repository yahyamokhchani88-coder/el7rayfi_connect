<x-app-layout>
    <div class="relative min-h-screen pt-24 pb-20 px-6">
        <!-- Mesh Background -->
        <div class="mesh-gradient opacity-30"></div>

        <div class="max-w-4xl mx-auto relative z-10" dir="rtl">
            <h2 class="text-4xl font-black text-white mb-10 italic">إعدادات <span class="text-indigo-500 underline decoration-amber-500 decoration-4 underline-offset-8">الحساب</span></h2>

            <div class="space-y-8">
                <!-- 1. معلومات البروفيل -->
                <div class="glass-panel p-8 md:p-12 rounded-[40px] border-white/5 shadow-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- 2. تغيير كلمة المرور -->
                <div class="glass-panel p-8 md:p-12 rounded-[40px] border-white/5 shadow-2xl">
                    @include('profile.partials.update-password-form')
                </div>

                <!-- 3. منطقة الخطر (حذف الحساب) -->
                <div class="glass-panel p-8 md:p-12 rounded-[40px] border-red-500/10 shadow-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>