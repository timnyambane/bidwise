<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            ['town' => 'Nairobi', 'latitude' => -1.2867, 'longitude' => 36.8172, 'postcode' => '00100'],
            ['town' => 'Mombasa', 'latitude' => -4.0435, 'longitude' => 39.6682, 'postcode' => '80100'],
            ['town' => 'Kisumu', 'latitude' => -0.0917, 'longitude' => 34.7680, 'postcode' => '40100'],
            ['town' => 'Nakuru', 'latitude' => -0.3031, 'longitude' => 36.0660, 'postcode' => '20100'],
            ['town' => 'Eldoret', 'latitude' => 0.5204, 'longitude' => 35.2690, 'postcode' => '30100'],
            ['town' => 'Thika', 'latitude' => -1.0333, 'longitude' => 37.0667, 'postcode' => '01000'],
            ['town' => 'Meru', 'latitude' => -0.0473, 'longitude' => 37.6484, 'postcode' => '60200'],
            ['town' => 'Kisii', 'latitude' => -0.6767, 'longitude' => 34.7680, 'postcode' => '40200'],
            ['town' => 'Naivasha', 'latitude' => -0.7167, 'longitude' => 36.4333, 'postcode' => '20100'],
            ['town' => 'Nyeri', 'latitude' => -0.4200, 'longitude' => 36.9500, 'postcode' => '10100'],
            ['town' => 'Kitale', 'latitude' => 1.0017, 'longitude' => 35.0035, 'postcode' => '30200'],
            ['town' => 'Kakamega', 'latitude' => 0.2833, 'longitude' => 34.7500, 'postcode' => '50100'],
            ['town' => 'Voi', 'latitude' => -3.3946, 'longitude' => 38.5614, 'postcode' => '80300'],
            ['town' => 'Machakos', 'latitude' => -1.5167, 'longitude' => 37.2667, 'postcode' => '90100'],
            ['town' => 'Bomet', 'latitude' => -0.9897, 'longitude' => 35.1091, 'postcode' => '20400'],
            ['town' => 'Kangundo', 'latitude' => -1.5667, 'longitude' => 37.4500, 'postcode' => '90100'],
            ['town' => 'Embu', 'latitude' => -0.5180, 'longitude' => 37.4545, 'postcode' => '60100'],
            ['town' => 'Bungoma', 'latitude' => 0.5676, 'longitude' => 34.5612, 'postcode' => '50200'],
            ['town' => 'Lodwar', 'latitude' => 3.1283, 'longitude' => 35.6083, 'postcode' => '30500'],
            ['town' => 'Garissa', 'latitude' => -0.4544, 'longitude' => 39.6643, 'postcode' => '70100'],
            ['town' => 'Isiolo', 'latitude' => 0.3500, 'longitude' => 37.5821, 'postcode' => '60300'],
            ['town' => 'Kilifi', 'latitude' => -3.5244, 'longitude' => 39.9506, 'postcode' => '80110'],
            ['town' => 'Mandera', 'latitude' => 3.9724, 'longitude' => 41.8590, 'postcode' => '70300'],
            ['town' => 'Murang’a', 'latitude' => -0.7789, 'longitude' => 37.6589, 'postcode' => '10200'],
            ['town' => 'Taita', 'latitude' => -3.3222, 'longitude' => 38.4372, 'postcode' => '80300'],
            ['town' => 'Mtwapa', 'latitude' => -3.9953, 'longitude' => 39.7204, 'postcode' => '80108'],
            ['town' => 'Wote', 'latitude' => -1.6833, 'longitude' => 37.6667, 'postcode' => '90300'],
            ['town' => 'Nyahururu', 'latitude' => -0.2833, 'longitude' => 36.6000, 'postcode' => '20300'],
            ['town' => 'Ruiru', 'latitude' => -1.1300, 'longitude' => 37.0078, 'postcode' => '00232'],
            ['town' => 'Kajiado', 'latitude' => -2.0142, 'longitude' => 36.7662, 'postcode' => '00100']
        ];



        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
