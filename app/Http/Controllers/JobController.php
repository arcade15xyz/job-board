<?php

namespace App\Http\Controllers;

use App\Models\OfferedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', OfferedJob::class);
        $filters = request()->only(
            'search',
            'min_salary',
            'max_salary',
            'experience',
            'category'
        );

        return view(
            'job.index',
            ['jobs' => OfferedJob::with('employer')->latest()->filter($filters)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OfferedJob $job)
    {
        Gate::authorize('view', $job);
        return view(
            'job.show',
            ['job'=>$job->load('employer.jobs')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OfferedJob $offeredJob)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OfferedJob $offeredJob)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OfferedJob $offeredJob)
    {
        //
    }
}
