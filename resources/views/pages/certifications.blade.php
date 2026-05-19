@extends('layouts.app')

@section('title', 'Certifications & Safety | Pushpraj Construction')
@section('meta_description', 'View the corporate certifications and quality standard awards of Pushpraj Construction. Registered under ISO 9001:2015 and ISO 45001:2018 for safety and excellence.')

@section('content')
<!-- Page Header Banner -->
<div class="relative bg-[#0f2a4a] text-white py-16 sm:py-24 overflow-hidden" 
     style="background: linear-gradient(180deg, #0f2a4a 0%, #0a1f38 100%);">
    <!-- Grid Overlay -->
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:20px_20px]"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 text-center">
        <nav class="flex justify-center gap-2 text-xs sm:text-sm uppercase tracking-wider font-semibold text-accent mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <span>/</span>
            <span class="text-white/60">Certifications</span>
        </nav>
        <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-white tracking-wide">
            Quality & Safety Certifications
        </h1>
        <p class="text-white/70 text-xs sm:text-sm mt-3 max-w-2xl mx-auto font-sans">
            Committed to international standards, premium engineering audits, and robust occupational safety.
        </p>
    </div>
</div>

<!-- Embedded Certifications Section -->
@include('partials.certifications')
@endsection
