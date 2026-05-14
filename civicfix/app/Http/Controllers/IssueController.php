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
     * Display a listing of the user's reported issues.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $issues = $user->issues()
            ->latest()
            ->paginate(10);

        $stats = [
            'total' => $user->issues()->count(),
            'pending' => $user->issues()->where('status', 'pending')->count(),
            'in_progress' => $user->issues()->where('status', 'in_progress')->count(),
            'resolved' => $user->issues()->where('status', 'resolved')->count(),
        ];

        return view('dashboard', [
            'issues' => $issues,
            'stats' => $stats,
        ]);
    }

    /**
     * Display a listing of all issues (community).
     */
    public function all(): View
    {
        $issues = Issue::with('user', 'upvoters')
            ->latest()
            ->paginate(12);

        return view('issues.index', [
            'issues' => $issues,
        ]);
    }

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
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('issues', 'public');
        }

        $request->user()->issues()->create($validated);

        return redirect()->route('dashboard')
            ->with('status', 'issue-reported')
            ->with('message', 'Your report has been submitted successfully!');
    }

    /**
     * Display the specified issue.
     */
    public function show(Issue $issue): View
    {
        $issue->load('comments.user');
        
        return view('issues.show', [
            'issue' => $issue,
        ]);
    }

    /**
     * Store a new comment on an issue.
     */
    public function storeComment(Request $request, Issue $issue): RedirectResponse
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $issue->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        return back()->with('status', 'comment-added')
            ->with('message', 'Your comment has been added successfully!');
    }

    /**
     * Show the form for editing the specified issue.
     */
    public function edit(Issue $issue): View
    {
        if ($issue->user_id !== auth()->id()) {
            abort(403);
        }

        return view('issues.edit', [
            'issue' => $issue,
        ]);
    }

    /**
     * Update the specified issue in storage.
     */
    public function update(Request $request, Issue $issue): RedirectResponse
    {
        if ($issue->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|string|in:pending,investigating,in_progress,resolved,closed',
        ]);

        $issue->update($validated);

        return redirect()->route('issues.show', $issue)
            ->with('status', 'status-updated')
            ->with('message', 'Issue status updated successfully!');
    }

    /**
     * Display the community map with all issues.
     */
    public function map(): View
    {
        $issues = Issue::all(['id', 'title', 'description', 'category', 'status', 'latitude', 'longitude', 'address']);
        
        return view('issues.map', [
            'issues' => $issues,
        ]);
    }

    /**
     * Toggle upvote on an issue.
     */
    public function upvote(Issue $issue): RedirectResponse
    {
        $user = auth()->user();
        
        if ($user->upvotedIssues()->where('issue_id', $issue->id)->exists()) {
            $user->upvotedIssues()->detach($issue);
        } else {
            $user->upvotedIssues()->attach($issue);
        }

        return back();
    }
}
