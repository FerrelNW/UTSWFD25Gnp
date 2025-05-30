<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded shadow-md w-96">
        <h2 class="text-xl font-semibold mb-4">Form Pemesanan</h2>
        
        @if(session('error'))
            <div class="bg-red-500 text-white p-2 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif
        
        @if(session('success'))
            <div class="bg-green-500 text-white p-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-2 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pesanan.store') }}" method="POST">
            @csrf
            <label class="block mb-2">Nama Pemesan:</label>
            <input type="text" name="nama_pemesan" class="w-full border rounded p-2 mb-2" value="{{ old('nama_pemesan') }}" required>
            
            <label class="block mb-2">WhatsApp:</label>
            <input type="text" name="wa_pemesan" class="w-full border rounded p-2 mb-2" value="{{ old('wa_pemesan') }}" required>

            <label class="block mb-2">Tanggal:</label>
            <input type="date" name="tanggal" class="w-full border rounded p-2 mb-2" value="{{ old('tanggal') }}" required>

            <label class="block mb-2">Jadwal:</label>
            <select name="jadwal_id" class="w-full border rounded p-2 mb-4" required>
                <option value="">Pilih Jadwal</option>
                @foreach($jadwal as $j)
                    <option value="{{ $j->id }}" {{ old('jadwal_id') == $j->id ? 'selected' : '' }}>
                        Lapangan {{ $j->nomor_lapangan }} | {{ $j->jam_mulai }} - {{ $j->jam_selesai }}
                    </option>
                @endforeach
            </select>

            <div class="flex justify-between items-center mt-4">
                <a href="{{ route('pesanan.index') }}" class="text-gray-500 text-sm hover:underline">← Kembali</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Pesan</button>
            </div>
        </form>
    </div>
</body>
</html>