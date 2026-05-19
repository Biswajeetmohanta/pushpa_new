<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Pushpraj Construction</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Laravel Vite Asset Loading -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #0c1a30; /* Deep premium Navy */
        }
        .font-serif {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 relative overflow-hidden">

    <!-- Decorative background elements -->
    <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full bg-accent/10 blur-3xl"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full bg-primary/20 blur-3xl"></div>

    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden border border-border/10 z-10 transition-transform duration-500 hover:scale-[1.01]">
        <!-- Top branding bar -->
        <div class="bg-[#0f2343] p-8 text-center border-b border-accent/20">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-xl bg-accent text-primary font-serif font-bold text-2xl mb-4 shadow-lg">
                PC
            </div>
            <h1 class="font-serif text-2xl font-bold text-white tracking-wide">Pushpraj Construction</h1>
            <p class="text-white/60 text-xs uppercase tracking-widest mt-1">Management Portal</p>
        </div>

        <!-- Login Form Container -->
        <div class="p-8">
            <h2 class="text-xl font-semibold text-primary mb-6 text-center">Sign In to Dashboard</h2>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg text-red-700 text-sm">
                    <div class="flex items-center gap-2 mb-1">
                        <i data-lucide="alert-circle" class="w-4 h-4 text-red-500"></i>
                        <span class="font-semibold">Authentication Error</span>
                    </div>
                    <ul class="list-disc pl-5 mt-1 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-muted-foreground mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-muted-foreground">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                            class="block w-full pl-10 pr-4 py-3 rounded-lg border border-border focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-primary bg-muted/30"
                            placeholder="admin@pushpa.com">
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-sm font-medium text-muted-foreground">Password</label>
                    </div>
                    <div class="relative" x-data="{ show: false }">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-muted-foreground">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                        <input :type="show ? 'text' : 'password'" name="password" id="password" required
                            class="block w-full pl-10 pr-10 py-3 rounded-lg border border-border focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-primary bg-muted/30"
                            placeholder="••••••••">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-muted-foreground hover:text-primary">
                            <i :data-lucide="show ? 'eye-off' : 'eye'" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-border text-accent focus:ring-accent bg-muted/30">
                        <span class="text-sm text-muted-foreground">Remember me</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-[#0f2343] text-white hover:bg-primary font-semibold py-3.5 px-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-2 group">
                    <span>Sign In</span>
                    <i data-lucide="arrow-right" class="w-5 h-5 transition-transform group-hover:translate-x-1"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
</body>
</html>
