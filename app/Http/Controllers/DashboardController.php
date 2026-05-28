<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Finance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin' || $user->role === 'partner') {
            $totalClients = Client::count();
            $activeProjects = Project::where('status', '!=', 'completed')->count();
            
            $incomeThisMonth = Finance::where('transaction_type', 'income')
                                      ->whereMonth('transaction_date', Carbon::now()->month)
                                      ->whereYear('transaction_date', Carbon::now()->year)
                                      ->sum('amount');
                                      
            $upcomingDeadlines = Project::with('client')
                                        ->where('status', '!=', 'completed')
                                        ->orderBy('deadline', 'asc')
                                        ->take(5)
                                        ->get();

            return view('dashboard', compact('totalClients', 'activeProjects', 'incomeThisMonth', 'upcomingDeadlines'));
        }

        if ($user->role === 'designer') {
            $activeTasks = Project::where('status', '!=', 'completed')->count();
            $upcomingDeadlines = Project::where('status', '!=', 'completed')
                                        ->orderBy('deadline', 'asc')
                                        ->take(5)
                                        ->get();
                                        
            return view('dashboard', compact('activeTasks', 'upcomingDeadlines'));
        }
    }
}