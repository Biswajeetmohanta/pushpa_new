@php
if (!isset($teamMembers)) {
    $teamMembers = collect([]);
}
$displayTeamMembers = isset($limit) ? $teamMembers->take($limit) : $teamMembers;
@endphp

<section id="team" class="section-padding bg-white" x-data="{ isVisible: false, selectedMember: null, isModalOpen: false }" x-intersect.once="isVisible = true">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-16">
            <div class="accent-line mx-auto mb-4 sm:mb-6"></div>
            <p class="text-accent font-semibold tracking-wider uppercase mb-2 sm:mb-3 text-sm">
                Our People
            </p>
            <h2 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-primary mb-4 sm:mb-6">
                Meet the Expert Team
            </h2>
            <p class="text-muted-foreground text-base sm:text-lg px-2">
                Behind every successful project is our dedicated team of professionals who bring years of expertise and passion to their work.
            </p>
        </div>

        <!-- Team grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 md:gap-8">
            @forelse($displayTeamMembers as $index => $member)
                <div class="group bg-muted rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-1000 opacity-0 cursor-pointer hover:-translate-y-1 transform transition-all duration-300"
                     :class="isVisible ? 'animate-fade-in-up opacity-100' : ''"
                     style="animation-delay: {{ $index * 150 }}ms"
                     @click="selectedMember = {{ json_encode($member) }}; isModalOpen = true">
                    
                    <div class="relative h-44 sm:h-56 md:h-72 overflow-hidden">
                        @if($member->image)
                            <img src="{{ asset($member->image) }}" alt="{{ $member->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                        @else
                            <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                                <svg class="w-10 h-10 sm:w-16 sm:h-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                        @endif
                        
                        <!-- Social hover icons -->
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-4 sm:pb-6" @click.stop>
                            <div class="flex gap-2 sm:gap-4">
                                @if($member->linkedin)
                                    <a href="{{ $member->linkedin }}" target="_blank" class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white text-primary flex items-center justify-center hover:bg-accent hover:text-primary transition-all" title="LinkedIn">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                                    </a>
                                @endif
                                @if($member->facebook)
                                    <a href="{{ $member->facebook }}" target="_blank" class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white text-primary flex items-center justify-center hover:bg-accent hover:text-primary transition-all" title="Facebook">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                                    </a>
                                @endif
                                @if($member->twitter)
                                    <a href="{{ $member->twitter }}" target="_blank" class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white text-primary flex items-center justify-center hover:bg-accent hover:text-primary transition-all" title="Twitter">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
                                    </a>
                                @endif
                                @if($member->instagram)
                                    <a href="{{ $member->instagram }}" target="_blank" class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white text-primary flex items-center justify-center hover:bg-accent hover:text-primary transition-all" title="Instagram">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-3 sm:p-4 md:p-6 text-center border-b-4 border-transparent group-hover:border-accent transition-all">
                        <h3 class="font-serif text-sm sm:text-base md:text-xl font-bold text-primary mb-0.5 sm:mb-1 truncate">{{ $member->name }}</h3>
                        <p class="text-accent font-medium text-[10px] sm:text-xs md:text-sm uppercase tracking-wider truncate mb-2">{{ $member->role }}</p>
                        <span class="text-slate-400 group-hover:text-accent font-semibold text-[10px] sm:text-xs inline-flex items-center gap-1">
                            <span>View Bio</span>
                            <svg class="w-3 h-3 transition-transform duration-300 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-slate-400">
                    <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <p class="text-sm">No team members currently available.</p>
                </div>
            @endforelse
        </div>

        @if(isset($limit) && $teamMembers->count() > $limit)
            <div class="mt-12 text-center">
                <a href="{{ route('team') }}" class="btn-primary inline-flex items-center gap-2">
                    <span>View All Team Members</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        @endif
    </div>

    @if(!isset($limit))
        @php
            $setting = $setting ?? \App\Models\Setting::first();
            
            $managementList = [];
            if (!empty($setting->workforce_management)) {
                foreach (explode("\n", $setting->workforce_management) as $line) {
                    if (trim($line) !== '' && str_contains($line, ':')) {
                        $parts = explode(':', $line, 2);
                        $managementList[] = [
                            'label' => trim($parts[0]),
                            'count' => trim($parts[1])
                        ];
                    }
                }
            }

            $executionList = [];
            if (!empty($setting->workforce_execution)) {
                foreach (explode("\n", $setting->workforce_execution) as $line) {
                    if (trim($line) !== '' && str_contains($line, ':')) {
                        $parts = explode(':', $line, 2);
                        $executionList[] = [
                            'label' => trim($parts[0]),
                            'count' => trim($parts[1])
                        ];
                    }
                }
            }

            $labourList = [];
            if (!empty($setting->workforce_labour)) {
                foreach (explode("\n", $setting->workforce_labour) as $line) {
                    if (trim($line) !== '' && str_contains($line, ':')) {
                        $parts = explode(':', $line, 2);
                        $labourList[] = [
                            'label' => trim($parts[0]),
                            'count' => trim($parts[1])
                        ];
                    }
                }
            }
        @endphp

        <!-- Skilled & Dedicated Workforce Section -->
        <div class="mt-20 sm:mt-28 pt-16 pb-20 bg-gradient-to-b from-slate-50 to-slate-100/50 border-t border-slate-200/60 relative overflow-hidden">
            <!-- Decorative grid overlay -->
            <div class="absolute inset-0 opacity-[0.015] pointer-events-none bg-[radial-gradient(#0f2a4a_1px,transparent_1px)] [background-size:20px_20px]"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
                <!-- Header -->
                <div class="text-center max-w-4xl mx-auto mb-16">
                    <div class="w-8 h-8 rounded-full bg-accent/15 border border-accent/20 flex items-center justify-center text-primary font-bold text-lg mx-auto mb-5 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    </div>
                    <h3 class="font-serif text-2xl sm:text-3xl md:text-4xl font-bold text-primary tracking-wide uppercase mb-4">
                        {{ $setting->workforce_title ?? 'OUR SKILLED & DEDICATED WORKFORCE' }}
                    </h3>
                    <p class="text-muted-foreground text-sm sm:text-base leading-relaxed px-4">
                        {{ $setting->workforce_subtitle ?? 'Our success is driven by the collective strength and expertise of our large and diverse team. With over 3,300 dedicated professionals, we have the manpower and skill to execute projects of any scale and complexity.' }}
                    </p>
                </div>

                <!-- Three Column Grid -->
                <div class="grid md:grid-cols-3 gap-8 lg:gap-12 items-start">
                    
                    <!-- Column 1: Management & Engineering -->
                    <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-100 hover:shadow-md transition-shadow duration-300">
                        <h4 class="font-serif text-sm sm:text-base font-bold text-[#2e5aa6] tracking-wider uppercase mb-6 flex items-center gap-2 pb-3 border-b border-slate-100">
                            <svg class="w-4 h-4 text-accent" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            Management & Engineering
                        </h4>
                        <ul class="space-y-4">
                            @foreach($managementList as $item)
                                <li class="flex items-center justify-between text-xs sm:text-sm text-slate-700 hover:text-primary transition-colors py-0.5">
                                    <span class="font-medium">{{ $item['label'] }}</span>
                                    <span class="font-bold text-primary bg-slate-50 px-2.5 py-1 rounded-lg border border-slate-100">{{ $item['count'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Column 2: Site Execution & Supervision -->
                    <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-100 hover:shadow-md transition-shadow duration-300">
                        <h4 class="font-serif text-sm sm:text-base font-bold text-[#2e5aa6] tracking-wider uppercase mb-6 flex items-center gap-2 pb-3 border-b border-slate-100">
                            <svg class="w-4 h-4 text-accent" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M21 12H3M12 3v18"/></svg>
                            Site Execution & Supervision
                        </h4>
                        <ul class="space-y-4">
                            @foreach($executionList as $item)
                                <li class="flex items-center justify-between text-xs sm:text-sm text-slate-700 hover:text-primary transition-colors py-0.5">
                                    <span class="font-medium">{{ $item['label'] }}</span>
                                    <span class="font-bold text-primary bg-slate-50 px-2.5 py-1 rounded-lg border border-slate-100">{{ $item['count'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Column 3: Skilled & Unskilled Labour -->
                    <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-100 hover:shadow-md transition-shadow duration-300">
                        <h4 class="font-serif text-sm sm:text-base font-bold text-[#2e5aa6] tracking-wider uppercase mb-6 flex items-center gap-2 pb-3 border-b border-slate-100">
                            <svg class="w-4 h-4 text-accent" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                            Skilled & Unskilled Labour
                        </h4>
                        <ul class="space-y-4">
                            @php $isTotal = false; @endphp
                            @foreach($labourList as $item)
                                @php 
                                    $isTotal = str_contains(strtolower($item['label']), 'total');
                                @endphp
                                <li class="flex items-center justify-between text-xs sm:text-sm py-0.5 {{ $isTotal ? 'border-t border-dashed border-slate-200 pt-3 mt-3 text-primary font-bold' : 'text-slate-700 hover:text-primary transition-colors' }}">
                                    <span>{{ $item['label'] }}</span>
                                    <span class="font-bold {{ $isTotal ? 'text-accent bg-[#0f2a4a]' : 'text-primary bg-slate-50 border border-slate-100' }} px-2.5 py-1 rounded-lg">{{ $item['count'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    @endif

    <!-- Beautiful Responsive Modal for Full Team Member Details -->
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
            
            <!-- Left Side: Large Portrait Photo -->
            <div class="relative w-full md:w-1/2 h-56 sm:h-72 md:h-auto flex-shrink-0 bg-slate-50 border-b md:border-b-0 md:border-r border-slate-100 overflow-hidden">
                <template x-if="selectedMember?.image">
                    <img :src="'{{ asset('') }}' + selectedMember.image.replace(/^\//, '')" :alt="selectedMember?.name" class="w-full h-full object-cover">
                </template>
                <template x-if="!selectedMember?.image">
                    <div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-100">
                        <svg class="w-20 h-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                </template>
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent"></div>
            </div>
            
            <!-- Right Side: Details & Bio -->
            <div class="w-full md:w-1/2 p-6 sm:p-8 flex flex-col overflow-y-auto">
                <div class="flex-1">
                    <!-- Heading -->
                    <h3 class="font-serif text-2xl sm:text-3xl font-bold text-slate-900 uppercase leading-tight mb-1" x-text="selectedMember?.name"></h3>
                    <p class="text-accent font-semibold text-xs sm:text-sm uppercase tracking-wider mb-4" x-text="selectedMember?.role"></p>
                    
                    <!-- Biography / Description -->
                    <template x-if="selectedMember?.description">
                        <div class="mb-6">
                            <p class="text-slate-600 text-sm leading-relaxed whitespace-pre-line" x-text="selectedMember.description"></p>
                        </div>
                    </template>
                    
                    <!-- Qualifications & Accolades -->
                    <template x-if="selectedMember?.qualifications">
                        <div class="border-t border-slate-100 pt-5 mt-5">
                            <h4 class="font-sans text-xs font-bold text-[#2e5aa6] uppercase tracking-wider mb-4">Qualifications & Accolades:</h4>
                            
                            <div class="space-y-4">
                                <template x-for="(line, index) in (selectedMember.qualifications.split('\n').filter(l => l.trim() !== ''))" :key="index">
                                    <div class="flex items-center gap-3">
                                        <!-- Different custom icons for the first 4 indices, falling back to award -->
                                        <div class="w-8 h-8 rounded-lg bg-orange-50 flex items-center justify-center text-orange-600 flex-shrink-0">
                                            <template x-if="index === 0">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                                            </template>
                                            <template x-if="index === 1">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"/></svg>
                                            </template>
                                            <template x-if="index === 2">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                            </template>
                                            <template x-if="index === 3">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                                            </template>
                                            <template x-if="index >= 4">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                            </template>
                                        </div>
                                        
                                        <!-- Accolade text with first part bolded if containing a dash -->
                                        <div class="font-sans text-xs sm:text-sm text-slate-700 leading-snug">
                                            <template x-if="line.includes('-')">
                                                <span>
                                                    <span class="font-bold text-slate-800" x-text="line.split('-')[0].trim()"></span>
                                                    <span class="text-slate-600" x-text="'- ' + line.split('-').slice(1).join('-').trim()"></span>
                                                </span>
                                            </template>
                                            <template x-if="!line.includes('-')">
                                                <span class="font-bold text-slate-800" x-text="line.trim()"></span>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</section>
