<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\Project;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        // Ambil data keuangan urut dari yang terbaru
        $finances = Finance::with('project')->latest()->get();
        return view('finances.index', compact('finances'));
    }

    public function create()
    {
        // Ambil data project yang statusnya belum 'completed' untuk pilihan form
        $projects = Project::where('status', '!=', 'completed')->get();
        return view('finances.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'nullable|exists:projects,id',
            'transaction_type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        Finance::create($request->all());

        return redirect()->route('finances.index')->with('success', 'Transaksi berhasil dicatat.');
    }

    public function destroy(Finance $finance)
    {
        $finance->delete();
        return redirect()->route('finances.index')->with('success', 'Catatan transaksi berhasil dihapus.');
    }

    public function edit(Finance $finance)
    {
        // Ambil data project untuk pilihan di dropdown
        $projects = Project::all(); 
        return view('finances.edit', compact('finance', 'projects'));
    }

    public function update(Request $request, Finance $finance)
    {
        $request->validate([
            'project_id' => 'nullable|exists:projects,id',
            'transaction_type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        $finance->update($request->all());

        return redirect()->route('finances.index')->with('success', 'Catatan transaksi berhasil diperbarui.');
    }
}