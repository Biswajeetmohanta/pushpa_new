@php
$setting = \App\Models\Setting::firstOrCreate([], [
    'about_subtitle' => 'About Us',
    'about_title' => "Building Gujarat's Future Since 2005",
    'about_description_1' => 'Pushpraj Construction is a leading civil and infrastructure company based in Gujarat, specializing in industrial projects, highways, bridges, and EPC contracts. With over 17 years of experience, we have successfully delivered 150+ projects with a commitment to quality and excellence.',
    'about_description_2' => 'Our team of expert engineers and skilled workforce ensures every project meets the highest standards of quality, safety, and sustainability. We are proud to be fully certified, reflecting our dedication to quality management and occupational health & safety.',
    'mission_title' => 'Our Mission',
    'mission_description' => 'To deliver exceptional construction services that exceed client expectations while maintaining the highest standards of quality and safety.',
    'vision_title' => 'Our Vision',
    'vision_description' => 'To be the most trusted construction company in Gujarat, known for innovation, reliability, and sustainable building practices.',
    'values_title' => 'Our Values',
    'values_description' => 'Integrity, excellence, teamwork, and customer satisfaction are the core values that guide everything we do.',
    'experience_start_year' => 2005,
    'years_experience' => '21+',
    'projects_completed' => '150+',
    'annual_turnover' => '14Cr+',
    'client_satisfaction' => '100%',
]);

$certTitles = \App\Models\Certification::limit(2)->pluck('title')->toArray();

$features = [];
foreach ($certTitles as $certTitle) {
    $features[] = $certTitle;
}
$features[] = $setting->years_experience . " Years Experience";
$features[] = $setting->projects_completed . " Projects Completed";
$features[] = "Expert Engineering Team";
$features[] = "On-Time Delivery";

$values = [
  [
    "icon" => "target",
    "title" => $setting->mission_title,
    "description" => $setting->mission_description,
  ],
  [
    "icon" => "award",
    "title" => $setting->vision_title,
    "description" => $setting->vision_description,
  ],
  [
    "icon" => "users",
    "title" => $setting->values_title,
    "description" => $setting->values_description,
  ],
];
@endphp

<section id="about" class="section-padding bg-muted" x-data="{ isVisible: false }" x-intersect.once="isVisible = true">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-20 items-center">
            <!-- Image Side -->
            <div class="relative transition-all duration-1000" :class="isVisible ? 'animate-slide-in-left opacity-100' : 'opacity-0'">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&q=80" alt="Construction site" class="rounded-lg shadow-2xl w-full" />
                    <!-- Experience Badge -->
                    <div class="absolute bottom-4 right-4 sm:-bottom-6 sm:-right-6 bg-accent text-primary p-5 sm:p-6 rounded-lg shadow-xl">
                        <div class="text-3xl sm:text-4xl font-bold"
                             x-data="{ 
                                current: 0, 
                                target: {{ (int) preg_replace('/[^0-9]/', '', $setting->years_experience) }}, 
                                suffix: '{{ preg_replace('/[0-9]/', '', $setting->years_experience) }}',
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
                        <div class="text-xs sm:text-sm font-semibold">Years of Excellence</div>
                    </div>
                </div>
                <!-- Decorative Element -->
                <div class="absolute -top-4 -left-4 w-24 h-24 border-4 border-accent rounded-lg -z-10 hidden sm:block"></div>
            </div>

            <!-- Content Side -->
            <div class="transition-all duration-1000" :class="isVisible ? 'animate-slide-in-right opacity-100' : 'opacity-0'">
                <div class="accent-line mb-6"></div>
                <p class="text-accent font-semibold tracking-wider uppercase mb-3">{{ $setting->about_subtitle }}</p>
                <h2 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-primary mb-4 sm:mb-6">
                    {{ $setting->about_title }}
                </h2>
                <p class="text-muted-foreground text-base sm:text-lg mb-4 sm:mb-6 leading-relaxed">
                    {{ $setting->about_description_1 }}
                </p>
                <p class="text-muted-foreground mb-8 leading-relaxed">
                    {{ $setting->about_description_2 }}
                </p>

                <!-- Features Grid -->
                <div class="grid grid-cols-2 gap-4 mb-8">
                    @foreach($features as $feature)
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full bg-accent/20 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="check" class="w-4 h-4 text-accent"></i>
                            </div>
                            <span class="text-sm font-medium">{{ $feature }}</span>
                        </div>
                    @endforeach
                </div>

                <!-- CTA -->
                <a href="#contact" class="btn-primary inline-flex">
                    Learn More About Us
                </a>
            </div>
        </div>

        <!-- Values -->
        <div class="grid md:grid-cols-3 gap-8 mt-20">
            @foreach($values as $index => $item)
                <div class="bg-white p-8 rounded-xl shadow-lg card-hover transition-all duration-1000 opacity-0"
                     :class="isVisible ? 'animate-fade-in-up animation-delay-{{ ($index + 1) * 200 }} opacity-100' : ''">
                    <div class="w-14 h-14 rounded-lg bg-primary/10 flex items-center justify-center mb-6">
                        <i data-lucide="{{ $item['icon'] }}" class="w-7 h-7 text-primary"></i>
                    </div>
                    <h3 class="font-serif text-xl font-bold text-primary mb-3">
                        {{ $item['title'] }}
                    </h3>
                    <p class="text-muted-foreground leading-relaxed">
                        {{ $item['description'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
