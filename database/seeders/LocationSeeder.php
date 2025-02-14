<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            [
                "location" => "London, England, EC1A",
                "town" => "London",
                "country" => "GB",
                "region" => "England",
                "latitude" => "51.509865",
                "longitude" => "-0.118092",
                "postcode" => "EC1A"
            ],
            [
                "location" => "Birmingham, England, B1",
                "town" => "Birmingham",
                "country" => "GB",
                "region" => "England",
                "latitude" => "52.489471",
                "longitude" => "-1.898575",
                "postcode" => "B1"
            ],
            [
                "location" => "Glasgow, Scotland, G1",
                "town" => "Glasgow",
                "country" => "GB",
                "region" => "Scotland",
                "latitude" => "55.860916",
                "longitude" => "-4.251433",
                "postcode" => "G1"
            ],
            [
                "location" => "Liverpool, England, L1",
                "town" => "Liverpool",
                "country" => "GB",
                "region" => "England",
                "latitude" => "53.400002",
                "longitude" => "-2.983333",
                "postcode" => "L1"
            ],
            [
                "location" => "Leeds, England, LS1",
                "town" => "Leeds",
                "country" => "GB",
                "region" => "England",
                "latitude" => "53.801277",
                "longitude" => "-1.548567",
                "postcode" => "LS1"
            ],
            [
                "location" => "Sheffield, England, S1",
                "town" => "Sheffield",
                "country" => "GB",
                "region" => "England",
                "latitude" => "53.383331",
                "longitude" => "-1.466667",
                "postcode" => "S1"
            ],
            [
                "location" => "Edinburgh, Scotland, EH1",
                "town" => "Edinburgh",
                "country" => "GB",
                "region" => "Scotland",
                "latitude" => "55.953251",
                "longitude" => "-3.188267",
                "postcode" => "EH1"
            ],
            [
                "location" => "Bristol, England, BS1",
                "town" => "Bristol",
                "country" => "GB",
                "region" => "England",
                "latitude" => "51.454514",
                "longitude" => "-2.587910",
                "postcode" => "BS1"
            ],
            [
                "location" => "Manchester, England, M1",
                "town" => "Manchester",
                "country" => "GB",
                "region" => "England",
                "latitude" => "53.483959",
                "longitude" => "-2.244644",
                "postcode" => "M1"
            ],
            [
                "location" => "Leicester, England, LE1",
                "town" => "Leicester",
                "country" => "GB",
                "region" => "England",
                "latitude" => "52.633331",
                "longitude" => "-1.133333",
                "postcode" => "LE1"
            ],
            [
                "location" => "Coventry, England, CV1",
                "town" => "Coventry",
                "country" => "GB",
                "region" => "England",
                "latitude" => "52.408054",
                "longitude" => "-1.510556",
                "postcode" => "CV1"
            ],
            [
                "location" => "Kingston upon Hull, England, HU1",
                "town" => "Hull",
                "country" => "GB",
                "region" => "England",
                "latitude" => "53.767750",
                "longitude" => "-0.335827",
                "postcode" => "HU1"
            ],
            [
                "location" => "Cardiff, Wales, CF10",
                "town" => "Cardiff",
                "country" => "GB",
                "region" => "Wales",
                "latitude" => "51.481583",
                "longitude" => "-3.179090",
                "postcode" => "CF10"
            ],
            [
                "location" => "Bradford, England, BD1",
                "town" => "Bradford",
                "country" => "GB",
                "region" => "England",
                "latitude" => "53.799999",
                "longitude" => "-1.750000",
                "postcode" => "BD1"
            ],
            [
                "location" => "Belfast, Northern Ireland, BT1",
                "town" => "Belfast",
                "country" => "GB",
                "region" => "Northern Ireland",
                "latitude" => "54.607868",
                "longitude" => "-5.926437",
                "postcode" => "BT1"
            ],
            [
                "location" => "Stoke-on-Trent, England, ST1",
                "town" => "Stoke-on-Trent",
                "country" => "GB",
                "region" => "England",
                "latitude" => "53.002666",
                "longitude" => "-2.179404",
                "postcode" => "ST1"
            ],
            [
                "location" => "Wolverhampton, England, WV1",
                "town" => "Wolverhampton",
                "country" => "GB",
                "region" => "England",
                "latitude" => "52.591370",
                "longitude" => "-2.110748",
                "postcode" => "WV1"
            ],
            [
                "location" => "Plymouth, England, PL1",
                "town" => "Plymouth",
                "country" => "GB",
                "region" => "England",
                "latitude" => "50.376289",
                "longitude" => "-4.143841",
                "postcode" => "PL1"
            ],
            [
                "location" => "Nottingham, England, NG1",
                "town" => "Nottingham",
                "country" => "GB",
                "region" => "England",
                "latitude" => "52.950001",
                "longitude" => "-1.150000",
                "postcode" => "NG1"
            ],
            [
                "location" => "Southampton, England, SO14",
                "town" => "Southampton",
                "country" => "GB",
                "region" => "England",
                "latitude" => "50.909698",
                "longitude" => "-1.404351",
                "postcode" => "SO14"
            ],
            [
                "location" => "Derby, England, DE1",
                "town" => "Derby",
                "country" => "GB",
                "region" => "England",
                "latitude" => "52.922530",
                "longitude" => "-1.474619",
                "postcode" => "DE1"
            ],
            [
                "location" => "Portsmouth, England, PO1",
                "town" => "Portsmouth",
                "country" => "GB",
                "region" => "England",
                "latitude" => "50.798912",
                "longitude" => "-1.091163",
                "postcode" => "PO1"
            ],
            [
                "location" => "Swansea, Wales, SA1",
                "town" => "Swansea",
                "country" => "GB",
                "region" => "Wales",
                "latitude" => "51.621441",
                "longitude" => "-3.943646",
                "postcode" => "SA1"
            ],
            [
                "location" => "Exeter, England, EX1",
                "town" => "Exeter",
                "country" => "GB",
                "region" => "England",
                "latitude" => "50.718412",
                "longitude" => "-3.533899",
                "postcode" => "EX1"
            ],
            [
                "location" => "Sunderland, England, SR1",
                "town" => "Sunderland",
                "country" => "GB",
                "region" => "England",
                "latitude" => "54.906101",
                "longitude" => "-1.381130",
                "postcode" => "SR1"
            ],
            [
                "location" => "Luton, England, LU1",
                "town" => "Luton",
                "country" => "GB",
                "region" => "England",
                "latitude" => "51.878670",
                "longitude" => "-0.420025",
                "postcode" => "LU1"
            ],
            [
                "location" => "Preston, England, PR1",
                "town" => "Preston",
                "country" => "GB",
                "region" => "England",
                "latitude" => "53.763201",
                "longitude" => "-2.703090",
                "postcode" => "PR1"
            ],
            [
                "location" => "Aberdeen, Scotland, AB10",
                "town" => "Aberdeen",
                "country" => "GB",
                "region" => "Scotland",
                "latitude" => "57.149651",
                "longitude" => "-2.099075",
                "postcode" => "AB10"
            ],
            [
                "location" => "Norwich, England, NR1",
                "town" => "Norwich",
                "country" => "GB",
                "region" => "England",
                "latitude" => "52.630886",
                "longitude" => "1.297355",
                "postcode" => "NR1"
            ],
            [
                "location" => "Oxford, England, OX1",
                "town" => "Oxford",
                "country" => "GB",
                "region" => "England",
                "latitude" => "51.752022",
                "longitude" => "-1.257677",
                "postcode" => "OX1"
            ],
            [
                "location" => "Cambridge, England, CB1",
                "town" => "Cambridge",
                "country" => "GB",
                "region" => "England",
                "latitude" => "52.205337",
                "longitude" => "0.121817",
                "postcode" => "CB1"
            ],
            [
                "location" => "Reading, England, RG1",
                "town" => "Reading",
                "country" => "GB",
                "region" => "England",
                "latitude" => "51.454266",
                "longitude" => "-0.978130",
                "postcode" => "RG1"
            ],
            [
                "location" => "Middlesbrough, England, TS1",
                "town" => "Middlesbrough",
                "country" => "GB",
                "region" => "England",
                "latitude" => "54.576227",
                "longitude" => "-1.234956",
                "postcode" => "TS1"
            ],
            [
                "location" => "Blackpool, England, FY1",
                "town" => "Blackpool",
                "country" => "GB",
                "region" => "England",
                "latitude" => "53.817505",
                "longitude" => "-3.035675",
                "postcode" => "FY1"
            ],
            [
                "location" => "Newcastle upon Tyne, England, NE1",
                "town" => "Newcastle",
                "country" => "GB",
                "region" => "England",
                "latitude" => "54.978252",
                "longitude" => "-1.617439",
                "postcode" => "NE1"
            ],
            [
                "location" => "Chelmsford, England, CM1",
                "town" => "Chelmsford",
                "country" => "GB",
                "region" => "England",
                "latitude" => "51.735586",
                "longitude" => "0.468549",
                "postcode" => "CM1"
            ],
            [
                "location" => "Brighton, England, BN1",
                "town" => "Brighton",
                "country" => "GB",
                "region" => "England",
                "latitude" => "50.822529",
                "longitude" => "-0.137163",
                "postcode" => "BN1"
            ],
            [
                "location" => "Dundee, Scotland, DD1",
                "town" => "Dundee",
                "country" => "GB",
                "region" => "Scotland",
                "latitude" => "56.462002",
                "longitude" => "-2.970700",
                "postcode" => "DD1"
            ],
            [
                "location" => "York, England, YO1",
                "town" => "York",
                "country" => "GB",
                "region" => "England",
                "latitude" => "53.9590",
                "longitude" => "-1.0815",
                "postcode" => "YO1"
            ],
            [
                "location" => "Chester, England, CH1",
                "town" => "Chester",
                "country" => "GB",
                "region" => "England",
                "latitude" => "53.190887",
                "longitude" => "-2.890896",
                "postcode" => "CH1"
            ]
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
