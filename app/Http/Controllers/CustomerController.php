<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all customers and pass them to Inertia
        $customers = Customer::with('user')->get();

        // Return the customers to the Vue component using Inertia
        return Inertia::render('Customers/Index', [
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // Return Inertia response with users data for the form
        return Inertia::render('auth/register/Customer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|unique:customers,phone',
        ]);

        if (str_word_count($validated['full_name']) < 2) {
            return back()->withErrors(['full_name' => 'Please provide both first and last names.'])->withInput();
        }

        $nameParts = explode(' ', $validated['full_name'], 2);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';

        $user = User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        $customer = Customer::create([
            'user_id' => $user->id,
            'phone' => $validated['phone'],
        ]);

        // Redirect back with success message using Inertia
        return redirect()->route('login')->with('success', 'Account created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        // Show a single customer
        return Inertia::render('Customers/Show', [
            'customer' => $customer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        // Fetch all users to allow updating user for the customer
        $users = User::all();

        // Return Inertia response with customer and users data for the edit form
        return Inertia::render('Customers/Edit', [
            'customer' => $customer,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'phone' => 'required|phone', // Add proper phone validation
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Optional photo field
        ]);

        // Update customer details
        $customer->update([
            'phone' => $validated['phone'],
            'photo' => $request->file('photo') ? $request->file('photo')->store('photos') : $customer->photo, // Update photo if provided
        ]);

        // Redirect back with success message using Inertia
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        // Delete the customer record
        $customer->delete();

        // Redirect back with success message using Inertia
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
    }
}
