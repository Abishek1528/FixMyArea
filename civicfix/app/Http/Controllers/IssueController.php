<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IssueController extends Controller
{
    /**
     * Show the form for creating a new issue.
     */
    public function create(): View
    {
        return view('issues.create');
    }
}
