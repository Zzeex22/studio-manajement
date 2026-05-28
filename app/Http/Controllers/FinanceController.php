<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\Project;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FinanceController extends Controller
{
    public function index()
    {
        $finances = Finance::with('project')->latest()->get();
        return view('finances.index', compact('finances'));
    }

    public function create()
    {
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

    public function edit(Finance $finance)
    {
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

    public function destroy(Finance $finance)
    {
        $finance->delete();
        return redirect()->route('finances.index')->with('success', 'Catatan transaksi berhasil dihapus.');
    }

    public function downloadInvoice(Finance $finance)
    {
        $finance->load('project.client');

        $data = [
            'finance' => $finance,
            'date' => date('d F Y'),
            'invoice_number' => 'INV-' . $finance->id . date('dmY')
        ];

        $pdf = Pdf::loadView('finances.invoice', $data);

        return $pdf->download($data['invoice_number'] . '.pdf');
    }
}