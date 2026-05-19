@php
if (!isset($services)) {
    $services = collect([]);
}
$displayServices = isset($limit) ? $services->take($limit) : $services;
@endphp

<section id="services" class="section-padding bg-white" x-data="{ isVisible: false, selectedService: null, isModalOpen: false }" x-intersect.once="isVisible = true">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-16">
            <div class="accent-line mx-auto mb-4 sm:mb-6"></div>
            <p class="text-accent font-semibold tracking-wider uppercase mb-2 sm:mb-3 text-sm">
                What We Offer
            </p>
            <h2 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-primary mb-4 sm:mb-6">
                Our Construction Services
            </h2>
            <p class="text-muted-foreground text-base sm:text-lg px-2">
                We provide comprehensive construction solutions for industrial,
                infrastructure, and residential projects with unmatched quality and
                expertise.
            </p>
        </div>

        <!-- Services Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 md:gap-8">
            @forelse($displayServices as $index => $service)
                <div class="group bg-white border border-border rounded-xl p-5 sm:p-8 card-hover transition-all duration-1000 opacity-0"
                     :class="isVisible ? 'animate-fade-in-up opacity-100' : ''"
                     style="animation-delay: {{ $index * 100 }}ms">
                    
                    <!-- Icon -->
                    <div class="w-16 h-16 rounded-xl bg-primary/10 flex items-center justify-center mb-6 group-hover:bg-accent group-hover:scale-110 transition-all duration-300">
                        <i data-lucide="{{ $service->icon ?? 'briefcase' }}" class="w-8 h-8 text-primary group-hover:text-primary"></i>
                    </div>

                    <!-- Content -->
                    <h3 class="font-serif text-xl font-bold text-primary mb-3">
                        {{ $service->title }}
                    </h3>
                    <p class="text-muted-foreground mb-6 leading-relaxed">
                        {{ $service->description }}
                    </p>

                    <!-- Features Decoded -->
                    @php
                        $features = json_decode($service->features, true);
                    @endphp
                    @if(is_array($features) && count($features) > 0)
                        <ul class="space-y-2 mb-6">
                            @foreach($features as $feature)
                                <li class="flex items-center gap-2 text-sm text-muted-foreground">
                                    <div class="w-1.5 h-1.5 rounded-full bg-accent"></div>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <!-- Link -->
                    <button @click="selectedService = {{ json_encode($service) }}; isModalOpen = true" 
                            class="inline-flex items-center gap-2 text-primary font-semibold hover:text-accent transition-colors cursor-pointer group/btn">
                        <span>Learn More</span>
                        <i data-lucide="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover/btn:translate-x-1"></i>
                    </button>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-slate-400">
                    <i data-lucide="briefcase" class="w-12 h-12 mx-auto mb-3 text-slate-300"></i>
                    <p class="text-sm">No services currently available.</p>
                </div>
            @endforelse
        </div>

        @if(isset($limit) && $services->count() > $limit)
            <div class="mt-12 text-center">
                <a href="{{ route('services') }}" class="btn-primary inline-flex items-center gap-2">
                    <span>View All Services</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        @endif

        <!-- CTA Banner -->
        <div class="mt-16 bg-primary rounded-2xl p-8 md:p-12 text-center">
            <h3 class="font-serif text-2xl md:text-3xl font-bold text-white mb-4">
                Have a Project in Mind?
            </h3>
            <p class="text-white/80 mb-8 max-w-2xl mx-auto">
                Let's discuss how we can bring your construction vision to life with
                our expertise and commitment to excellence.
            </p>
            <a href="#contact" class="btn-primary inline-flex">
                Get Free Consultation
            </a>
        </div>
    </div>

    <!-- Beautiful Responsive Modal for Full Service Details -->
    <div x-show="isModalOpen" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 md:p-10"
         style="display: none;"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        
        <!-- Glass Backdrop overlay -->
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="isModalOpen = false"></div>
        
        <!-- Modal Window -->
        <div x-show="isModalOpen" 
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="relative z-10 w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col p-6 sm:p-8 max-h-[85vh] overflow-y-auto">
            
            <!-- Close Button -->
            <button @click="isModalOpen = false" 
                    class="absolute top-4 right-4 z-20 w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 hover:text-slate-900 flex items-center justify-center transition-colors shadow-sm cursor-pointer"
                    aria-label="Close modal">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
            
            <!-- Icon & Header -->
            <div class="flex items-center gap-4 border-b border-slate-100 pb-5 mb-5 mt-2">
                <div class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                    <i data-lucide="briefcase" class="w-7 h-7 text-accent"></i>
                </div>
                <div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-accent/20 text-primary uppercase tracking-wider mb-1 font-sans">Engineering Service</span>
                    <h3 class="font-serif text-xl sm:text-2xl font-bold text-[#0f2343] tracking-wide" x-text="selectedService?.title"></h3>
                </div>
            </div>

            <!-- Content Area -->
            <div class="space-y-6">
                <!-- Description -->
                <div>
                    <h4 class="font-sans font-semibold text-slate-800 text-sm mb-2">Service Overview:</h4>
                    <p class="text-slate-600 text-sm leading-relaxed font-sans" x-text="selectedService?.description"></p>
                </div>

                <!-- Features/Capabilities -->
                <div x-show="selectedService?.features && JSON.parse(selectedService.features).length > 0">
                    <h4 class="font-sans font-semibold text-slate-800 text-sm mb-3">Key Capabilities & Features:</h4>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <template x-if="selectedService?.features">
                            <template x-for="feature in JSON.parse(selectedService.features)">
                                <li class="flex items-start gap-2.5 text-sm text-slate-600 font-sans">
                                    <div class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                    </div>
                                    <span x-text="feature"></span>
                                </li>
                            </template>
                        </template>
                    </ul>
                </div>
            </div>

            <!-- Footer Action -->
            <div class="mt-8 pt-5 border-t border-slate-100 flex justify-end gap-3">
                <button type="button" @click="isModalOpen = false" class="px-5 py-2.5 rounded-lg border border-slate-200 text-slate-600 font-semibold hover:bg-slate-50 text-xs transition-colors font-sans cursor-pointer">
                    Close Details
                </button>
                <a href="#contact" @click="isModalOpen = false" class="px-5 py-2.5 rounded-lg bg-[#0f2343] hover:bg-primary text-white font-semibold text-xs flex items-center gap-1.5 shadow-sm hover:shadow-md transition-colors font-sans cursor-pointer">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2 11 13"/><path d="m22 2-7 20-4-9-9-4Z"/></svg>
                    <span>Enquire About Service</span>
                </a>
            </div>
            
        </div>
    </div>
</section>
