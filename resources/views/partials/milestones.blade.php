@php
if (!isset($milestones)) {
    $milestones = collect([]);
}
@endphp

<section id="milestones" class="section-padding bg-primary text-white" x-data="{ isVisible: false }" x-intersect.once="isVisible = true">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-16">
            <div class="accent-line mx-auto mb-4 sm:mb-6"></div>
            <p class="text-accent font-semibold tracking-wider uppercase mb-2 sm:mb-3 text-sm">
                Our Journey
            </p>
            <h2 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold mb-4 sm:mb-6">
                Milestones & Achievements
            </h2>
            <p class="text-white/80 text-base sm:text-lg px-2">
                A timeline of our growth, achievements, and commitment to excellence
                over the years.
            </p>
        </div>

        <!-- Timeline -->
        <div class="relative">
            <!-- Timeline Line -->
            <div class="absolute left-6 md:left-1/2 transform -translate-x-1/2 h-full w-0.5 bg-accent/30"></div>

            <!-- Milestones -->
            <div class="space-y-12">
                @forelse($milestones as $index => $milestone)
                    <div class="relative flex flex-col md:flex-row items-start md:items-center gap-6 md:gap-8 {{ $index % 2 === 0 ? 'md:flex-row' : 'md:flex-row-reverse' }} transition-all duration-1000 opacity-0"
                         :class="isVisible ? 'animate-fade-in-up opacity-100' : ''"
                         style="animation-delay: {{ $index * 150 }}ms">
                         
                        <!-- Content -->
                        <div class="w-full md:w-1/2 pl-12 md:pl-0 {{ $index % 2 === 0 ? 'md:text-right' : 'md:text-left' }}">
                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 {{ $index % 2 === 0 ? 'md:ml-auto' : 'md:mr-auto' }} max-w-md">
                                <span class="text-accent font-bold text-lg">
                                    {{ $milestone->year }}
                                </span>
                                <h3 class="font-serif text-xl font-bold mt-2 mb-3">
                                    {{ $milestone->title }}
                                </h3>
                                <p class="text-white/70 text-sm leading-relaxed">{{ $milestone->description }}</p>
                            </div>
                        </div>

                        <!-- Center Dot (Always positioned exactly on the vertical line) -->
                        <div class="absolute left-6 md:left-1/2 transform -translate-x-1/2 z-10 w-5 h-5 rounded-full bg-accent border-4 border-primary flex-shrink-0"></div>

                        <!-- Empty Space for Alignment on Desktop -->
                        <div class="w-full md:w-1/2 hidden md:block"></div>
                    </div>
                @empty
                    <div class="text-center py-12 text-white/50">
                        <i data-lucide="milestone" class="w-12 h-12 mx-auto mb-3 text-white/30"></i>
                        <p class="text-sm">No milestones currently available.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
