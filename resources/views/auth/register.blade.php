@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<div class="max-w-md mx-auto">
    <div class="card-glass rounded-2xl p-8 shadow-xl">
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/10 mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            </div>
            <h1 class="text-2xl font-bold">Daftar Akun</h1>
            <p class="text-white/80 text-sm mt-1">Buat akun untuk mendaftar event seminar</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:ring-2 focus:ring-white/30 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:ring-2 focus:ring-white/30 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:ring-2 focus:ring-white/30 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:ring-2 focus:ring-white/30 focus:border-transparent">
            </div>
            <button type="submit" class="w-full py-3 rounded-lg bg-white text-purple-700 font-semibold hover:bg-white/90 transition">Daftar</button>
        </form>

        <p class="mt-4 text-center text-sm text-white/80">
            Sudah punya akun? <a href="{{ route('login') }}" class="underline font-medium text-white">Login di sini</a>
        </p>

        <div class="mt-6 pt-4 border-t border-white/20 text-sm text-white/70">
            <p class="font-medium text-white/90 mb-2">Atau pakai akun demo</p>
            <p>User: <span class="font-mono text-white/90">user@example.com</span> / password</p>
            <p class="mt-1">Admin: <span class="font-mono text-white/90">admin@example.com</span> / password</p>
        </div>
    </div>
</div>
@endsection
