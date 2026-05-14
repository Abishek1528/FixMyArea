<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private function checkAdmin()
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized');
        }
    }

    public function dashboard(): View
    {
        $this->checkAdmin();
        $totalUsers = User::count();
        $totalIssues = Issue::count();
        $pendingIssues = Issue::where('status', 'pending')->count();
        $resolvedIssues = Issue::where('status', 'resolved')->count();
        $inProgressIssues = Issue::where('status', 'in_progress')->count();

        $issuesByCategory = Issue::selectRaw('category, count(*) as count')
            ->groupBy('category')
            ->get()
            ->pluck('count', 'category')
            ->toArray();

        $issuesByStatus = Issue::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();

        $recentIssues = Issue::with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalIssues' => $totalIssues,
            'pendingIssues' => $pendingIssues,
            'resolvedIssues' => $resolvedIssues,
            'inProgressIssues' => $inProgressIssues,
            'issuesByCategory' => $issuesByCategory,
            'issuesByStatus' => $issuesByStatus,
            'recentIssues' => $recentIssues,
        ]);
    }

    public function moderation(): View
    {
        $this->checkAdmin();
        $issues = Issue::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.moderation', [
            'issues' => $issues,
        ]);
    }

    public function editIssue(Issue $issue): View
    {
        $this->checkAdmin();
        return view('admin.edit-issue', [
            'issue' => $issue,
        ]);
    }

    public function updateIssue(Request $request, Issue $issue): RedirectResponse
    {
        $this->checkAdmin();
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'category' => 'required|string|in:Roads,Lighting,Waste,Water,Other',
            'status' => 'required|string|in:pending,investigating,in_progress,resolved,closed',
        ]);

        $issue->update($validated);

        return redirect()->route('admin.moderation')
            ->with('status', 'issue-updated')
            ->with('message', 'Issue updated successfully!');
    }

    public function deleteIssue(Issue $issue): RedirectResponse
    {
        $this->checkAdmin();
        $issue->delete();

        return redirect()->route('admin.moderation')
            ->with('status', 'issue-deleted')
            ->with('message', 'Issue deleted successfully!');
    }
}
