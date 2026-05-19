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
@endphp

@extends('layouts.app')

@section('title', 'Pushpraj Construction | Civil & Infrastructure Experts Since 2005')
@section('meta_description', 'Leading construction company in Gujarat specializing in industrial projects, highways, bridges, EPC contracts, and infrastructure development. 17+ years of excellence with 150+ completed projects.')

@section('content')
    <!-- Homepage Hero Slider -->
    @include('partials.hero')
    
    <!-- Corporate Summary -->
    @include('partials.about')
    
    <!-- Key Engineering Services -->
    @include('partials.services', ['limit' => 3])
    
    <!-- Featured Projects Gallery -->
    @include('partials.projects', ['limit' => 3, 'hideFilter' => true])
    
    <!-- Journey Milestones Timeline -->
    @if(isset($milestones) && $milestones->count() > 0)
        @include('partials.milestones')
    @endif
    
    <!-- Certifications & Awards -->
    @include('partials.certifications', ['limit' => 4])
    
    <!-- Professional Leadership Team -->
    @include('partials.team', ['limit' => 3])
    
    <!-- Customer Testimonials -->
    @include('partials.testimonials')
    
    <!-- Corporate Contact Form -->
    @include('partials.contact')
@endsection
