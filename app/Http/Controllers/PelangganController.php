<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['gender'];
        $searchableColumns = ['first_name', 'last_name', 'email'];

        $pelanggan = Pelanggan::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.admin.pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('admin.admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'birthday'   => 'nullable|date',
            'gender'     => 'nullable|in:Male,Female,Other',
            'email'      => 'required|email|unique:pelanggan,email',
            'phone'      => 'nullable',
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
            'first_name' => 'required',
            'last_name'  => 'required',
            'birthday'   => 'nullable|date',
            'gender'     => 'nullable|in:Male,Female,Other',
            'email'      => 'required|email|unique:pelanggan,email,' . $pelanggan->id,
            'phone'      => 'nullable',
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