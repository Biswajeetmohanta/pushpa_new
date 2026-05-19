@php
$setting = $setting ?? \App\Models\Setting::first();
$contactAddress = $setting->contact_address ?? 'Near Bhagwati Temple, Chamunda Chowk, Botad, Gujarat - 364710';
$contactAddressSingleLine = str_replace("\n", " ", $contactAddress);
$contactPhone = $setting->contact_phone_1 ?? '+91 98255 30295';
$contactEmail = $setting->contact_email ?? 'pushprajconstruction9@gmail.com';

$quickLinks = [
  ['name' => 'Home', 'route' => 'home'],
  ['name' => 'About Us', 'route' => 'about'],
  ['name' => 'Services', 'route' => 'services'],
  ['name' => 'Projects', 'route' => 'projects'],
  ['name' => 'Certifications', 'route' => 'certifications'],
  ['name' => 'Our Team', 'route' => 'team'],
  ['name' => 'Careers', 'route' => 'careers'],
  ['name' => 'Contact', 'route' => 'contact'],
];

$services = [
  "Industrial Construction",
  "Highways & Roads",
  "Bridges & Flyovers",
  "EPC Contracts",
  "Water Management",
  "Residential Projects",
];
@endphp

<!-- Overlapping Pre-Footer CTA Card (Placed above the footer to prevent clipping from overflow-hidden) -->
<div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 -mb-20 sm:-mb-24">
    <div class="bg-[#1a3d5c] border-l-4 border-accent rounded-2xl shadow-2xl p-6 sm:p-8 md:p-10 flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden group"
         style="background: linear-gradient(90deg, #1a3d5c 0%, #0f2a4a 50%, #0a1f38 100%);">
        <!-- Decorative Background Grid Pattern -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none bg-[radial-gradient(#c9a227_1px,transparent_1px)] [background-size:16px_16px]"></div>
        
        <div class="relative z-10 flex-1 text-center md:text-left">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-accent/15 border border-accent/20 text-accent text-xs font-semibold uppercase tracking-wider mb-3">
                <!-- Inline SVG Sparkle icon -->
                <svg class="w-3.5 h-3.5 text-accent animate-pulse" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275Z"/></svg>
                Let's Build Together
            </span>
            <h3 class="font-serif text-xl sm:text-2xl md:text-3xl font-bold text-white leading-tight">
                Ready to bring your next landmark project to life?
            </h3>
            <p class="text-white/70 text-xs sm:text-sm mt-2 max-w-2xl font-sans">
                Connect with Gujarat's premier civil infrastructure and EPC contract specialists.
            </p>
        </div>
        
        <div class="relative z-10 flex-shrink-0 w-full md:w-auto flex justify-center">
            <a href="#contact" class="inline-flex items-center gap-2 bg-accent text-primary font-bold text-xs sm:text-sm px-6 py-3.5 rounded-xl hover:bg-accent-light transition-all duration-300 shadow-lg hover:shadow-accent/20 hover:-translate-y-0.5 group/btn w-full md:w-auto justify-center">
                Get a Free Quote
                <svg class="w-4 h-4 transition-transform duration-300 group-hover/btn:translate-x-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </div>
</div>

<footer class="relative bg-[#0f2a4a] text-white pt-32 sm:pt-36 pb-6 sm:pb-8 overflow-hidden" 
        style="background: linear-gradient(180deg, #0f2a4a 0%, #0a1f38 100%);"
        x-data="{ showBackToTop: false }" 
        @scroll.window="showBackToTop = window.scrollY > 500">
    
    <!-- Background Decorative Grid Overlay for Entire Footer -->
    <div class="absolute inset-0 opacity-[0.02] pointer-events-none bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px]"></div>

    <!-- Main Footer Grid -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12 items-start">

            <!-- Column 1: Company Info -->
            <div class="flex flex-col gap-5">
                <a href="#home" class="flex items-center gap-3 group w-fit">
                    @if($setting && $setting->logo)
                        <img src="{{ asset($setting->logo) }}" alt="Pushpraj Construction" class="h-11 w-auto object-contain transition-transform duration-500 group-hover:scale-105 bg-white rounded-lg p-1">
                    @else
                        <div class="w-11 h-11 rounded-xl bg-accent text-primary flex items-center justify-center font-bold text-lg shadow-lg shadow-accent/10 transition-transform duration-500 group-hover:rotate-[360deg]">
                            PC
                        </div>
                        <div>
                            <div class="font-serif font-bold text-xl leading-none text-white tracking-wide">Pushpraj</div>
                            <div class="text-[10px] tracking-[0.25em] uppercase text-accent font-semibold mt-1">Construction</div>
                        </div>
                    @endif
                </a>
                
                <p class="text-white/70 text-xs sm:text-sm leading-relaxed font-sans mt-2">
                    A trusted name in civil engineering and infrastructure development, shaping landscapes with precision, safety, and modern engineering excellence across Gujarat since 2005.
                </p>
                
                <!-- Social media buttons (Using inline SVGs for guaranteed rendering) -->
                <div class="flex items-center gap-2.5 mt-2">
                    <!-- Facebook -->
                    @if(!empty($setting->social_facebook) && $setting->social_facebook !== '#')
                    <a href="{{ $setting->social_facebook }}" class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white/80 hover:text-primary hover:bg-accent hover:border-accent transition-all duration-300 hover:-translate-y-1 hover:rotate-6 group" aria-label="Facebook">
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:scale-110" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    @endif

                    <!-- Instagram -->
                    @if(!empty($setting->social_instagram) && $setting->social_instagram !== '#')
                    <a href="{{ $setting->social_instagram }}" class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white/80 hover:text-primary hover:bg-accent hover:border-accent transition-all duration-300 hover:-translate-y-1 hover:rotate-6 group" aria-label="Instagram">
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:scale-110" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                    </a>
                    @endif

                    <!-- LinkedIn -->
                    @if(!empty($setting->social_linkedin) && $setting->social_linkedin !== '#')
                    <a href="{{ $setting->social_linkedin }}" class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white/80 hover:text-primary hover:bg-accent hover:border-accent transition-all duration-300 hover:-translate-y-1 hover:rotate-6 group" aria-label="LinkedIn">
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:scale-110" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                    </a>
                    @endif

                    <!-- Twitter -->
                    @if(!empty($setting->social_twitter) && $setting->social_twitter !== '#')
                    <a href="{{ $setting->social_twitter }}" class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white/80 hover:text-primary hover:bg-accent hover:border-accent transition-all duration-300 hover:-translate-y-1 hover:rotate-6 group" aria-label="Twitter">
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:scale-110" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Column 2: Quick Navigation -->
            <div class="flex flex-col gap-4 md:pl-4">
                <h4 class="font-serif text-base sm:text-lg font-bold text-white relative w-fit after:content-[''] after:absolute after:-bottom-1.5 after:left-0 after:w-10 after:h-0.5 after:bg-accent">
                    Quick Links
                </h4>
                <ul class="space-y-2.5 mt-4">
                    @foreach($quickLinks as $link)
                        <li>
                            <a href="{{ route($link['route']) }}" class="group flex items-center gap-1 text-white/70 hover:text-accent text-xs sm:text-sm font-sans transition-all duration-300 hover:translate-x-1.5">
                                <!-- Inline SVG Chevron for high performance hover glide -->
                                <svg class="w-3 h-3 text-accent opacity-0 -ml-2 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                                <span>{{ $link['name'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Column 3: Services -->
            <div class="flex flex-col gap-4">
                <h4 class="font-serif text-base sm:text-lg font-bold text-white relative w-fit after:content-[''] after:absolute after:-bottom-1.5 after:left-0 after:w-10 after:h-0.5 after:bg-accent">
                    Our Services
                </h4>
                <ul class="space-y-2.5 mt-4">
                    @foreach($services as $service)
                        <li>
                            <a href="#services" class="group flex items-center gap-1 text-white/70 hover:text-accent text-xs sm:text-sm font-sans transition-all duration-300 hover:translate-x-1.5">
                                <!-- Inline SVG Chevron for high performance hover glide -->
                                <svg class="w-3 h-3 text-accent opacity-0 -ml-2 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                                <span>{{ $service }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Column 4: Contact & Newsletter -->
            <div class="flex flex-col gap-4">
                <h4 class="font-serif text-base sm:text-lg font-bold text-white relative w-fit after:content-[''] after:absolute after:-bottom-1.5 after:left-0 after:w-10 after:h-0.5 after:bg-accent">
                    Contact Info
                </h4>
                <ul class="space-y-3.5 mt-4">
                    <li class="flex items-start gap-3 group">
                        <div class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-accent group-hover:bg-accent/10 group-hover:border-accent/20 transition-all duration-300 flex-shrink-0 mt-0.5">
                            <i data-lucide="map-pin" class="w-4 h-4"></i>
                        </div>
                        <span class="text-white/75 text-xs sm:text-sm leading-relaxed font-sans">
                            {{ $contactAddressSingleLine }}
                        </span>
                    </li>
                    <li class="flex items-center gap-3 group">
                        <div class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-accent group-hover:bg-accent/10 group-hover:border-accent/20 transition-all duration-300 flex-shrink-0">
                            <i data-lucide="phone" class="w-4 h-4"></i>
                        </div>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contactPhone) }}" class="text-white/75 hover:text-accent text-xs sm:text-sm font-sans transition-colors duration-300">
                            {{ $contactPhone }}
                        </a>
                    </li>
                    <li class="flex items-start gap-3 group">
                        <div class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-accent group-hover:bg-accent/10 group-hover:border-accent/20 transition-all duration-300 flex-shrink-0 mt-0.5">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </div>
                        <a href="mailto:{{ $contactEmail }}" class="text-white/75 hover:text-accent text-xs sm:text-sm font-sans transition-colors duration-300 break-all">
                            {{ $contactEmail }}
                        </a>
                    </li>
                </ul>
                
                <!-- Interactive newsletter signup -->
                <div class="mt-4 pt-4 border-t border-white/10" 
                     x-data="{ 
                         email: '', 
                         subscribed: false, 
                         error: '',
                         loading: false,
                         validateEmail(email) {
                             return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                         },
                         submitSubscription() {
                             this.error = '';
                             if (!this.email) {
                                 this.error = 'Please enter your email.';
                                 return;
                             }
                             if (!this.validateEmail(this.email)) {
                                 this.error = 'Please enter a valid email address.';
                                 return;
                             }
                             this.loading = true;
                             // Simulate API Call
                             setTimeout(() => {
                                 this.loading = false;
                                 this.subscribed = true;
                                 this.email = '';
                             }, 1000);
                         }
                     }">
                    <h5 class="text-white text-[10px] uppercase tracking-wider font-semibold mb-2.5">Stay Updated</h5>
                    
                    <!-- Form Container -->
                    <div x-show="!subscribed" class="flex flex-col gap-2">
                        <div class="relative flex items-center">
                            <input type="email" 
                                   x-model="email"
                                   @keydown.enter="submitSubscription"
                                   placeholder="Your email address" 
                                   class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-white/40 focus:outline-none focus:border-accent focus:bg-white/10 transition-all font-sans"
                                   aria-label="Newsletter email">
                            <button @click="submitSubscription" 
                                    class="absolute right-1 px-3 py-1.5 rounded-lg bg-accent text-primary font-bold text-xs hover:bg-accent-light transition-colors flex items-center justify-center cursor-pointer"
                                    aria-label="Subscribe button">
                                <span x-show="!loading">Join</span>
                                <!-- Simple SVG loader -->
                                <svg x-show="loading" x-cloak class="animate-spin h-3.5 w-3.5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </button>
                        </div>
                        <!-- Error message -->
                        <p x-show="error" x-cloak x-transition class="text-rose-400 text-[10px] font-sans mt-0.5" x-text="error"></p>
                    </div>
                    
                    <!-- Success message -->
                    <div x-show="subscribed" x-cloak x-transition class="bg-emerald-500/15 border border-emerald-500/20 rounded-xl p-3 flex items-start gap-2.5">
                        <div class="w-5.5 h-5.5 rounded-full bg-emerald-500/20 flex items-center justify-center text-emerald-400 flex-shrink-0">
                            <i data-lucide="check" class="w-3 h-3"></i>
                        </div>
                        <div>
                            <p class="text-white text-[11px] font-semibold">Subscribed!</p>
                            <p class="text-white/60 text-[9px] mt-0.5">Thank you for subscribing.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bottom Bar & ISO Badges -->
    <div class="border-t border-white/10 mt-10 sm:mt-12 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 sm:py-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-white/60 text-xs text-center md:text-left font-sans">
                    &copy; {{ date('Y') }} Pushpraj Construction. Designed with excellence. All rights reserved.
                </p>
                
                <!-- Certifications Pill Badges -->
                <div class="flex flex-wrap items-center justify-center gap-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/5 border border-white/10 hover:border-accent/40 text-white/80 text-[10px] uppercase tracking-wider font-semibold font-sans transition-all duration-300">
                        <i data-lucide="award" class="w-3.5 h-3.5 text-accent animate-pulse"></i>
                        <span>ISO 9001:2015</span>
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/5 border border-white/10 hover:border-accent/40 text-white/80 text-[10px] uppercase tracking-wider font-semibold font-sans transition-all duration-300">
                        <i data-lucide="shield-check" class="w-3.5 h-3.5 text-accent animate-pulse"></i>
                        <span>ISO 45001:2018</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top Button with continuous pulse ring -->
    <button @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="fixed bottom-6 right-6 w-11 h-11 rounded-full bg-accent text-primary flex items-center justify-center shadow-2xl transition-all duration-300 z-50 hover:scale-110 active:scale-95 group cursor-pointer"
            :class="showBackToTop ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4 pointer-events-none'"
            aria-label="Back to top">
        <!-- Pulse Ring -->
        <span class="absolute inset-0 rounded-full bg-accent/30 animate-ping group-hover:animate-none pointer-events-none"></span>
        <i data-lucide="arrow-up" class="w-5 h-5 relative z-10 transition-transform duration-300 group-hover:-translate-y-1"></i>
    </button>
</footer>
