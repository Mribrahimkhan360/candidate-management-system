<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class InterviewController extends Controller
{
    public function scheduleForm()
    {
        $candidates = Candidate::where('status', 'pending')->get();
        return view('admin.interviews.schedule', compact('candidates'));
    }

    public function schedule(Request $request)
    {
        $request->validate([
            'candidate_ids' => 'required|array',
            'candidate_ids.*' => 'exists:candidates,id',
            'scheduled_date' => 'required|date',
            'interview_type' => 'required|in:first,second',
        ]);

        foreach ($request->candidate_ids as $candidateId) {
            $candidate = Candidate::find($candidateId);
            
            Interview::create([
                'candidate_id' => $candidateId,
                'interview_type' => $request->interview_type,
                'scheduled_date' => $request->scheduled_date,
                'status' => 'upcoming',
            ]);

            if ($request->interview_type === 'first') {
                $candidate->update(['status' => 'first_interview_scheduled']);
            } else {
                $candidate->update(['status' => 'second_interview_scheduled']);
            }
        }

        return redirect()->route('interviews.upcoming')->with('success', 'Interviews scheduled successfully.');
    }

    public function scheduleRange(Request $request)
    {
        $request->validate([
            'start_range' => 'required|integer|min:1',
            'end_range' => 'required|integer|gte:start_range',
            'scheduled_date' => 'required|date',
            'interview_type' => 'required|in:first,second',
        ]);

        $candidates = Candidate::where('status', 'pending')
            ->skip($request->start_range - 1)
            ->take($request->end_range - $request->start_range + 1)
            ->get();

        foreach ($candidates as $candidate) {
            Interview::create([
                'candidate_id' => $candidate->id,
                'interview_type' => $request->interview_type,
                'scheduled_date' => $request->scheduled_date,
                'status' => 'upcoming',
            ]);

            if ($request->interview_type === 'first') {
                $candidate->update(['status' => 'first_interview_scheduled']);
            } else {
                $candidate->update(['status' => 'second_interview_scheduled']);
            }
        }

        return redirect()->route('interviews.upcoming')->with('success', 'Interviews scheduled successfully.');
    }

    public function upcoming()
    {
        // Auto-update completed interviews
        $pastInterviews = Interview::where('status', 'upcoming')
            ->where('scheduled_date', '<', Carbon::now())
            ->get();

        foreach ($pastInterviews as $interview) {
            $interview->update(['status' => 'completed']);
            if ($interview->interview_type === 'first') {
                $interview->candidate->update(['status' => 'first_interview_completed']);
            } else {
                $interview->candidate->update(['status' => 'second_interview_completed']);
            }
        }

        $interviews = Interview::with('candidate')
            ->where('status', 'upcoming')
            ->latest('scheduled_date')
            ->paginate(20);

        return view('admin.interviews.upcoming', compact('interviews'));
    }

    public function completed()
    {
        $interviews = Interview::with('candidate')
            ->where('status', 'completed')
            ->latest('scheduled_date')
            ->paginate(20);

        return view('admin.interviews.completed', compact('interviews'));
    }

    public function markResult(Request $request, Interview $interview)
    {
        $request->validate([
            'result' => 'required|in:passed,rejected',
        ]);

        if ($request->result === 'passed') {
            if ($interview->interview_type === 'first') {
                $interview->candidate->update(['status' => 'passed_first']);
            } else {
                $interview->candidate->update(['status' => 'hired']);
            }
        } else {
            if ($interview->interview_type === 'first') {
                $interview->candidate->update(['status' => 'rejected_first']);
            } else {
                $interview->candidate->update(['status' => 'rejected_final']);
            }
        }

        return redirect()->back()->with('success', 'Candidate result updated successfully.');
    }

    public function downloadPhones()
    {
        // Download as Excel file
        return Excel::download(
            new \App\Exports\PhonesExport(), 
            'upcoming_interview_phones_' . date('Y-m-d') . '.xlsx'
        );
    }

    public function scheduleSecond()
    {
        $candidates = Candidate::where('status', 'passed_first')->get();
        return view('admin.interviews.schedule-second', compact('candidates'));
    }

    public function markComplete(Interview $interview)
    {
        $interview->update(['status' => 'completed']);
        
        if ($interview->interview_type === 'first') {
            $interview->candidate->update(['status' => 'first_interview_completed']);
        } else {
            $interview->candidate->update(['status' => 'second_interview_completed']);
        }

        return redirect()->back()->with('success', 'Interview marked as completed.');
    }

    public function export()
    {
        return Excel::download(
            new \App\Exports\InterviewsExport(), 
            'completed_interviews_' . date('Y-m-d') . '.xlsx'
        );
    }
}