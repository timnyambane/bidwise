<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = JobPost::where('user_id', Auth::id())->latest()->get();
        return response()->json(['jobs' => $jobs]);
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

        try {
            $validated = $request->validate([
                'selectedCategory' => 'required|exists:work_categories,id',
                'selectedService' => 'required|exists:services,id',
                'selectedLocation' => 'required|exists:locations,id',
                'title' => 'required|string|max:255',
                'desc' => 'required|string',
                'urgency' => 'nullable|string|in:specificDate,flexible,immediately',
                'specificDate' => 'nullable|date',
            ]);


            $jobPost = JobPost::create([
                'user_id' => Auth::id(),
                'work_category_id' => $validated['selectedCategory'],
                'service_id' => $validated['selectedService'],
                'location_id' => $validated['selectedLocation'],
                'title' => $validated['title'],
                'description' => $validated['desc'],
                'urgency' => $validated['urgency'],
                'specificDate' => $validated['specificDate'],
            ]);

            return redirect()->back()->with('success', 'Job post created successfully');
        } catch (Exception $e) {
            Log::error('Error storing job post', [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'Failed to create job post. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPost $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPost $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobPost $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPost $job)
    {
        //
    }
}
