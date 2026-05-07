<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Http\Requests\StoreIssueRequest;
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
    public function store(StoreIssueRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $request->user()->issues()->create($validated);

        return redirect()->route('dashboard')
            ->with('status', 'issue-reported')
            ->with('message', 'Your report has been submitted successfully!');
    }
}
