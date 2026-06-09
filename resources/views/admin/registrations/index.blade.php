@extends('layouts.app')

@section('title', 'Manage Peserta - ' . $event->title)

@section('content')
<div class="mb-4 flex items-center justify-between flex-wrap gap-3">
    <a href="{{ route('admin.events.index') }}" class="text-indigo-600 hover:text-indigo-800 inline-flex items-center gap-2 text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>
</div>

<div class="card-glass rounded-2xl p-8">
    <div class="flex items-center gap-2 mb-6">
        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        <h1 class="text-2xl font-bold text-gray-900">Manage Peserta: {{ $event->title }}</h1>
    </div>

    @php $usersToAdd = \App\Models\User::whereDoesntHave('eventRegistrations', fn($q) => $q->where('event_id', $event->id))->orderBy('name')->get(); @endphp
    <div class="mb-6">
        <p class="text-sm font-medium mb-2 text-gray-700">Tambah Peserta:</p>
        @if($usersToAdd->isNotEmpty())
            <form action="{{ route('admin.events.registrations.store', $event) }}" method="POST" class="flex flex-wrap gap-2 items-end">
                @csrf
                <div class="min-w-[200px] flex-1">
                    <select name="user_id" required class="form-input">
                        <option value="">-- Pilih User --</option>
                        @foreach($usersToAdd as $u)
                            <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white font-medium">Tambah</button>
            </form>
        @else
            <p class="text-gray-500 text-sm">Semua user sudah terdaftar di event ini.</p>
        @endif
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="pb-3 font-semibold text-gray-700">Nama</th>
                    <th class="pb-3 font-semibold text-gray-700">Email</th>
                    <th class="pb-3 font-semibold text-gray-700">Terdaftar</th>
                    <th class="pb-3 font-semibold text-gray-700">Kehadiran</th>
                    <th class="pb-3 font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registrations as $r)
                    <tr class="border-b border-gray-100">
                        <td class="py-3 text-gray-800">{{ $r->full_name }}</td>
                        <td class="py-3 text-gray-600">{{ $r->email ?? '-' }}</td>
                        <td class="py-3 text-gray-600">{{ $r->created_at->format('d M Y H:i') }}</td>
                        <td class="py-3">
                            @if($r->hasAttended())
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-blue-100 text-blue-800 text-xs">
                                    Hadir {{ $r->attendance->scanned_at->format('d/m H:i') }}
                                </span>
                            @else
                                <span class="text-gray-400 text-xs">Belum hadir</span>
                            @endif
                        </td>
                        <td class="py-3 flex flex-wrap gap-2">
                            @if($event->hasEnded() && $r->hasAttended())
                                <a href="{{ route('admin.registrations.certificate', $r) }}" class="px-3 py-1.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-sm">Sertifikat</a>
                            @elseif($event->hasEnded() && !$r->hasAttended())
                                <span class="text-xs text-gray-400">Belum presensi</span>
                            @else
                                <span class="text-xs text-gray-400">QR aktif setelah event selesai</span>
                            @endif
                            <form action="{{ route('admin.registrations.destroy', $r) }}" method="POST" class="inline" onsubmit="return confirm('Hapus peserta ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-500 hover:bg-red-600 text-white text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="py-8 text-center text-gray-500">Belum ada peserta terdaftar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
