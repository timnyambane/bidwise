<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = Auth::user();
        $locations = Location::all();
        $categories = Category::with('services:id,name,category_id')
            ->select('id', 'name')
            ->get();

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $user ? [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'photo' => $this->getUserPhoto($user)
                ] : null,
            ],
            'flash' => [
                'success' => session('success'),
                'error' => session('error'),
                'warning' => session('warning'),
            ],
            'locations' => $locations,
            'categories' => Category::with('services')->get(),
        ]);
    }

    private function getUserPhoto($user)
    {
        if ($user->role === 'customer' && $user->customer) {
            return $user->customer->photo;
        }

        if ($user->role === 'business') {
            return $user->business->photo;
        }

        if ($user->role === 'admin') {
            return $user->admin->photo;
        }

        return null;
    }
}
