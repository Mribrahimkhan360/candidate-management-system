<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Interview;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isCandidate()) {
            $candidate = $user->candidate;
            return view('candidate.dashboard', compact('candidate'));
        }

        // Admin and Staff Dashboard
        $totalCandidates = Candidate::count();
        $pendingCandidates = Candidate::where('status', 'pending')->count();
        $hiredCandidates = Candidate::where('status', 'hired')->count();
        
        // Count both rejected_first AND rejected_final
        $rejectedCandidates = Candidate::whereIn('status', ['rejected_first', 'rejected_final'])->count();
        
        $upcomingInterviews = Interview::where('status', 'upcoming')->count();

        return view('dashboard', compact(
            'totalCandidates',
            'pendingCandidates',
            'hiredCandidates',
            'rejectedCandidates',
            'upcomingInterviews'
        ));
    }
}