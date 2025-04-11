@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">List Pemesanan Lapangan</h2>
        <a href="{{ route('pesanan.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow">+ Pemesanan Baru</a>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('pesanan.index') }}" class="mb-6">
        <div class="grid grid-cols-4 gap-4">
            <select name="nomor_lapangan" class="border p-2 rounded">
                <option value="">Semua Lapangan</option>
                <option value="1" {{ request('nomor_lapangan') == 1 ? 'selected' : '' }}>Lapangan 1</option>
                <option value="2" {{ request('nomor_lapangan') == 2 ? 'selected' : '' }}>Lapangan 2</option>
            </select>

            <input type="date" name="tanggal_awal" class="border p-2 rounded" value="{{ request('tanggal_awal') }}">
            <input type="date" name="tanggal_akhir" class="border p-2 rounded" value="{{ request('tanggal_akhir') }}">

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
                Tampilkan
            </button>
        </div>
    </form>

    <!-- Tabel Data -->
    <table class="w-full bg-white rounded-xl shadow text-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2 text-center">No</th>
                <th class="border p-2 text-left">Nama Pemesan</th>
                <th class="border p-2 text-left">Nomor WhatsApp</th>
                <th class="border p-2 text-center">Tanggal Booking</th>
                <th class="border p-2 text-center">Nomor Lapangan</th>
                <th class="border p-2 text-center">Jam Pemakaian</th>
                <th class="border p-2 text-center">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pesanan as $index => $p)
                <tr class="border hover:bg-gray-100">
                    <td class="border p-2 text-center">{{ $index + 1 }}</td>
                    <td class="border p-2">{{ $p->nama_pemesan }}</td>
                    <td class="border p-2">{{ $p->wa_pemesan }}</td>
                    <td class="border p-2 text-center">{{ $p->tanggal }}</td>
                    <td class="border p-2 text-center">{{ $p->jadwal->nomor_lapangan ?? '-' }}</td>
                    <td class="border p-2 text-center">
                        {{ $p->jadwal->jam_mulai ?? '-' }} - {{ $p->jadwal->jam_selesai ?? '-' }}
                    </td>
                    <td class="border p-2 text-center">
                        <div class="flex justify-center space-x-2">
                            {{-- Edit --}}
                            <a href="{{ route('pesanan.edit', $p->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded shadow">
                                Edit
                            </a>
                            {{-- Delete --}}
                            <form action="{{ route('pesanan.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center p-4">Tidak ada data yang ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection