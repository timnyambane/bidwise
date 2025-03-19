<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        return Inertia::render('Auth/Register/Customer');
    }

    public function store(RegisterCustomerRequest $request)
    {
        $data = $request->validated();

        $name = splitFullName($data['full_name'] ?? null);
        $first_name = $name['first_name'];
        $last_name = $name['last_name'];

        if (!isset($data['full_name'])) {
            $data['full_name'] = trim("$first_name $last_name");
        }

        try {
            $user = User::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => config('constants.accountType.customer')
            ]);

            Customer::create([
                'user_id' => $user->id,
                'phone' => formatPhoneNumber($data['phone'])
            ]);

            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Registration successful!');
        } catch (Exception $e) {
            Log::error('Registration failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $data // Log request data for debugging
            ]);

            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred during registration.']);
        }
    }

    public function show(Customer $customer)
    {
        //
    }

    public function edit(Customer $customer)
    {
        //
    }

    public function update(Request $request, Customer $customer)
    {
        //
    }

    public function destroy(Customer $customer)
    {
        //
    }
}
