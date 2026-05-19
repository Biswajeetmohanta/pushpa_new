@php
if (!isset($certifications)) {
    $certifications = collect([]);
}
$displayCertifications = isset($limit) ? $certifications->take($limit) : $certifications;
@endphp

<section id="certifications" class="section-padding bg-muted" x-data="{ isVisible: false, selectedCert: null, isModalOpen: false }" x-intersect.once="isVisible = true">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-16">
            <div class="accent-line mx-auto mb-4 sm:mb-6"></div>
            <p class="text-accent font-semibold tracking-wider uppercase mb-2 sm:mb-3 text-sm">
                Our Standards
            </p>
            <h2 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-primary mb-4 sm:mb-6">
                Certifications & Awards
            </h2>
            <p class="text-muted-foreground text-base sm:text-lg px-2">
                We adhere to international standards to ensure the highest quality of service and safety across all our projects.
            </p>
        </div>

        <!-- Certifications Cards Grid -->
        <div class="grid sm:grid-cols-2 gap-6 sm:gap-8 md:gap-12 max-w-5xl mx-auto">
            @forelse($displayCertifications as $index => $cert)
                <div class="group bg-white rounded-xl overflow-hidden shadow-lg flex flex-col sm:flex-row items-center p-5 sm:p-6 gap-4 sm:gap-6 cursor-pointer hover:shadow-2xl hover:-translate-y-1 transform transition-all duration-300 opacity-0"
                     :class="isVisible ? 'animate-slide-in-{{ $index % 2 === 0 ? 'left' : 'right' }} opacity-100' : ''"
                     @click="selectedCert = {{ json_encode($cert) }}; isModalOpen = true">
                    
                    <!-- Badge Icon / Image -->
                    <div class="w-24 h-24 sm:w-32 sm:h-32 flex-shrink-0 bg-primary/5 rounded-full p-3 sm:p-4 flex items-center justify-center border-4 border-accent group-hover:scale-105 transition-all duration-300">
                         @if($cert->image)
                             <img src="{{ asset($cert->image) }}" alt="{{ $cert->title }}" class="w-full h-full object-cover rounded-full" />
                         @else
                             <i data-lucide="award" class="w-10 h-10 sm:w-12 sm:h-12 text-accent"></i>
                         @endif
                    </div>

                    <!-- Details snippet -->
                    <div class="text-center sm:text-left flex-1">
                        <h3 class="font-serif text-xl sm:text-2xl font-bold text-primary mb-2">
                            {{ $cert->title }}
                        </h3>
                        <p class="text-muted-foreground text-sm leading-relaxed mb-2.5">
                            @if(!empty($cert->description_heading))
                                <strong class="font-semibold text-slate-800">{{ $cert->description_heading }}:</strong>
                            @endif
                            {{ \Illuminate\Support\Str::limit($cert->description, 120, '...') }}
                        </p>
                        <span class="text-accent group-hover:text-[#b4922f] font-semibold text-xs inline-flex items-center gap-1">
                            <span>View Details</span>
                            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-slate-400">
                    <i data-lucide="award" class="w-12 h-12 mx-auto mb-3 text-slate-300"></i>
                    <p class="text-sm">No certifications currently available.</p>
                </div>
            @endforelse
        </div>

        @if(isset($limit) && $certifications->count() > $limit)
            <div class="mt-12 text-center">
                <a href="{{ route('certifications') }}" class="btn-primary inline-flex items-center gap-2">
                    <span>View All Certifications</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        @endif
    </div>

    <!-- Beautiful Responsive Modal for Full Certification Details -->
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
             class="relative z-10 w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col sm:flex-row max-h-[85vh] sm:max-h-[70vh]">
            
            <!-- Close Button -->
            <button @click="isModalOpen = false" 
                    class="absolute top-4 right-4 z-20 w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 hover:text-slate-900 flex items-center justify-center transition-colors shadow-sm cursor-pointer"
                    aria-label="Close modal">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
            
            <!-- Left Side: Full Certificate Image (clickable to view full screen) -->
            <div class="relative w-full sm:w-2/5 h-48 sm:h-auto flex-shrink-0 bg-slate-50 border-b sm:border-b-0 sm:border-r border-slate-100 overflow-hidden">
                <template x-if="selectedCert?.image">
                    <a :href="selectedCert.image ? '{{ asset('') }}' + selectedCert.image.replace(/^\//, '') : '#'" target="_blank" title="Click to view full screen" class="block w-full h-full cursor-pointer hover:opacity-90 transition-opacity">
                        <img :src="'{{ asset('') }}' + selectedCert.image.replace(/^\//, '')" :alt="selectedCert?.title" class="w-full h-full object-cover">
                    </a>
                </template>
                <template x-if="!selectedCert?.image">
                    <div class="w-full h-full flex items-center justify-center text-accent bg-primary/5">
                        <i data-lucide="award" class="w-16 h-16"></i>
                    </div>
                </template>
            </div>
            
            <!-- Right Side: Details & Description -->
            <div class="w-full sm:w-3/5 p-6 sm:p-8 flex flex-col overflow-y-auto justify-center">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-accent/15 text-[#91711e] uppercase tracking-wider">Certified</span>
                    </div>
                    <h3 class="font-serif text-xl sm:text-2xl font-bold text-primary mb-3" x-text="selectedCert?.title"></h3>
                    
                    <div class="font-sans text-sm text-slate-700 leading-relaxed border-t border-slate-100 pt-4">
                        <template x-if="selectedCert?.description_heading">
                            <h4 class="font-bold text-slate-800 mb-2 text-base" x-text="selectedCert.description_heading"></h4>
                        </template>
                        <p class="text-slate-600 text-sm whitespace-pre-line leading-relaxed" x-text="selectedCert?.description"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
