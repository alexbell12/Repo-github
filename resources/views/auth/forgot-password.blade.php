@extends('layouts.auth')

@section('title', 'Lupa Password')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-900">Lupa Password</h2>
    <p class="text-gray-500 text-sm mt-1">Masukkan email akun Anda. Kami akan mengirim link untuk mengatur ulang password.</p>
</div>

<form method="POST" action="{{ route('password.email') }}" class="space-y-5">
    @csrf
    <div>
        <label class="block text-sm font-medium mb-1.5 text-gray-700">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus
            class="form-input" placeholder="nama@email.com">
    </div>
    <button type="submit"
        class="w-full py-3 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow-sm shadow-indigo-200">
        Kirim Link Reset Password
    </button>
</form>

<div class="mt-6 text-center text-sm text-gray-500">
    <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-800">Kembali ke login</a>
</div>
@endsection
