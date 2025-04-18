<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\OfferedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAnyEmployer', OfferedJob::class);
        return view('my_job.index',
        [
            'jobs' => Auth::user()->employer
            ->jobs()
            ->with(['employer', 'jobApplications', 'jobApplications.user'])
            ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create',OfferedJob::class);
        return view('my_job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create',OfferedJob::class);
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric|min:5000',
            'description'=>'required|string',
            'experience' => 'required|in:' . implode(',',OfferedJob::$experience),
            'category' => 'required|in:' . implode(',',OfferedJob::$category)
        ]);


        Auth::user()->employer->jobs()->create($validateData);
        return redirect()->route('my-jobs.index')->with('success','Job submitted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OfferedJob $myJob)
    {
        Gate::authorize('update', $myJob);
        return view('my_job.edit',['job' => $myJob]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, OfferedJob $myJob)
    {
        $myJob->update($request->validated());
        return redirect()->route('my-jobs.index')->with('success','Job Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OfferedJob $myJob)
    {
        $myJob->delete();
        return redirect()->route('my-jobs.index')
        ->with('success','Job deleted');
    }
}
