<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Radjatiket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#050B14] text-white min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md px-6">
        
        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 group">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center">
                    <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z"/>
                    </svg>
                </div>
            </a>
            <h1 class="text-2xl font-black text-white mt-4">RADJATIKET</h1>
            <p class="text-gray-400 text-sm mt-2">Masuk ke akun Anda</p>
        </div>

        {{-- Card --}}
        <div class="bg-gradient-to-br from-[#0B1220] to-[#050B14] rounded-2xl p-8 border border-white/10 shadow-2xl">
            
            {{-- Session Status --}}
            @if (session('status'))
                <div class="mb-4 p-3 rounded-lg bg-green-500/10 border border-green-500/30 text-green-400 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus
                           autocomplete="username"
                           class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-all">
                    @error('email')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required
                           autocomplete="current-password"
                           class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-all">
                    @error('password')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded bg-white/5 border-white/10 text-yellow-500 focus:ring-yellow-500">
                        <span class="ml-2 text-sm text-gray-400">Ingat saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-yellow-500 hover:underline">
                            Lupa password?
                        </a>
                    @endif
                </div>

                {{-- Submit Button --}}
                <button type="submit" 
                        class="w-full py-3 rounded-xl bg-gradient-to-r from-yellow-400 to-yellow-600 text-black font-bold text-sm tracking-wider hover:from-yellow-500 hover:to-yellow-700 transition-all shadow-lg hover:shadow-yellow-500/25">
                    MASUK
                </button>

                {{-- Register Link --}}
                <p class="text-center text-sm text-gray-400 mt-4">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-yellow-500 hover:underline font-semibold">Daftar gratis</a>
                </p>
            </form>
        </div>

        {{-- Back to Home --}}
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-gray-300 transition-colors">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>

</body>
</html>
