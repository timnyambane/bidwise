<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobPostController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $jobPosts = JobPost::whereHas(
            'customer',
            fn($query) =>
            $query->where('user_id', $user->id)
        )
            ->with(['category', 'service', 'location', 'customer.user'])
            ->orderByDesc('updated_at')
            ->get();


        return response()->json([
            'data' => [
                'jobPosts' => $jobPosts->map(function ($job) {
                    return [
                        'id' => $job->id,
                        'title' => $job->title,
                        'desc' => $job->desc,
                        'customer' => $job->customer ? [
                            'id' => $job->customer->id,
                            'first_name' => $job->customer->user->first_name ?? null,
                            'last_name' => $job->customer->user->last_name ?? null,
                            'phone' => $job->customer->phone ?? null,
                            'photo' => $job->customer->photo ?? null,
                        ] : null,
                        'category' => $job->category ? $job->category->name : null,
                        'service' => $job->service ? $job->service->name : null,
                        'location' => $job->location ? $job->location->location : null,
                        'urgency' => $job->urgency,
                        'property' => $job->property,
                        'standard' => $job->standard,
                        'date' => $job->date,
                        'created_at' => $job->created_at,
                        'updated_at' => $job->updated_at,
                    ];
                }),
            ],
        ]);
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'category.id' => 'required|exists:categories,id',
            'service.id' => 'required|exists:services,id',
            'location.id' => 'required|exists:locations,id',
            'urgency' => 'required|in:flexible,specificDate,immediately',
            'property' => 'required|string',
            'standard' => 'required|boolean',
            'date' => 'nullable|date_format:Y-m-d H:i:s|required_if:urgency,specificDate',
        ]);

        $validated['location_id'] = $validated['location']['id'];
        $validated['category_id'] = $validated['category']['id'];
        $validated['service_id'] = $validated['service']['id'];
        $validated['standard'] = filter_var($validated['standard'], FILTER_VALIDATE_BOOLEAN);
        unset($validated['location'], $validated['category'], $validated['service']);

        if (!empty($validated['date'])) {
            $validated['date'] = Carbon::parse($validated['date'])->format('Y-m-d');
        }


        $validated['customer_id'] = Auth::user()->customer->id;

        $jobPosting = JobPost::create($validated);

        return back()->with([
            'success' => 'Job post created successfully!',
            'job_posting' => $jobPosting
        ]);
    }
}