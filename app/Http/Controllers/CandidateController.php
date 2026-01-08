<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CandidatesImport;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::latest()->paginate(20);
        return view('admin.candidates.index', compact('candidates'));
    }

    public function hired()
    {
        $candidates = Candidate::where('status', 'hired')->latest()->paginate(20);
        return view('admin.candidates.hired', compact('candidates'));
    }

    public function rejected()
    {
        // Both rejected_first AND rejected_final will show here
        $candidates = Candidate::whereIn('status', ['rejected_first', 'rejected_final'])
            ->latest()
            ->paginate(20);
        return view('admin.candidates.rejected', compact('candidates'));
    }

    public function create()
    {
        return view('admin.candidates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:candidates,email',
            'phone' => 'required|string|max:20',
            'experience_years' => 'required|integer|min:0',
            'age' => 'required|integer|min:18|max:100',
        ]);

        Candidate::create($validated);

        return redirect()->route('candidates.index')->with('success', 'Candidate added successfully.');
    }

    public function show(Candidate $candidate)
    {
        return view('admin.candidates.show', compact('candidate'));
    }

    public function edit(Candidate $candidate)
    {
        return view('admin.candidates.edit', compact('candidate'));
    }

    public function update(Request $request, Candidate $candidate)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:candidates,email,' . $candidate->id,
            'phone' => 'required|string|max:20',
            'experience_years' => 'required|integer|min:0',
            'age' => 'required|integer|min:18|max:100',
        ]);

        $candidate->update($validated);

        return redirect()->route('candidates.index')->with('success', 'Candidate updated successfully.');
    }

    public function destroy(Candidate $candidate)
    {
        $candidate->delete();
        return redirect()->route('candidates.index')->with('success', 'Candidate deleted successfully.');
    }

    public function uploadForm()
    {
        return view('admin.candidates.upload');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            Excel::import(new CandidatesImport, $request->file('file'));
            return redirect()->route('candidates.index')->with('success', 'Candidates imported successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error importing file: ' . $e->getMessage());
        }
    }
}