@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<div class="max-w-md mx-auto">
    <div class="card-glass rounded-2xl p-8 shadow-sm">
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-50 mb-4">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Daftar Akun</h1>
            <p class="text-gray-600 text-sm mt-1">Buat akun untuk mendaftar event</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="form-input">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="form-input">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Password</label>
                <input type="password" name="password" required class="form-input">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="form-input">
            </div>
            <button type="submit" class="w-full py-3 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">Daftar</button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">
            Sudah punya akun? <a href="{{ route('login') }}" class="underline font-medium text-indigo-600">Login di sini</a>
        </p>
    </div>
</div>
@endsection
