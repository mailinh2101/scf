<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::where('published', true)
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->get();

        $siteSettings = \App\Models\SiteSetting::pluck('value', 'key')->toArray();

        return view('careers', compact('jobs', 'siteSettings'));
    }

    public function show($slug)
    {
        $job = Job::where('slug', $slug)
            ->where('published', true)
            ->where('published_at', '<=', now())
            ->firstOrFail();

        $recentJobs = Job::where('published', true)
            ->where('published_at', '<=', now())
            ->where('id', '!=', $job->id)
            ->orderBy('published_at', 'desc')
            ->limit(5)
            ->get();

        $siteSettings = \App\Models\SiteSetting::pluck('value', 'key')->toArray();

        return view('job-detail', compact('job', 'recentJobs', 'siteSettings'));
    }
}
