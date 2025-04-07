<?php

namespace App\Http\Controllers;

use App\Models\OfferedJob;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = OfferedJob::query();
        $jobs->when(request('search'), function($query){
            $query->where('title','like','%'.request('search').'%')
                ->orWhere('description','like','%'.request('search').'%');
        });
        return view('job.index',['jobs'=>$jobs->get()]);


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
        return view('job.show',compact('job'));

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
