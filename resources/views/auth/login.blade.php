@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="max-w-md mx-auto">
    <div class="card-glass rounded-2xl p-8 shadow-xl">
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/10 mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <h1 class="text-2xl font-bold">Login User</h1>
            <p class="text-white/80 text-sm mt-1">Masuk ke akun Anda untuk mengakses sistem absensi</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-white/60"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></span>
                    <input type="email" name="email" value="{{ old('email', 'admin@example.com') }}" required autofocus
                        class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:ring-2 focus:ring-white/30 focus:border-transparent">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-white/60 pointer-events-none"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg></span>
                    <input id="login-password" type="password" name="password" required placeholder="••••••••" autocomplete="current-password"
                        class="w-full pl-10 pr-12 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:ring-2 focus:ring-white/30 focus:border-transparent">
                    <button type="button" id="login-password-toggle" class="absolute right-2 top-1/2 -translate-y-1/2 p-1.5 rounded-md text-white/70 hover:text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/30" aria-label="Tampilkan password" aria-pressed="false" title="Tampilkan password">
                        <svg id="login-password-icon-show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg id="login-password-icon-hide" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                    </button>
                </div>
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="rounded border-white/30 bg-white/10 text-purple-500 focus:ring-white/30">
                <label for="remember" class="ml-2 text-sm">Remember me</label>
            </div>
            <button type="submit" class="w-full py-3 rounded-lg bg-white text-purple-700 font-semibold flex items-center justify-center gap-2 hover:bg-white/90 transition">
                Login
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-white/80">
            Belum punya akun? <a href="{{ route('register') }}" class="underline font-medium text-white hover:no-underline">Daftar di sini</a>
        </p>

        <div class="mt-6 pt-4 border-t border-white/20 text-sm text-white/70">
            <p class="font-medium text-white/90">Akun Test:</p>
            <p>User: user@example.com / password</p>
            <p>Admin: admin@example.com / password</p>
        </div>
    </div>
</div>
<script>
(function () {
    var input = document.getElementById('login-password');
    var btn = document.getElementById('login-password-toggle');
    var iconShow = document.getElementById('login-password-icon-show');
    var iconHide = document.getElementById('login-password-icon-hide');
    if (!input || !btn || !iconShow || !iconHide) return;
    btn.addEventListener('click', function () {
        var visible = input.type === 'password';
        input.type = visible ? 'text' : 'password';
        iconShow.classList.toggle('hidden', visible);
        iconHide.classList.toggle('hidden', !visible);
        btn.setAttribute('aria-pressed', visible ? 'true' : 'false');
        btn.setAttribute('aria-label', visible ? 'Sembunyikan password' : 'Tampilkan password');
        btn.setAttribute('title', visible ? 'Sembunyikan password' : 'Tampilkan password');
    });
})();
</script>
@endsection
