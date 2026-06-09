@extends('layouts.app')

@section('title', 'Sudah Hadir')

@section('content')
<div class="max-w-md mx-auto">
    <div class="card-glass rounded-2xl p-8 text-center">
        <h1 class="text-2xl font-bold mb-2 text-gray-900">Sudah Tercatat Hadir</h1>
        <p class="text-gray-600 text-sm">Event: {{ $event->title }}</p>
        <p class="text-xl font-semibold my-4 text-gray-900">{{ $registration->full_name }}</p>
        <span class="inline-block px-4 py-2 rounded-full bg-green-100 text-green-800 text-sm font-medium">
            Peserta ini sudah melakukan presensi.
        </span>
        <p class="mt-6">
            <a href="{{ route('certificates.by-token', $registration->attendance_token) }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700">
                Unduh Sertifikat (PDF)
            </a>
        </p>
    </div>
</div>
@endsection
