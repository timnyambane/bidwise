<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterBusinessRequest;
use App\Http\Requests\RegisterCustomerRequest;
use App\Models\Business;
use App\Models\Location;
use App\Models\Service;
use App\Models\User;
use App\Models\WorkCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return Inertia response with users data for the form
        return Inertia::render('auth/register/Business');
    }

    public function validateUser(RegisterCustomerRequest $request)
    {
        $request->validated();

    }

    public function validateBusiness(RegisterBusinessRequest $request)
    {
        $request->validated();
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $data = $request->all();

        $name = splitFullName($data['full_name'] ?? null);
        $firstName = $name['first_name'];
        $lastName = $name['last_name'];

        // Ensure full_name is set properly
        if (!isset($data['full_name'])) {
            $data['full_name'] = trim("$firstName $lastName");
        }

        try {
            // Validate necessary fields
            if (!isset($data['location']['id']) || !isset($data['work_category']['id'])) {
                return redirect()->back()->withErrors(['error' => 'Invalid location or work category']);
            }

            // Create User
            $user = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => config('constants.accountType.business')
            ]);

            // Fetch the location and work category by their IDs
            $location = Location::find($data['location']['id']);
            $workCategory = WorkCategory::find($data['work_category']['id']);

            // Check if the location or work category does not exist
            if (!$location || !$workCategory) {
                return redirect()->back()->withErrors(['error' => 'Location or Work Category not found']);
            }

            // Create the Business
            $business = Business::create([
                'user_id' => $user->id,
                'name' => $data['business_name'],
                'location' => $location->location,
                'work_category' => $workCategory->name,
                'phone' => formatPhoneNumber($data['phone'])
            ]);

            // Link the Business to its services
            $serviceIds = array_column($data['services'], 'id');
            $services = Service::whereIn('id', $serviceIds)->get();
            $business->services()->sync($services);

            // Link the Business to its Location (Single Location)
            $business->locations()->attach($location);  // Attach the single location

            session()->flash('success', 'Business account registered successfully');
            return redirect()->route('login');

        } catch (\Exception $e) {
            Log::error('Error creating business', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $data // Log request data for debugging
            ]);

            session()->flash('error', 'An error occurred while registering the business.');
            return redirect()->back()->withInput();
        }
    }





    /**
     * Display the specified resource.
     */
    public function show(Business $business)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Business $business)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business)
    {
        //
    }
}
