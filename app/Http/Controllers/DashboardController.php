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

        // Data khusus Admin & Partner (Bos dan Manajer)
        if ($user->role === 'admin' || $user->role === 'partner') {
            $totalClients = Client::count();
            $activeProjects = Project::where('status', '!=', 'completed')->count();
            
            // Hitung total pemasukan khusus di bulan ini saja
            $incomeThisMonth = Finance::where('transaction_type', 'income')
                                      ->whereMonth('transaction_date', Carbon::now()->month)
                                      ->whereYear('transaction_date', Carbon::now()->year)
                                      ->sum('amount');
                                      
            // Ambil 5 project dengan deadline paling mepet
            $upcomingDeadlines = Project::with('client')
                                        ->where('status', '!=', 'completed')
                                        ->orderBy('deadline', 'asc')
                                        ->take(5)
                                        ->get();

            return view('dashboard', compact('totalClients', 'activeProjects', 'incomeThisMonth', 'upcomingDeadlines'));
        }

        // Data khusus Designer
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