@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-900">Masuk ke Akun</h2>
    <p class="text-gray-500 text-sm mt-1">Silakan login untuk mengakses sistem presensi</p>
</div>

<form method="POST" action="{{ route('login') }}" class="space-y-5">
    @csrf
    <div>
        <label class="block text-sm font-medium mb-1.5 text-gray-700">Email</label>
        <input type="email" name="email" value="{{ old('email', 'admin@example.com') }}" required autofocus
            class="form-input" placeholder="nama@email.com">
    </div>
    <div>
        <div class="flex items-center justify-between mb-1.5">
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Lupa password?</a>
        </div>
        <div class="relative">
            <input id="login-password" type="password" name="password" required placeholder="••••••••"
                autocomplete="current-password" class="form-input pr-12">
            <button type="button" id="login-password-toggle"
                class="absolute right-2 top-1/2 -translate-y-1/2 p-1.5 rounded-md text-gray-400 hover:text-gray-600"
                aria-label="Tampilkan password">
                <svg id="login-password-icon-show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                <svg id="login-password-icon-hide" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
            </button>
        </div>
    </div>
    <div class="flex items-center justify-between">
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
            <span class="text-sm text-gray-600">Ingat saya</span>
        </label>
        <a href="{{ route('events.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Lihat event tanpa login</a>
    </div>
    <button type="submit"
        class="w-full py-3 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow-sm shadow-indigo-200">
        Masuk
    </button>
</form>

<div class="mt-6 text-center text-sm text-gray-500">
    Belum punya akun?
    <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-800">Daftar sekarang</a>
</div>

<div class="mt-8 pt-6 border-t border-gray-100">
    <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-3">Akun demo</p>
    <div class="grid sm:grid-cols-2 gap-3">
        <button type="button" onclick="fillLogin('admin@example.com')"
            class="text-left p-3 rounded-xl border border-gray-200 hover:border-indigo-300 hover:bg-indigo-50/50 transition group">
            <p class="text-sm font-semibold text-gray-800 group-hover:text-indigo-700">Admin</p>
            <p class="text-xs text-gray-500 mt-0.5">Kelola event &amp; QR</p>
            <p class="font-mono text-xs text-indigo-600 mt-1">admin@example.com</p>
        </button>
        <button type="button" onclick="fillLogin('user@example.com')"
            class="text-left p-3 rounded-xl border border-gray-200 hover:border-indigo-300 hover:bg-indigo-50/50 transition group">
            <p class="text-sm font-semibold text-gray-800 group-hover:text-indigo-700">Peserta</p>
            <p class="text-xs text-gray-500 mt-0.5">Daftar &amp; presensi</p>
            <p class="font-mono text-xs text-indigo-600 mt-1">user@example.com</p>
        </button>
    </div>
    <p class="text-xs text-gray-400 mt-3 text-center">Password: <span class="font-mono">password</span></p>
</div>

<script>
function fillLogin(email) {
    document.querySelector('input[name="email"]').value = email;
    document.getElementById('login-password').value = 'password';
    document.getElementById('login-password').focus();
}
(function () {
    var input = document.getElementById('login-password');
    var btn = document.getElementById('login-password-toggle');
    var iconShow = document.getElementById('login-password-icon-show');
    var iconHide = document.getElementById('login-password-icon-hide');
    if (!input || !btn) return;
    btn.addEventListener('click', function () {
        var visible = input.type === 'password';
        input.type = visible ? 'text' : 'password';
        iconShow.classList.toggle('hidden', visible);
        iconHide.classList.toggle('hidden', !visible);
    });
})();
</script>
@endsection
