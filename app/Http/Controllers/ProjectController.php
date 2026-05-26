<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Client;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // Ambil data project beserta relasi kliennya biar ringan (Eager Loading)
        $projects = Project::with('client')->latest()->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        // Ambil semua data klien untuk ditampilkan di dropdown form
        $clients = Client::all();
        return view('projects.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,review,completed',
            'deadline' => 'required|date',
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index')->with('success', 'Project baru berhasil dibuat!');
    }

    public function edit(Project $project)
    {
        $clients = Client::all();
        return view('projects.edit', compact('project', 'clients'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,review,completed',
            'deadline' => 'required|date',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Status/Data Project berhasil diupdate!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project berhasil dihapus.');
    }
}