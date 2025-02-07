<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterBusinessRequest;
use App\Http\Requests\RegisterCustomerRequest;
use App\Models\Business;
use App\Models\User;
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

        // Extract first and last name from full_name
        if (isset($data['full_name'])) {
            $nameParts = explode(' ', $data['full_name'], 2);
            $firstName = $nameParts[0] ?? '';
            $lastName = $nameParts[1] ?? '';
        } else {
            $firstName = $request->get('firstName', '');
            $lastName = $request->get('lastName', '');
            $data['full_name'] = trim("$firstName $lastName");
        }

        try {
            // Validate necessary fields
            if (!isset($data['location']['id']) || !isset($data['work_category']['id'])) {
                return redirect()->back()->withErrors(['error' => 'Invalid location or work category']);
            }

            $phoneNumber = $data['phone'];
            if (substr($phoneNumber, 0, 2) === '07') {
                $data['phone'] = config('constants.country_code') . substr($phoneNumber, 1);
            }

            // Create User
            $user = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => config('constants.accountType.business')
            ]);

            $phone =

                // Create a single Business (not looping!)
                $business = Business::create([
                    'user_id' => $user->id,
                    'name' => $data['business_name'],
                    'location' => $data['location']['town'],
                    'work_category' => $data['work_category']['name'],
                    'phone' => $data['phone'],
                ]);

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
