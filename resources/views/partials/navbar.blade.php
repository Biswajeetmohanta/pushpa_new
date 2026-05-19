@php
    $setting = $setting ?? \App\Models\Setting::firstOrCreate([], [
        'contact_phone_1' => '+91 98255 30295',
        'contact_email' => 'pushprajconstruction9@gmail.com',
    ]);

    $navLinks = [
        ['name' => 'Home', 'route' => 'home'],
        ['name' => 'About', 'route' => 'about'],
        ['name' => 'Services', 'route' => 'services'],
        ['name' => 'Projects', 'route' => 'projects'],
        ['name' => 'Certifications', 'route' => 'certifications'],
        ['name' => 'Our Team', 'route' => 'team'],
        ['name' => 'Careers', 'route' => 'careers'],
        ['name' => 'Contact', 'route' => 'contact'],
    ];
@endphp

<!-- Top Bar -->
<div class="hidden lg:block bg-primary text-white py-2">
    <div class="max-w-7xl mx-auto px-6 flex justify-between items-center text-sm">
        <div class="flex items-center gap-6">
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $setting->contact_phone_1) }}" class="flex items-center gap-2 hover:text-accent transition-colors">
                <i data-lucide="phone" class="w-4 h-4"></i>
                {{ $setting->contact_phone_1 }}
            </a>
            <a href="mailto:{{ $setting->contact_email }}" class="flex items-center gap-2 hover:text-accent transition-colors">
                <i data-lucide="mail" class="w-4 h-4"></i>
                {{ $setting->contact_email }}
            </a>
        </div>
        <div class="text-white/80">
            ISO 9001:2015 & ISO 45001:2018 Certified
        </div>
    </div>
</div>

<!-- Main Navbar -->
<nav class="sticky top-0 z-50 w-full bg-white shadow-md transition-all duration-300" x-data="{ isMobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between h-16 sm:h-20">
            @php
                $siteSetting = \App\Models\Setting::first();
            @endphp
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 sm:gap-3 flex-shrink-0">
                @if($siteSetting && $siteSetting->logo)
                    <img src="{{ asset($siteSetting->logo) }}" alt="Pushpraj Construction" class="h-10 sm:h-12 w-auto object-contain">
                @else
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg flex items-center justify-center font-bold text-lg sm:text-xl bg-primary text-white flex-shrink-0">
                        PC
                    </div>
                    <div>
                        <div class="font-serif font-bold text-lg sm:text-xl text-primary">
                            Pushpraj
                        </div>
                        <div class="text-[10px] sm:text-xs tracking-widest uppercase text-muted-foreground">
                            Construction
                        </div>
                    </div>
                @endif
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center gap-6 xl:gap-8">
                @foreach($navLinks as $link)
                    <a href="{{ route($link['route']) }}" class="font-medium transition-colors text-sm {{ Route::currentRouteName() === $link['route'] ? 'text-accent font-semibold border-b-2 border-accent pb-1' : 'text-foreground hover:text-accent' }}">
                        {{ $link['name'] }}
                    </a>
                @endforeach
                <a href="{{ route('contact') }}" class="btn-primary text-sm !py-2.5 !px-5">
                    Get a Quote
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="lg:hidden p-2 rounded-lg text-primary hover:bg-slate-100 transition-colors" aria-label="Toggle menu">
                <!-- Hamburger icon -->
                <svg x-show="!isMobileMenuOpen" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                <!-- Close icon -->
                <svg x-show="isMobileMenuOpen" x-cloak xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="isMobileMenuOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden absolute top-full left-0 right-0 bg-white shadow-xl border-t border-slate-100 z-50">
        <div class="px-4 py-3 space-y-1 max-h-[70vh] overflow-y-auto">
            @foreach($navLinks as $link)
                <a href="{{ route($link['route']) }}" @click="isMobileMenuOpen = false" class="block px-4 py-3 rounded-lg font-medium hover:bg-slate-50 transition-colors {{ Route::currentRouteName() === $link['route'] ? 'text-accent bg-slate-50 font-semibold' : 'text-foreground hover:text-accent' }}">
                    {{ $link['name'] }}
                </a>
            @endforeach
            <div class="pt-2 pb-1">
                <a href="{{ route('contact') }}" @click="isMobileMenuOpen = false" class="block btn-primary text-center !py-3">
                    Get a Quote
                </a>
            </div>
        </div>
    </div>
</nav>
