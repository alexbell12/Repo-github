@extends('layouts.auth')

@section('title', 'Atur Ulang Password')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-900">Atur Ulang Password</h2>
    <p class="text-gray-500 text-sm mt-1">Masukkan password baru untuk akun Anda.</p>
</div>

<form method="POST" action="{{ route('password.update') }}" class="space-y-5">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div>
        <label class="block text-sm font-medium mb-1.5 text-gray-700">Email</label>
        <input type="email" name="email" value="{{ old('email', $email) }}" required
            class="form-input" placeholder="nama@email.com">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1.5 text-gray-700">Password Baru</label>
        <input type="password" name="password" required autocomplete="new-password"
            class="form-input" placeholder="Minimal 8 karakter">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1.5 text-gray-700">Konfirmasi Password Baru</label>
        <input type="password" name="password_confirmation" required autocomplete="new-password"
            class="form-input" placeholder="Ulangi password baru">
    </div>
    <button type="submit"
        class="w-full py-3 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow-sm shadow-indigo-200">
        Simpan Password Baru
    </button>
</form>

<div class="mt-6 text-center text-sm text-gray-500">
    <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-800">Kembali ke login</a>
</div>
@endsection
