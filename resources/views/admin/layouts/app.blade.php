<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Pushpraj Construction</title>
    
    @php
        $siteSetting = \App\Models\Setting::first();
    @endphp
    @if($siteSetting && $siteSetting->favicon)
        <link rel="icon" href="{{ asset($siteSetting->favicon) }}">
    @endif
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Laravel Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
        }
        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        /* Inline Premium Page Loader Styles */
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
            font-family: 'Outfit', sans-serif;
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
            animation: loader-bar-grow 2s cubic-bezier(0.1, 0.8, 0.1, 1) forwards;
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
</head>
<body class="min-h-screen text-slate-800 overflow-x-hidden" x-data="{ sidebarOpen: true, mobileSidebarOpen: false }">

    <!-- Premium Page Loader -->
    <div id="page-loader">
        <div class="loader-container">
            <div class="loader-circle loader-circle-outer"></div>
            <div class="loader-circle loader-circle-inner"></div>
            <div class="loader-brand">PRC</div>
        </div>
        <div class="loader-title">Pushpraj Construction</div>
        <div class="loader-subtitle">Admin Panel • Excellence Since 2005</div>
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

            // Safety fallback: dismiss loader after 3 seconds regardless
            setTimeout(dismissLoader, 3000);
        })();
    </script>

    <!-- Mobile Sidebar Backdrop -->
    <div class="fixed inset-0 bg-slate-900/40 z-20 lg:hidden" 
         x-show="mobileSidebarOpen" 
         x-cloak
         @click="mobileSidebarOpen = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"></div>

    <div class="flex min-h-screen">
        
        <!-- Sidebar Navigation -->
        <aside class="fixed top-0 bottom-0 left-0 bg-[#0f2343] text-white z-30 transition-all duration-300 shadow-xl flex flex-col"
               x-cloak
               :class="(mobileSidebarOpen ? 'translate-x-0 w-64' : '-translate-x-full lg:translate-x-0') + ' ' + (sidebarOpen ? 'lg:w-64' : 'lg:w-20')">
            
            <!-- Branding Header -->
            <div class="h-20 border-b border-white/10 flex items-center px-6 justify-between flex-shrink-0">
                <div class="flex items-center gap-3 overflow-hidden">
                    @if($siteSetting && $siteSetting->logo)
                        <img src="{{ asset($siteSetting->logo) }}" alt="Logo" class="w-10 h-10 object-contain flex-shrink-0 bg-white rounded-md p-1">
                    @else
                        <div class="w-10 h-10 rounded-lg bg-accent text-primary flex items-center justify-center font-serif font-bold text-lg flex-shrink-0">
                            PC
                        </div>
                    @endif
                    <div class="transition-opacity duration-300" :class="(sidebarOpen || mobileSidebarOpen) ? 'opacity-100' : 'opacity-0 w-0 pointer-events-none'">
                        <div class="font-serif font-bold tracking-wide">Pushpraj</div>
                        <div class="text-[9px] uppercase tracking-widest text-white/50">Admin Panel</div>
                    </div>
                </div>
                <!-- Hide Sidebar Toggle on Mobile -->
                <button @click="sidebarOpen = !sidebarOpen" class="hidden lg:flex text-white/60 hover:text-white transition-colors">
                    <i data-lucide="chevrons-left" class="w-5 h-5 transition-transform" :class="!sidebarOpen && 'rotate-180'"></i>
                </button>
            </div>

            <!-- Main Nav Links -->
            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                @php
                    $navItems = [
                        ['name' => 'Dashboard', 'icon' => 'trending-up', 'route' => 'admin.dashboard'],
                        ['name' => 'Sectors', 'icon' => 'folder-open', 'route' => 'admin.sectors.index'],
                        ['name' => 'Projects', 'icon' => 'layout-grid', 'route' => 'admin.projects.index'],
                        ['name' => 'Services', 'icon' => 'briefcase', 'route' => 'admin.services.index'],
                        ['name' => 'Milestones', 'icon' => 'milestone', 'route' => 'admin.milestones.index'],
                        ['name' => 'Testimonials', 'icon' => 'message-square', 'route' => 'admin.testimonials.index'],
                        ['name' => 'Certifications', 'icon' => 'award', 'route' => 'admin.certifications.index'],
                        ['name' => 'Our Team', 'icon' => 'users', 'route' => 'admin.team.index'],
                        ['name' => 'Inbox Submissions', 'icon' => 'mail', 'route' => 'admin.contact.index', 'badge' => true],
                        ['name' => 'Company Settings', 'icon' => 'settings', 'route' => 'admin.settings.edit'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    @php
                        $routeParts = explode('.', $item['route']);
                        $routeGroup = isset($routeParts[1]) ? $routeParts[0] . '.' . $routeParts[1] : $item['route'];
                        $isActive = request()->routeIs($routeGroup . '.*') || request()->routeIs($item['route']);
                    @endphp
                    <a href="{{ route($item['route']) }}" 
                       class="flex items-center gap-4 px-4 py-3 rounded-lg text-sm font-medium transition-all group relative {{ $isActive ? 'bg-accent text-primary font-semibold' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5 flex-shrink-0 {{ $isActive ? 'text-primary' : 'text-white/60 group-hover:text-white' }}"></i>
                        
                        <span class="transition-opacity duration-300" :class="(sidebarOpen || mobileSidebarOpen) ? 'opacity-100' : 'opacity-0 lg:w-0 pointer-events-none'">
                            {{ $item['name'] }}
                        </span>

                        @if(isset($item['badge']))
                            @php
                                $unreadCount = \App\Models\ContactSubmission::where('status', 'new')->count();
                            @endphp
                            @if($unreadCount > 0)
                                <span class="absolute right-4 px-2 py-0.5 rounded-full text-[10px] bg-red-500 text-white font-bold transition-all"
                                      :class="(sidebarOpen || mobileSidebarOpen) ? 'opacity-100' : 'opacity-0 scale-0 pointer-events-none'">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        @endif
                    </a>
                @endforeach
            </nav>

            <!-- Sidebar Footer / Logout -->
            <div class="p-4 border-t border-white/10 flex-shrink-0">
                <form action="{{ route('admin.logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" 
                            class="flex items-center gap-4 px-4 py-3 rounded-lg text-sm font-medium text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-colors w-full">
                        <i data-lucide="log-out" class="w-5 h-5 flex-shrink-0"></i>
                        <span :class="(sidebarOpen || mobileSidebarOpen) ? 'opacity-100' : 'opacity-0 lg:w-0 pointer-events-none'">Sign Out</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Dashboard Content Area -->
        <div class="flex-1 min-w-0 flex flex-col min-h-screen transition-all duration-300"
             :class="sidebarOpen ? 'lg:pl-64' : 'lg:pl-20'">
            
            <!-- Top Dashboard Header -->
            <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-6 lg:px-8 flex-shrink-0">
                <div class="flex items-center gap-4">
                    <!-- Mobile Hamburger -->
                    <button @click="mobileSidebarOpen = true" class="lg:hidden text-slate-600 hover:text-slate-900 transition-colors">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <h2 class="text-xl font-bold text-primary font-serif">@yield('page-title', 'Dashboard')</h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <div class="font-medium text-slate-800 text-sm">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-slate-500">System Administrator</div>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center font-bold text-primary shadow-inner">
                        A
                    </div>
                </div>
            </header>

            <!-- Main Dynamic Page Content -->
            <main class="flex-grow p-4 sm:p-6 lg:p-8 overflow-x-hidden">
                
                @yield('content')
            </main>

            <!-- Bottom Layout Footer -->
            <footer class="h-auto sm:h-14 bg-white border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between px-4 sm:px-8 py-3 sm:py-0 text-xs text-slate-400 flex-shrink-0 gap-1 sm:gap-0">
                <div>&copy; {{ date('Y') }} Pushpraj Construction.</div>
                <div class="flex items-center gap-3 uppercase tracking-widest text-[10px]">
                    <span>ISO 9001:2015</span>
                    <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                    <span>ISO 45001:2018</span>
                </div>
            </footer>
        </div>
    </div>

    <script>
        // Init Lucide icons
        lucide.createIcons();

        // Global SweetAlert Toast Configuration
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        // Fire success message if exists in session
        @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        @endif

        @if(session('error'))
            Toast.fire({
                icon: 'error',
                title: "{{ session('error') }}"
            });
        @endif

        // Global Delete Confirmation function
        function confirmDelete(event, formElement) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    formElement.submit();
                }
            });
        }
    </script>
</body>
</html>
