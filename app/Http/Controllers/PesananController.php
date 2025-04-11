<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Jadwal;

class PesananController extends Controller
{
    // view index
    public function index(Request $request)
    {
        $query = Pesanan::query();

        if ($request->filled('nama_pemesan')) {
            $query->where('nama_pemesan', 'like', '%' . $request->nama_pemesan . '%');
        }

        if ($request->filled('tanggal')) {
            $query->where('tanggal', $request->tanggal);
        }

        $pesanan = $query->orderBy('tanggal', 'asc')->get();

        return view('pesanan.index', compact('pesanan'));
    }

    // ke view pesan
    public function create()
    {
        $jadwal = Jadwal::all();
        return view('pesanan.create', compact('jadwal'));
    }

    //simper data
    public function store(Request $request)
    {
        //validasi input
        $request->validate([
            'nama_pemesan' => 'required|string|max:100',
            'wa_pemesan' => 'required|string|min:11|max:13',
            'tanggal' => 'required|date',
            'jadwal_id' => 'required|exists:jadwal,id',
        ]);

        //jadwal bentrok
        $bentrok = Pesanan::where('jadwal_id', $request->jadwal_id)
            ->where('tanggal', $request->tanggal)
            ->exists();

        if ($bentrok) {
            return redirect()->back()->with('error', 'Jadwal sudah dipesan, silakan pilih jadwal lain.');
        }

        //simpen data
        Pesanan::create([
            'nama_pemesan' => $request->nama_pemesan,
            'wa_pemesan' => $request->wa_pemesan,
            'tanggal' => $request->tanggal,
            'jadwal_id' => $request->jadwal_id,
        ]);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat!');
    }

    // ke view edit
    public function edit($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $jadwal = Jadwal::all();
        return view('pesanan.edit', compact('pesanan', 'jadwal'));
    }

    // simpen update
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:100',
            'wa_pemesan' => 'required|string|size:13',
            'tanggal' => 'required|date',
            'jadwal_id' => 'required|exists:jadwal,id',
        ]);

        // cek jadwal bentrok
        $bentrok = Pesanan::where('jadwal_id', $request->jadwal_id)
            ->where('tanggal', $request->tanggal)
            ->where('id', '!=', $id)
            ->exists();

        if ($bentrok) {
            return redirect()->back()->with('error', 'Jadwal sudah dipesan, silakan pilih jadwal lain.');
        }

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update($request->all());

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diperbarui!');
    }
    // delete
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus!');
    }
}