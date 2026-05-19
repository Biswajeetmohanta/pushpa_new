@php
// Dynamically build sectors from the projects collection
$sectors = ['All'];
if (isset($projects) && $projects->count() > 0) {
    $uniqueSectors = $projects->pluck('sector')->filter()->unique();
    foreach($uniqueSectors as $sec) {
        $sectors[] = $sec;
    }
} else {
    // Empty placeholder fallback
    $projects = collect([]);
}
$displayProjects = isset($limit) ? $projects->take($limit) : $projects;
@endphp

<section id="projects" class="section-padding bg-muted" x-data="{ isVisible: false, activeSector: 'All', selectedProject: null, isModalOpen: false }" x-intersect.once="isVisible = true">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
            <div class="accent-line mx-auto mb-4 sm:mb-6"></div>
            <p class="text-accent font-semibold tracking-wider uppercase mb-2 sm:mb-3 text-sm">
                Our Portfolio
            </p>
            <h2 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-primary mb-4 sm:mb-6">
                Featured Projects
            </h2>
            <p class="text-muted-foreground text-base sm:text-lg px-2 font-sans">
                Explore our portfolio of successfully completed projects across industrial and infrastructure sectors.
            </p>
        </div>

        <!-- Sector Filter -->
        @if(!isset($hideFilter) || !$hideFilter)
        <div class="flex flex-wrap justify-center gap-2 sm:gap-4 mb-8 sm:mb-12">
            @foreach($sectors as $sector)
                <button @click="activeSector = '{{ $sector }}'"
                        class="px-4 sm:px-6 py-1.5 sm:py-2 rounded-full font-medium transition-all text-sm cursor-pointer"
                        :class="activeSector === '{{ $sector }}' ? 'bg-primary text-white' : 'bg-white text-muted-foreground hover:bg-primary/10'">
                    {{ $sector }}
                </button>
            @endforeach
        </div>
        @endif

        <!-- Projects Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 md:gap-10">
            @forelse($displayProjects as $index => $project)
                <div @if(!isset($hideFilter) || !$hideFilter) x-show="activeSector === 'All' || activeSector === '{{ $project->sector }}'" @endif
                     @if(!isset($hideFilter) || !$hideFilter)
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     @endif
                     class="group bg-white rounded-2xl overflow-hidden shadow-lg card-hover transition-all duration-1000 opacity-0"
                     :class="isVisible ? 'animate-fade-in-up opacity-100' : ''"
                     style="animation-delay: {{ $index * 100 }}ms">
                     
                    <!-- Image -->
                    <div class="relative h-48 sm:h-56 md:h-64 image-zoom overflow-hidden">
                        @if($project->image)
                            <img src="{{ $project->image }}" alt="{{ $project->title }}" class="w-full h-full object-cover" />
                        @else
                            <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400">
                                <i data-lucide="image" class="w-12 h-12"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-4 left-4 right-4 transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                            <span class="inline-block bg-accent text-primary text-xs font-semibold px-3 py-1 rounded-full capitalize">
                                {{ $project->sector }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 sm:p-8 flex flex-col justify-between">
                        <div>
                            <!-- Title in Capitalized Bold Style -->
                            <h3 class="font-sans text-base sm:text-lg font-bold text-slate-800 uppercase tracking-wide mb-5 line-clamp-2 min-h-[3rem]">
                                {{ $project->title }}
                            </h3>
                            
                            <!-- Premium Spec List matching User screenshot -->
                            <div class="space-y-4">
                                <!-- Client -->
                                <div class="flex items-center gap-3 text-sm">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    </div>
                                    <div class="font-sans text-xs">
                                        <span class="text-slate-800 font-bold">Client:</span>
                                        <span class="text-slate-600 ml-1">{{ $project->client ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                
                                <!-- Location -->
                                <div class="flex items-center gap-3 text-sm">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                    </div>
                                    <div class="font-sans text-xs">
                                        <span class="text-slate-800 font-bold">Location:</span>
                                        <span class="text-slate-600 ml-1">{{ $project->location }}</span>
                                    </div>
                                </div>

                                <!-- Sector -->
                                <div class="flex items-center gap-3 text-sm">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 20h20"/><path d="M5 17V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v10"/><path d="M9 9h6"/><path d="M9 13h6"/></svg>
                                    </div>
                                    <div class="font-sans text-xs">
                                        <span class="text-slate-800 font-bold">Sector:</span>
                                        <span class="text-slate-600 ml-1">{{ $project->sector ?? 'N/A' }}</span>
                                    </div>
                                </div>

                                <!-- Project Value -->
                                <div class="flex items-center gap-3 text-sm">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="1" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                                    </div>
                                    <div class="font-sans text-xs">
                                        <span class="text-slate-800 font-bold">Value:</span>
                                        <span class="text-slate-600 ml-1">{{ $project->value ?? 'N/A' }}</span>
                                    </div>
                                </div>

                                <!-- Timeline -->
                                <div class="flex items-center gap-3 text-sm">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    </div>
                                    <div class="font-sans text-xs">
                                        <span class="text-slate-800 font-bold">Timeline:</span>
                                        <span class="text-slate-600 ml-1">{{ $project->timeline ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- View Details Modal Action Button -->
                        <div class="mt-6 pt-5 border-t border-slate-100">
                            <button @click="selectedProject = {{ json_encode($project) }}; isModalOpen = true" 
                                    class="w-full inline-flex items-center justify-center gap-2 bg-primary text-white font-bold text-xs sm:text-sm px-4 py-2.5 rounded-xl hover:bg-accent hover:text-primary transition-all duration-300 shadow-md cursor-pointer group/btn">
                                <span>View Details</span>
                                <svg class="w-4 h-4 transition-transform duration-300 group-hover/btn:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-slate-400">
                    <i data-lucide="folder-open" class="w-12 h-12 mx-auto mb-3 text-slate-300"></i>
                    <p class="text-sm">No projects currently available.</p>
                </div>
            @endforelse
        </div>

        <!-- View All CTA -->
        @if(isset($limit) && $projects->count() > $limit)
        <div class="text-center mt-12">
            <a href="{{ route('projects') }}" class="btn-primary inline-flex items-center gap-2">
                View All Projects
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
        @endif
    </div>

    <!-- Beautiful Responsive Modal for Full Project Details -->
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
             class="relative z-10 w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row max-h-[85vh] md:max-h-[80vh]">
            
            <!-- Close Button -->
            <button @click="isModalOpen = false" 
                    class="absolute top-4 right-4 z-20 w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 hover:text-slate-900 flex items-center justify-center transition-colors shadow-sm cursor-pointer"
                    aria-label="Close modal">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
            
            <!-- Left Side: Large Image -->
            <div class="relative w-full md:w-1/2 h-48 sm:h-64 md:h-auto flex-shrink-0">
                <img :src="selectedProject?.image" :alt="selectedProject?.title" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent"></div>
            </div>
            
            <!-- Right Side: Details & Description -->
            <div class="w-full md:w-1/2 p-6 sm:p-8 flex flex-col overflow-y-auto">
                <div class="flex-1">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-blue-50 text-blue-700 uppercase tracking-wider mb-3" x-text="selectedProject?.sector"></span>
                    <h3 class="font-sans text-xl sm:text-2xl font-bold text-slate-900 leading-tight mb-4 uppercase" x-text="selectedProject?.title"></h3>
                    
                    <!-- Quick Info Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6 border-y border-slate-100 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                            <div class="font-sans text-xs">
                                <p class="text-slate-500 font-medium">Client</p>
                                <p class="text-slate-800 font-bold" x-text="selectedProject?.client || 'N/A'"></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div class="font-sans text-xs">
                                <p class="text-slate-500 font-medium">Location</p>
                                <p class="text-slate-800 font-bold" x-text="selectedProject?.location"></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 20h20"/><path d="M5 17V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v10"/><path d="M9 9h6"/><path d="M9 13h6"/></svg>
                            </div>
                            <div class="font-sans text-xs">
                                <p class="text-slate-500 font-medium">Sector</p>
                                <p class="text-slate-800 font-bold" x-text="selectedProject?.sector || 'N/A'"></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="1" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                            </div>
                            <div class="font-sans text-xs">
                                <p class="text-slate-500 font-medium">Project Value</p>
                                <p class="text-slate-800 font-bold" x-text="selectedProject?.value || 'N/A'"></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <div class="font-sans text-xs">
                                <p class="text-slate-500 font-medium">Timeline</p>
                                <p class="text-slate-800 font-bold" x-text="selectedProject?.timeline || 'N/A'"></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Long Description -->
                    <div class="mt-4">
                        <h4 class="font-sans font-semibold text-slate-800 text-sm mb-2">Project Overview & Scope:</h4>
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed font-sans" x-text="selectedProject?.description"></p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
