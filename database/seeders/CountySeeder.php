<?php

namespace Database\Seeders;

use App\Models\County;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        County::truncate();

        $counties =  [
            [
                'name' => 'Mombasa',
                'region_id'=> 1,
                'code' => '001',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kwale',
                'region_id'=> 1,
                'code' => '002',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kilifi',
                'region_id'=> 1,
                'code' => '003',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Tana River',
                'region_id'=> 1,
                'code' => '004',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Lamu',
                'region_id'=> 1,
                'code' => '005',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Taita Taveta',
                'region_id'=> 1,
                'code' => '006',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Garissa',
                'region_id'=> 2,
                'code' => '007',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Wajir',
                'region_id'=> 2,
                'code' => '008',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mandera',
                'region_id'=> 2,
                'code' => '009',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Marsabit',
                'region_id'=> 2,
                'code' => '010',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Isiolo',
                'region_id'=> 2,
                'code' => '011',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Meru',
                'region_id'=> 3,
                'code' => '012',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Tharaka Nithi',
                'region_id'=> 3,
                'code' => '013',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Embu',
                'region_id'=> 3,
                'code' => '014',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Nyandarua',
                'region_id'=> 3,
                'code' => '018',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Nyeri',
                'region_id'=> 3,
                'code' => '019',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kirinyaga',
                'region_id'=> 3,
                'code' => '020',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Murang'a",
                'region_id'=> 3,
                'code' => '021',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kiambu',
                'region_id'=> 3,
                'code' => '022',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kitui',
                'region_id'=> 4,
                'code' => '015',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Machakos',
                'region_id'=> 4,
                'code' => '016',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Makueni',
                'region_id'=> 4,
                'code' => '017',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Turkana',
                'region_id'=> 5,
                'code' => '023',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'West Pokot',
                'region_id'=> 5,
                'code' => '024',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Samburu',
                'region_id'=> 5,
                'code' => '025',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Trans Nzioa',
                'region_id'=> 5,
                'code' => '026',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Uasin Gishu',
                'region_id'=> 6,
                'code' => '027',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Elgeyo Marakwet',
                'region_id'=> 6,
                'code' => '028',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Nandi',
                'region_id'=> 6,
                'code' => '029',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Baringo',
                'region_id'=> 6,
                'code' => '030',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Laikipia',
                'region_id'=> 6,
                'code' => '031',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Nakuru',
                'region_id'=> 6,
                'code' => '032',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Narok',
                'region_id'=> 7,
                'code' => '033',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kajiado',
                'region_id'=> 7,
                'code' => '034',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kericho',
                'region_id'=> 6,
                'code' => '035',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bomet',
                'region_id'=> 6,
                'code' => '036',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kakamega',
                'region_id'=> 8,
                'code' => '037',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Vihiga',
                'region_id'=> 8,
                'code' => '038',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bungoma',
                'region_id'=> 8,
                'code' => '039',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Busia',
                'region_id'=> 8,
                'code' => '040',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Siaya',
                'region_id'=> 9,
                'code' => '041',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kisumu',
                'region_id'=> 9,
                'code' => '042',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Homabay',
                'region_id'=> 9,
                'code' => '043',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Migori',
                'region_id'=> 9,
                'code' => '044',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kisii',
                'region_id'=> 9,
                'code' => '045',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Nyamira',
                'region_id'=> 9,
                'code' => '046',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Nairobi City',
                'region_id'=> 10,
                'code' => '047',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        County::insert($counties);
    }
}
