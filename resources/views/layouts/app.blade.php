<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pushpraj Construction | Civil & Infrastructure Experts Since 2005')</title>
    <meta name="description" content="@yield('meta_description', 'Leading construction company in Gujarat specializing in industrial projects, highways, bridges, EPC contracts, and infrastructure development. 17+ years of excellence.')">
    
    @php
        $siteSetting = \App\Models\Setting::first();
    @endphp
    @if($siteSetting && $siteSetting->favicon)
        <link rel="icon" href="{{ asset($siteSetting->favicon) }}">
    @endif
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Inline Premium Page Loader Styles -->
    <style>
        #page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #0b1528; /* Premium Deep Navy */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 99999;
            opacity: 1;
            visibility: visible;
            transition: opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        #page-loader.fade-out {
            opacity: 0;
            visibility: hidden;
        }
        .loader-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 100px;
            margin-bottom: 24px;
        }
        .loader-circle {
            position: absolute;
            border-radius: 50%;
            border: 3px solid transparent;
        }
        .loader-circle-outer {
            width: 90px;
            height: 90px;
            border-top-color: #d97706; /* Gold/Amber */
            border-bottom-color: #3b82f6; /* Premium Blue */
            animation: loader-spin 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        }
        .loader-circle-inner {
            width: 70px;
            height: 70px;
            border-left-color: #fbbf24; /* Soft Gold */
            border-right-color: #60a5fa; /* Soft Blue */
            animation: loader-spin-reverse 1s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        }
        .loader-brand {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 1px;
            animation: loader-pulse 1.5s ease-in-out infinite;
        }
        .loader-title {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 8px;
            margin-bottom: 4px;
            text-align: center;
        }
        .loader-subtitle {
            font-family: 'Inter', sans-serif;
            font-size: 9px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.4);
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-bottom: 20px;
            text-align: center;
        }
        .loader-progress-bg {
            width: 160px;
            height: 2px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 9999px;
            overflow: hidden;
        }
        .loader-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #3b82f6, #d97706);
            border-radius: 9999px;
            width: 0%;
            animation: loader-bar-grow 2.5s cubic-bezier(0.1, 0.8, 0.1, 1) forwards;
        }
        @keyframes loader-spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @keyframes loader-spin-reverse {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(-360deg); }
        }
        @keyframes loader-pulse {
            0%, 100% { opacity: 0.6; transform: scale(0.95); }
            50% { opacity: 1; transform: scale(1.05); }
        }
        @keyframes loader-bar-grow {
            0% { width: 0%; }
            50% { width: 70%; }
            100% { width: 100%; }
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-foreground antialiased" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 50)">

    <!-- Premium Page Loader -->
    <div id="page-loader">
        <div class="loader-container">
            <div class="loader-circle loader-circle-outer"></div>
            <div class="loader-circle loader-circle-inner"></div>
            <div class="loader-brand">PRC</div>
        </div>
        <div class="loader-title">Pushpraj Construction</div>
        <div class="loader-subtitle">Building Excellence Since 2005</div>
        <div class="loader-progress-bg">
            <div class="loader-progress-bar"></div>
        </div>
    </div>

    <!-- Script to handle loader dismiss -->
    <script>
        (function() {
            function dismissLoader() {
                const loader = document.getElementById('page-loader');
                if (loader && !loader.classList.contains('fade-out')) {
                    loader.classList.add('fade-out');
                    // Remove from document layout after animation completes
                    setTimeout(() => {
                        loader.style.display = 'none';
                    }, 500);
                }
            }

            // Dismiss when fully loaded
            window.addEventListener('load', dismissLoader);

            // Safety fallback: dismiss loader after 4 seconds regardless
            setTimeout(dismissLoader, 4000);
        })();
    </script>

    @include('partials.navbar')
    
    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Initialize Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
