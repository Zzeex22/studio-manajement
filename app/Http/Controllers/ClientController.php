<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Menampilkan halaman daftar klien
    public function index()
    {
        $clients = Client::latest()->get(); // Ambil data klien dari yang paling baru
        return view('clients.index', compact('clients'));
    }

    // Menampilkan form tambah klien
    public function create()
    {
        return view('clients.create');
    }

    // Menyimpan data klien baru ke database
    public function store(Request $request)
    {
        // Validasi data (wajib diisi dan email harus unik)
        $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'email' => 'required|email|unique:clients',
            'phone' => 'nullable|string|max:20',
        ]);

        // Simpan ke database
        Client::create($request->all());

        // Balikin ke halaman daftar dengan pesan sukses
        return redirect()->route('clients.index')->with('success', 'Mantap! Klien baru berhasil ditambahkan.');
    }

    // Fitur hapus klien (opsional sekalian kita buat)
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Data klien berhasil dihapus.');
    }
    // Menampilkan form edit data klien
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    // Menyimpan perubahan data ke database (Update)
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id, // Pengecualian unik untuk email dia sendiri
            'phone' => 'nullable|string|max:20',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Sip! Data klien berhasil diupdate.');
    }
}