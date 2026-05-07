<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    /**
     * Show the form for creating a new issue.
     */
    public function create(): View
    {
        return view('issues.create');
    }

    /**
     * Store a newly created issue in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:Roads,Lighting,Waste,Water,Other',
            'description' => 'required|string|max:1000',
            'address' => 'nullable|string|max:255',
        ]);

        $request->user()->issues()->create($validated);

        return redirect()->route('dashboard')
            ->with('status', 'issue-reported')
            ->with('message', 'Your report has been submitted successfully!');
    }
}
