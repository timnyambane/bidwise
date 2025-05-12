<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterBusinessRequest;
use App\Models\Business;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function validateBusiness(RegisterBusinessRequest $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Auth/Register/Business');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $name = splitFullName($request->full_name ?? null);
            $first_name = $name['first_name'];
            $last_name = $name['last_name'];

            $user = User::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => config('constants.accountType.business')
            ]);

            $location = Location::find($request->location['id']);

            if (!$location) {
                return back()->withErrors(['location' => 'Invalid location selected.'])->withInput();
            }

            $business = $user->business()->create([
                'user_id' => $user->id,
                'location_id' => $location->id,  // Store location ID
                'name' => $request->business_name,
                'phone' => $request->phone,
                'category_id' => $request->category['id'],
            ]);

            $business->services()->attach($request->services);

            DB::commit(); // Commit transaction

            // Redirect to dashboard with success message
            return redirect()->route('dashboard')->with('success', 'Business registered successfully!');

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback on error
            return back()->withErrors(['error' => 'Something went wrong! Please try again.' . $e->getMessage()])->withInput();
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
