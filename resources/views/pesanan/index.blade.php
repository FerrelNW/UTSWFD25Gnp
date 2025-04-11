@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">List Pemesanan Lapangan</h2>
        <a href="{{ route('pesanan.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">+ Pemesanan Baru</a>
    </div>

    <!--filter -->
    <form method="GET" action="{{ route('pesanan.index') }}" class="mb-4">
        <div class="grid grid-cols-4 gap-4">
            <select name="nomor_lapangan" class="border p-2">
                <option value="">Semua Lapangan</option>
                <option value="1" {{ request('nomor_lapangan') == 1 ? 'selected' : '' }}>Lapangan 1</option>
                <option value="2" {{ request('nomor_lapangan') == 2 ? 'selected' : '' }}>Lapangan 2</option>
            </select>

            <input type="date" name="tanggal_awal" class="border p-2" value="{{ request('tanggal_awal') }}">
            <input type="date" name="tanggal_akhir" class="border p-2" value="{{ request('tanggal_akhir') }}">

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Tampilkan
            </button>
        </div>
    </form>

    <!--tabel-->
    <table class="w-full border-collapse border border-gray-300 mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">No</th>
                <th class="border p-2">Nama Pemesan</th>
                <th class="border p-2">Nomor WhatsApp</th>
                <th class="border p-2">Tanggal Booking</th>
                <th class="border p-2">Nomor Lapangan</th>
                <th class="border p-2">Jam Pemakaian</th>
                <th class="border p-2">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pesanan as $index => $p)
                <tr class="border">
                    <td class="border p-2 text-center">{{ $index + 1 }}</td>
                    <td class="border p-2">{{ $p->nama_pemesan }}</td>
                    <td class="border p-2">{{ $p->wa_pemesan }}</td>
                    <td class="border p-2 text-center">{{ $p->tanggal }}</td>
                    <td class="border p-2 text-center">{{ $p->jadwal->nomor_lapangan ?? '-' }}</td>
                    <td class="border p-2 text-center">
                        {{ $p->jadwal->jam_mulai ?? '-' }} - {{ $p->jadwal->jam_selesai ?? '-' }}
                    </td>
                    <td class="border p-2 text-center">
                        {{-- edit --}}
                        <a href="{{ route('pesanan.edit', $p->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                        {{-- delete --}}
                        <form action="{{ route('pesanan.destroy', $p->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('Yakin ingin menghapus pesanan ini?')">Hapus</button>
                        </form>
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