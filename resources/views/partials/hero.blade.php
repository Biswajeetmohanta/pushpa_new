@php
$slides = [];
$featuredProjects = \App\Models\Project::where('is_active', 1)->whereNotNull('image')->orderBy('created_at', 'desc')->take(3)->get();
if ($featuredProjects->count() > 0) {
    foreach ($featuredProjects as $project) {
        $slides[] = [
            "image" => $project->image,
            "title" => $project->title,
            "subtitle" => $project->sector ?? 'Engineering Excellence',
            "description" => \Str::limit($project->description, 120),
        ];
    }
} else {
    // Fallback static slides in case the database is empty
    $slides = [
      [
        "image" => "https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=1920&q=80",
        "title" => "Building Excellence",
        "subtitle" => "Since 2005",
        "description" => "Leading construction company delivering world-class infrastructure projects across Gujarat",
      ],
      [
        "image" => "https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1920&q=80",
        "title" => "Industrial Projects",
        "subtitle" => "Engineering Excellence",
        "description" => "Specialized in industrial construction, factories, and manufacturing facilities",
      ],
      [
        "image" => "https://images.unsplash.com/photo-1545558014-8692077e9b5c?w=1920&q=80",
        "title" => "Infrastructure Development",
        "subtitle" => "Highways & Bridges",
        "description" => "Connecting communities through robust highway and bridge construction",
      ],
    ];
}

$setting = $setting ?? \App\Models\Setting::firstOrCreate([], [
    'experience_start_year' => 2005,
    'years_experience' => '21+',
    'projects_completed' => '150+',
    'annual_turnover' => '14Cr+',
    'client_satisfaction' => '100%',
]);

$stats = [
  [ "value" => $setting->years_experience, "label" => "Years Experience" ],
  [ "value" => $setting->projects_completed, "label" => "Projects Completed" ],
  [ "value" => $setting->annual_turnover, "label" => "Annual Turnover" ],
  [ "value" => $setting->client_satisfaction, "label" => "Client Satisfaction" ],
];
@endphp

<section id="home" class="relative min-h-[100dvh] overflow-hidden" 
    x-data="{ 
        currentSlide: 0, 
        totalSlides: {{ count($slides) }},
        nextSlide() { this.currentSlide = (this.currentSlide + 1) % this.totalSlides; },
        prevSlide() { this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides; }
    }" 
    x-init="setInterval(() => { nextSlide() }, 6000)">
    
    <!-- Slide Backgrounds -->
    @foreach($slides as $index => $slide)
        <div class="absolute inset-0 transition-opacity duration-1000"
             :class="currentSlide === {{ $index }} ? 'opacity-100 z-[1]' : 'opacity-0 z-0'">
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $slide['image'] }}')"></div>
            <div class="gradient-overlay absolute inset-0"></div>
        </div>
    @endforeach

    <!-- Content -->
    <div class="relative z-10 min-h-[100dvh] flex flex-col">
        <!-- Main hero content -->
        <div class="flex-grow flex items-center py-24 sm:py-28 md:py-32">
            <div class="w-full max-w-7xl mx-auto px-4 sm:px-6">
                <div class="max-w-3xl">
                    @foreach($slides as $index => $slide)
                        <div x-show="currentSlide === {{ $index }}" 
                             x-transition:enter="transition ease-out duration-700" 
                             x-transition:enter-start="opacity-0 translate-y-8" 
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-300 absolute inset-0" 
                             x-transition:leave-start="opacity-100" 
                             x-transition:leave-end="opacity-0"
                             style="display: none;"
                             x-cloak>
                            <!-- Accent Line -->
                            <div class="accent-line mb-4 sm:mb-6"></div>

                            <!-- Subtitle -->
                            <p class="text-accent font-semibold tracking-wider uppercase mb-3 sm:mb-4 text-sm sm:text-base">
                                {{ $slide['subtitle'] }}
                            </p>

                            <!-- Title -->
                            <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-bold text-white mb-4 sm:mb-6 leading-tight">
                                {{ $slide['title'] }}
                            </h1>

                            <!-- Description -->
                            <p class="text-base sm:text-lg md:text-xl text-white/90 mb-6 sm:mb-8 max-w-xl leading-relaxed">
                                {{ $slide['description'] }}
                            </p>

                            <!-- CTA Buttons -->
                            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                                <a href="#projects" class="btn-primary inline-flex items-center justify-center gap-2">
                                    View Our Projects
                                    <i data-lucide="arrow-right" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                </a>
                                <a href="#contact" class="btn-outline inline-flex items-center justify-center">
                                    Contact Us
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Stats Bar - anchored to bottom -->
        <div class="bg-primary/95 backdrop-blur-sm border-t border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="grid grid-cols-2 md:grid-cols-4">
                    @foreach($stats as $index => $stat)
                        <div class="py-4 sm:py-5 md:py-8 text-center {{ $index < 2 ? 'border-b md:border-b-0' : '' }} {{ $index % 2 === 0 ? 'border-r' : 'md:border-r' }} border-white/15 last:border-r-0">
                            <div class="text-xl sm:text-2xl md:text-4xl font-bold text-accent mb-0.5 sm:mb-1"
                                 x-data="{ 
                                    current: 0, 
                                    target: {{ (int) preg_replace('/[^0-9]/', '', $stat['value']) }}, 
                                    suffix: '{{ preg_replace('/[0-9]/', '', $stat['value']) }}',
                                    duration: 1500,
                                    startCounter() {
                                        let start = null;
                                        const step = (timestamp) => {
                                            if (!start) start = timestamp;
                                            const progress = timestamp - start;
                                            const percent = Math.min(progress / this.duration, 1);
                                            const ease = percent * (2 - percent);
                                            this.current = Math.floor(ease * this.target);
                                            if (progress < this.duration) {
                                                window.requestAnimationFrame(step);
                                            } else {
                                                this.current = this.target;
                                            }
                                        };
                                        window.requestAnimationFrame(step);
                                    }
                                 }"
                                 x-init="
                                    const observer = new IntersectionObserver((entries) => {
                                        if (entries[0].isIntersecting) {
                                            startCounter();
                                            observer.disconnect();
                                        }
                                    }, { threshold: 0.1 });
                                    observer.observe($el);
                                 ">
                                <span x-text="current">0</span><span x-text="suffix"></span>
                            </div>
                            <div class="text-[10px] sm:text-xs md:text-sm text-white/80">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Arrows - desktop only -->
    <button @click="prevSlide()" class="absolute left-6 md:left-8 top-1/2 -translate-y-1/2 z-20 w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/10 backdrop-blur-sm items-center justify-center text-white hover:bg-accent hover:text-primary transition-all hidden md:flex" aria-label="Previous slide">
        <i data-lucide="chevron-left" class="w-5 h-5 md:w-6 md:h-6"></i>
    </button>
    <button @click="nextSlide()" class="absolute right-6 md:right-8 top-1/2 -translate-y-1/2 z-20 w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/10 backdrop-blur-sm items-center justify-center text-white hover:bg-accent hover:text-primary transition-all hidden md:flex" aria-label="Next slide">
        <i data-lucide="chevron-right" class="w-5 h-5 md:w-6 md:h-6"></i>
    </button>

    <!-- Slide Indicators -->
    <div class="absolute bottom-24 sm:bottom-28 md:bottom-32 left-1/2 -translate-x-1/2 z-20 flex gap-2">
        @foreach($slides as $index => $slide)
            <button @click="currentSlide = {{ $index }}" 
                    class="w-2.5 h-2.5 rounded-full transition-all"
                    :class="currentSlide === {{ $index }} ? 'bg-accent w-6 sm:w-8' : 'bg-white/50 hover:bg-white/80'"
                    aria-label="Go to slide {{ $index + 1 }}">
            </button>
        @endforeach
    </div>
</section>
