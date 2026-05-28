<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Wajib ditambah untuk fitur Hapus File Lama

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Project::where('status', '!=', 'completed')->orderBy('deadline', 'asc')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function updateStatus(Request $request, Project $project)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,review,completed',
            'design_file' => 'nullable|file|mimes:jpg,jpeg,png,zip,pdf,rar|max:10240', // Max 10MB
        ]);

        $data = ['status' => $request->status];

        if ($request->hasFile('design_file')) {
            if ($project->design_file) {
                Storage::disk('public')->delete($project->design_file);
            }
            
            $path = $request->file('design_file')->store('design_files', 'public');
            $data['design_file'] = $path;
        }

        $project->update($data);

        return back()->with('success', 'Status pengerjaan dan lampiran file berhasil diperbarui.');
    }
}