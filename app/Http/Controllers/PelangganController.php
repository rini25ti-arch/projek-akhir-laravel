<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::latest()->get();
        return view('admin.admin.pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('admin.admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required',
            'email'  => 'required|email|unique:pelanggans,email',
            'no_hp'  => 'required',
            'alamat' => 'required',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('admin.admin.pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama'   => 'required',
            'email'  => 'required|email|unique:pelanggans,email,'.$pelanggan->id,
            'no_hp'  => 'required',
            'alamat' => 'required',
        ]);

        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil dihapus!');
    }
}