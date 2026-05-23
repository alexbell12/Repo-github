@extends('layouts.app')

@section('title', 'Manage Peserta - ' . $event->title)

@section('content')
<div class="mb-4 flex items-center justify-between flex-wrap gap-3">
    <a href="{{ route('admin.events.index') }}" class="text-white/90 hover:text-white inline-flex items-center gap-2 text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>
</div>

<div class="card-glass rounded-2xl p-8">
    <div class="flex items-center gap-2 mb-6">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        <h1 class="text-2xl font-bold">Manage Peserta: {{ $event->title }}</h1>
    </div>

    @php $usersToAdd = \App\Models\User::whereDoesntHave('eventRegistrations', fn($q) => $q->where('event_id', $event->id))->orderBy('name')->get(); @endphp
    <div class="mb-6">
        <p class="text-sm font-medium mb-2">Tambah Peserta:</p>
        @if($usersToAdd->isNotEmpty())
            <form action="{{ route('admin.events.registrations.store', $event) }}" method="POST" class="flex flex-wrap gap-2 items-end">
                @csrf
                <div class="min-w-[200px] flex-1">
                    <select name="user_id" required class="w-full px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-white focus:ring-2 focus:ring-white/30">
                        <option value="">-- Pilih User --</option>
                        @foreach($usersToAdd as $u)
                            <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="px-4 py-2 rounded-lg bg-green-500/80 hover:bg-green-500 font-medium">Tambah</button>
            </form>
        @else
            <p class="text-white/70 text-sm">Semua user sudah terdaftar di event ini.</p>
        @endif
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="border-b border-white/20">
                    <th class="pb-3 font-semibold">Nama</th>
                    <th class="pb-3 font-semibold">Email</th>
                    <th class="pb-3 font-semibold">Terdaftar</th>
                    <th class="pb-3 font-semibold">Status</th>
                    <th class="pb-3 font-semibold">Kehadiran</th>
                    <th class="pb-3 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registrations as $r)
                    <tr class="border-b border-white/10">
                        <td class="py-3">{{ $r->full_name }}</td>
                        <td class="py-3">{{ $r->email ?? '-' }}</td>
                        <td class="py-3">{{ $r->created_at->format('d M Y H:i') }}</td>
                        <td class="py-3">
                            @if($r->status === 'verified')
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-green-500/30 text-green-100 text-xs">Terverifikasi</span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-amber-500/30 text-amber-100 text-xs">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Menunggu
                                </span>
                            @endif
                        </td>
                        <td class="py-3">
                            @if($r->hasAttended())
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-blue-500/30 text-blue-100 text-xs">
                                    Hadir {{ $r->attendance->scanned_at->format('d/m H:i') }}
                                </span>
                            @else
                                <span class="text-white/50 text-xs">Belum hadir</span>
                            @endif
                        </td>
                        <td class="py-3 flex flex-wrap gap-2">
                            @if($r->hasAttended())
                                <a href="{{ route('admin.registrations.certificate', $r) }}"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-indigo-500/60 hover:bg-indigo-500 text-sm">
                                    Sertifikat
                                </a>
                            @endif
                            @if($r->status !== 'verified')
                                <form action="{{ route('admin.registrations.verify', $r) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-green-500/60 hover:bg-green-500 text-sm">Verifikasi</button>
                                </form>
                            @endif
                            <form action="{{ route('admin.registrations.destroy', $r) }}" method="POST" class="inline" onsubmit="return confirm('Hapus peserta ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-red-500/60 hover:bg-red-500 text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="py-8 text-center text-white/70">Belum ada peserta terdaftar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
