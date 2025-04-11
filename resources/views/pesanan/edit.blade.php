@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Edit Pesanan</h2>

    @if(session('error'))
        <div class="bg-red-500 text-white p-2 mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('pesanan.update', $pesanan->id) }}">
        @csrf
        @method('PUT')

        <label>Nama Pemesan:</label>
        <input type="text" name="nama_pemesan" value="{{ $pesanan->nama_pemesan }}" class="border p-2 w-full mb-4" required>

        <label>Nomor WhatsApp:</label>
        <input type="text" name="wa_pemesan" value="{{ $pesanan->wa_pemesan }}" class="border p-2 w-full mb-4" required>

        <label>Tanggal Booking:</label>
        <input type="date" name="tanggal_booking" value="{{ $pesanan->tanggal_booking }}" class="border p-2 w-full mb-4" required>

        <label>Nomor Lapangan:</label>
        <input type="number" name="nomor_lapangan" value="{{ $pesanan->nomor_lapangan }}" class="border p-2 w-full mb-4" required>

        <label>Jam Pemakaian:</label>
        <input type="text" name="jam_pemakaian" value="{{ $pesanan->jam_pemakaian }}" class="border p-2 w-full mb-4" required>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Update</button>
    </form>
</div>
@endsection