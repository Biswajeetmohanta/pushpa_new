@php
$setting = $setting ?? \App\Models\Setting::first();
$phoneDetails = array_filter([
    $setting->contact_phone_1 ?? '+91 98255 30295', 
    $setting->contact_phone_2 ?? '+91 98795 30295'
]);
$emailDetail = $setting->contact_email ?? 'pushprajconstruction9@gmail.com';
$addressLines = array_filter(explode("\n", str_replace("\r", "", $setting->contact_address ?? "Near Bhagwati Temple,\nChamunda Chowk, Botad,\nGujarat - 364710")));
$workingHoursLines = array_filter(explode(",", $setting->contact_working_hours ?? 'Mon - Sat: 9:00 AM - 6:00 PM, Sunday: Closed'));

$contactInfo = [
  [
    "icon" => "phone",
    "title" => "Phone",
    "details" => $phoneDetails,
    "link" => "tel:" . preg_replace('/[^0-9+]/', '', reset($phoneDetails)),
  ],
  [
    "icon" => "mail",
    "title" => "Email",
    "details" => [$emailDetail],
    "link" => "mailto:" . $emailDetail,
  ],
  [
    "icon" => "map-pin",
    "title" => "Address",
    "details" => $addressLines,
    "link" => "https://maps.google.com",
  ],
  [
    "icon" => "clock",
    "title" => "Working Hours",
    "details" => $workingHoursLines,
    "link" => null,
  ],
];
@endphp

<section id="contact" class="section-padding bg-muted" x-data="{ isVisible: false, isSubmitted: false }" x-intersect.once="isVisible = true">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-16">
            <div class="accent-line mx-auto mb-4 sm:mb-6"></div>
            <p class="text-accent font-semibold tracking-wider uppercase mb-2 sm:mb-3 text-sm">
                Get In Touch
            </p>
            <h2 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-primary mb-4 sm:mb-6">
                Contact Us
            </h2>
            <p class="text-muted-foreground text-base sm:text-lg px-2">
                Have a project in mind? Get in touch with us for a free consultation
                and let's discuss how we can help bring your vision to life.
            </p>
        </div>

        <div class="grid lg:grid-cols-5 gap-8 lg:gap-12">
            <!-- Contact Info -->
            <div class="lg:col-span-2 space-y-6 transition-all duration-1000 opacity-0"
                 :class="isVisible ? 'animate-slide-in-left opacity-100' : ''">
                @foreach($contactInfo as $info)
                    <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="{{ $info['icon'] }}" class="w-6 h-6 text-primary"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-primary mb-2">
                                    {{ $info['title'] }}
                                </h4>
                                @foreach($info['details'] as $index => $detail)
                                    <p class="text-muted-foreground text-sm">
                                        @if($info['link'] && $index === 0)
                                            <a href="{{ $info['link'] }}" class="hover:text-accent transition-colors">
                                                {{ $detail }}
                                            </a>
                                        @else
                                            {{ $detail }}
                                        @endif
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Map Placeholder -->
                <div class="bg-white rounded-xl overflow-hidden shadow-sm h-64">
                    <iframe src="{{ $setting->contact_map_iframe ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3698.0137307395694!2d71.66744731495468!3d22.17179398536744!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395958db0b9e1337%3A0x1947c42af93d6a3!2sBotad%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1620000000000!5m2!1sen!2sin' }}"
                            width="100%" height="100%" style="border: 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Pushpraj Construction Location"></iframe>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-3 transition-all duration-1000 opacity-0"
                 :class="isVisible ? 'animate-slide-in-right opacity-100' : ''">
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <h3 class="font-serif text-2xl font-bold text-primary mb-6">
                        Send Us a Message
                    </h3>

                    <template x-if="isSubmitted">
                        <div class="text-center py-12">
                            <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                            </div>
                            <h4 class="text-xl font-semibold text-primary mb-2">
                                Thank You!
                            </h4>
                            <p class="text-muted-foreground">
                                Your message has been sent successfully. We'll get back to
                                you soon.
                            </p>
                        </div>
                    </template>

                    <template x-if="!isSubmitted">
                        <form @submit.prevent="
                            fetch('{{ url('/contact') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(Object.fromEntries(new FormData($event.target)))
                            })
                            .then(async response => {
                                const data = await response.json();
                                if (response.ok && data.success) {
                                    isSubmitted = true;
                                    setTimeout(() => { isSubmitted = false; }, 5000);
                                    $event.target.reset();
                                } else {
                                    // Handle validation errors from Laravel
                                    let errorMsg = data.message || 'Please check your inputs.';
                                    if (data.errors) {
                                        errorMsg = Object.values(data.errors).flat().join('\n');
                                    }
                                    alert('Error:\n' + errorMsg);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('An unexpected error occurred. Please try again.');
                            })
                        " class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-foreground mb-2">Full Name *</label>
                                    <input type="text" id="name" name="name" required
                                           class="w-full px-4 py-3 rounded-lg border border-border focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                                           placeholder="Your Name" />
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-foreground mb-2">Email Address *</label>
                                    <input type="email" id="email" name="email" required
                                           class="w-full px-4 py-3 rounded-lg border border-border focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                                           placeholder="your@email.com" />
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-foreground mb-2">Phone Number *</label>
                                    <input type="tel" id="phone" name="phone" required
                                           class="w-full px-4 py-3 rounded-lg border border-border focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                                           placeholder="+91 XXXXX XXXXX" />
                                </div>
                                <div>
                                    <label for="service" class="block text-sm font-medium text-foreground mb-2">Service Interested In</label>
                                    <select id="service" name="service"
                                            class="w-full px-4 py-3 rounded-lg border border-border focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all bg-white">
                                        <option value="">Select a Service</option>
                                        <option value="industrial">Industrial Construction</option>
                                        <option value="highways">Highways & Roads</option>
                                        <option value="bridges">Bridges & Flyovers</option>
                                        <option value="epc">EPC Contracts</option>
                                        <option value="water">Water Management</option>
                                        <option value="residential">Residential Projects</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-medium text-foreground mb-2">Your Message *</label>
                                <textarea id="message" name="message" required rows="5"
                                          class="w-full px-4 py-3 rounded-lg border border-border focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all resize-none"
                                          placeholder="Tell us about your project..."></textarea>
                            </div>

                            <button type="submit" class="btn-primary w-full flex items-center justify-center gap-2">
                                Send Message
                                <i data-lucide="send" class="w-5 h-5"></i>
                            </button>
                        </form>
                    </template>
                </div>
            </div>
        </div>
    </div>
</section>
