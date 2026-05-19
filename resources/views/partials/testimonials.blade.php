@php
if (!isset($testimonials)) {
    $testimonials = collect([]);
}
@endphp

<section class="section-padding bg-white" x-data="{ 
    currentIndex: 0, 
    totalTestimonials: {{ $testimonials->count() }},
    isVisible: false,
    nextTestimonial() { this.currentIndex = (this.currentIndex + 1) % this.totalTestimonials; },
    prevTestimonial() { this.currentIndex = (this.currentIndex - 1 + this.totalTestimonials) % this.totalTestimonials; }
}" x-intersect.once="isVisible = true">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-16">
            <div class="accent-line mx-auto mb-4 sm:mb-6"></div>
            <p class="text-accent font-semibold tracking-wider uppercase mb-2 sm:mb-3 text-sm">
                Testimonials
            </p>
            <h2 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-primary mb-4 sm:mb-6">
                What Our Clients Say
            </h2>
            <p class="text-muted-foreground text-base sm:text-lg px-2">
                Don't just take our word for it. Here's what our valued clients
                have to say about working with us.
            </p>
        </div>

        @if($testimonials->count() > 0)
            <!-- Testimonial Carousel -->
            <div class="relative max-w-4xl mx-auto transition-all duration-1000 opacity-0"
                 :class="isVisible ? 'animate-fade-in-up opacity-100' : ''">
                 
                <!-- Quote Icon -->
                <div class="absolute -top-8 left-1/2 -translate-x-1/2 w-16 h-16 bg-accent rounded-full flex items-center justify-center z-10">
                    <i data-lucide="quote" class="w-8 h-8 text-primary fill-primary"></i>
                </div>

                <!-- Card -->
                <div class="bg-muted rounded-2xl p-5 sm:p-8 md:p-12 pt-12 sm:pt-16 text-center">
                    @foreach($testimonials as $index => $testimonial)
                        <div x-show="currentIndex === {{ $index }}"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-300 absolute inset-0"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             style="display: none;"
                             x-cloak>
                            
                            <!-- Stars -->
                            <div class="flex justify-center gap-1 mb-6">
                                @for($i = 0; $i < $testimonial->rating; $i++)
                                    <i data-lucide="star" class="w-6 h-6 fill-accent text-accent"></i>
                                @endfor
                            </div>

                            <!-- Text -->
                            <p class="text-lg md:text-xl text-foreground leading-relaxed mb-8">
                                "{{ $testimonial->text }}"
                            </p>

                            <!-- Author -->
                            <div class="flex flex-col items-center">
                                @if($testimonial->image)
                                    <img src="{{ $testimonial->image }}" alt="{{ $testimonial->name }}" class="w-16 h-16 rounded-full object-cover mb-4 border-4 border-accent" />
                                @else
                                    <div class="w-16 h-16 rounded-full bg-slate-100 border-4 border-accent flex items-center justify-center text-slate-400 mb-4">
                                        <i data-lucide="user" class="w-8 h-8"></i>
                                    </div>
                                @endif
                                <h4 class="font-serif text-xl font-bold text-primary">
                                    {{ $testimonial->name }}
                                </h4>
                                <p class="text-muted-foreground text-sm">
                                    {{ $testimonial->role }}{{ $testimonial->company ? ', ' . $testimonial->company : '' }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation -->
                <div class="flex justify-center gap-4 mt-8">
                    <button @click="prevTestimonial()" class="w-12 h-12 rounded-full border-2 border-primary flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all" aria-label="Previous testimonial">
                        <i data-lucide="chevron-left" class="w-6 h-6"></i>
                    </button>
                    <div class="flex items-center gap-2">
                        @foreach($testimonials as $index => $testimonial)
                            <button @click="currentIndex = {{ $index }}"
                                    class="w-3 h-3 rounded-full transition-all"
                                    :class="currentIndex === {{ $index }} ? 'bg-accent w-8' : 'bg-primary/30 hover:bg-primary/50'"
                                    aria-label="Go to testimonial {{ $index + 1 }}">
                            </button>
                        @endforeach
                    </div>
                    <button @click="nextTestimonial()" class="w-12 h-12 rounded-full border-2 border-primary flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all" aria-label="Next testimonial">
                        <i data-lucide="chevron-right" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
        @else
            <div class="text-center py-12 text-slate-400">
                <i data-lucide="message-square" class="w-12 h-12 mx-auto mb-3 text-slate-300"></i>
                <p class="text-sm">No testimonials currently available.</p>
            </div>
        @endif
    </div>
</section>
