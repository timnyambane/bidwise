<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = json_decode(file_get_contents(storage_path('app/public/postcodes.json')), true);
        if (!$data)
            return;

        $locations = collect($data)
            ->filter(fn($v) => !empty($v['town']))
            ->take(50)
            ->map(fn($v) => [
                'location' => trim("{$v['town']}, {$v['postcode']}"),
                'town' => $v['town'],
                'region' => $v['region'] ?? '',
                'postcode' => $v['postcode'],
                'eastings' => $v['eastings'],
                'northings' => $v['northings'],
                'longitude' => $v['longitude'],
                'latitude' => $v['latitude'],
            ])
            ->sortBy('location')
            ->values()
            ->all();

        Location::insert($locations);

    }
}
