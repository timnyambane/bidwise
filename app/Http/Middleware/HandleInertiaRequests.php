<?php

namespace App\Http\Middleware;

use App\Models\Location;
use App\Models\WorkCategory;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\Auth;


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
        $locations = Location::select('id', 'location')->orderBy('location', 'asc')->get();
        $workCategories = WorkCategory::where('active', true)
            ->with([
                'services' => function ($query) {
                    $query->where('active', true)->select('id', 'name', 'work_category_id');
                }
            ])
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
                ] : null,
            ],
            'locations' => $locations,
            'work_categories' => $workCategories,
            'flash' => [
                'success' => session('success'),
                'error' => session('error'),
                'warning' => session('warning'),
            ],
        ]);
    }
}
