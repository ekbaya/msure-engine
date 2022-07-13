<?php

namespace Database\Seeders;

use App\Models\County;
use App\Models\Region;
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
                'region_id'=> Region::query()->where("name", "Coastal Region")->firstOrFail()->id,
                'code' => '001',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kwale',
                'region_id'=> Region::query()->where("name", "Coastal Region")->firstOrFail()->id,
                'code' => '002',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kilifi',
                'region_id'=> Region::query()->where("name", "Coastal Region")->firstOrFail()->id,
                'code' => '003',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Tana River',
                'region_id'=> Region::query()->where("name", "Coastal Region")->firstOrFail()->id,
                'code' => '004',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Lamu',
                'region_id'=> Region::query()->where("name", "Coastal Region")->firstOrFail()->id,
                'code' => '005',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Taita Taveta',
                'region_id'=> Region::query()->where("name", "Coastal Region")->firstOrFail()->id,
                'code' => '006',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Garissa',
                'region_id'=> Region::query()->where("name", "North Eastern")->firstOrFail()->id,
                'code' => '007',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Wajir',
                'region_id'=> Region::query()->where("name", "North Eastern")->firstOrFail()->id,
                'code' => '008',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mandera',
                'region_id'=> Region::query()->where("name", "North Eastern")->firstOrFail()->id,
                'code' => '009',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Marsabit',
                'region_id'=> Region::query()->where("name", "North Eastern")->firstOrFail()->id,
                'code' => '010',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Isiolo',
                'region_id'=> Region::query()->where("name", "North Eastern")->firstOrFail()->id,
                'code' => '011',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Meru',
                'region_id'=> Region::query()->where("name", "Mount Kenya Region")->firstOrFail()->id,
                'code' => '012',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Tharaka Nithi',
                'region_id'=> Region::query()->where("name", "Mount Kenya Region")->firstOrFail()->id,
                'code' => '013',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Embu',
                'region_id'=> Region::query()->where("name", "Mount Kenya Region")->firstOrFail()->id,
                'code' => '014',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Nyandarua',
                'region_id'=> Region::query()->where("name", "Mount Kenya Region")->firstOrFail()->id,
                'code' => '018',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Nyeri',
                'region_id'=> Region::query()->where("name", "Mount Kenya Region")->firstOrFail()->id,
                'code' => '019',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kirinyaga',
                'region_id'=> Region::query()->where("name", "Mount Kenya Region")->firstOrFail()->id,
                'code' => '020',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Murang'a",
                'region_id'=> Region::query()->where("name", "Mount Kenya Region")->firstOrFail()->id,
                'code' => '021',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kiambu',
                'region_id'=> Region::query()->where("name", "Mount Kenya Region")->firstOrFail()->id,
                'code' => '022',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kitui',
                'region_id'=> Region::query()->where("name", "Eastern Region")->firstOrFail()->id,
                'code' => '015',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Machakos',
                'region_id'=> Region::query()->where("name", "Eastern Region")->firstOrFail()->id,
                'code' => '016',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Makueni',
                'region_id'=> Region::query()->where("name", "Eastern Region")->firstOrFail()->id,
                'code' => '017',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Turkana',
                'region_id'=> Region::query()->where("name", "Rift Valley Region North")->firstOrFail()->id,
                'code' => '023',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'West Pokot',
                'region_id'=> Region::query()->where("name", "Rift Valley Region North")->firstOrFail()->id,
                'code' => '024',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Samburu',
                'region_id'=> Region::query()->where("name", "Rift Valley Region North")->firstOrFail()->id,
                'code' => '025',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Trans Nzioa',
                'region_id'=> Region::query()->where("name", "Rift Valley Region North")->firstOrFail()->id,
                'code' => '026',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Uasin Gishu',
                'region_id'=> Region::query()->where("name", "Rift Valley Region Central")->firstOrFail()->id,
                'code' => '027',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Elgeyo Marakwet',
                'region_id'=> Region::query()->where("name", "Rift Valley Region Central")->firstOrFail()->id,
                'code' => '028',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Nandi',
                'region_id'=> Region::query()->where("name", "Rift Valley Region Central")->firstOrFail()->id,
                'code' => '029',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Baringo',
                'region_id'=> Region::query()->where("name", "Rift Valley Region Central")->firstOrFail()->id,
                'code' => '030',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Laikipia',
                'region_id'=> Region::query()->where("name", "Rift Valley Region Central")->firstOrFail()->id,
                'code' => '031',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Nakuru',
                'region_id'=> Region::query()->where("name", "Rift Valley Region Central")->firstOrFail()->id,
                'code' => '032',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Narok',
                'region_id'=> Region::query()->where("name", "Rift Valley Region South")->firstOrFail()->id,
                'code' => '033',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kajiado',
                'region_id'=> Region::query()->where("name", "Rift Valley Region South")->firstOrFail()->id,
                'code' => '034',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kericho',
                'region_id'=> Region::query()->where("name", "Rift Valley Region Central")->firstOrFail()->id,
                'code' => '035',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bomet',
                'region_id'=> Region::query()->where("name", "Rift Valley Region Central")->firstOrFail()->id,
                'code' => '036',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kakamega',
                'region_id'=> Region::query()->where("name", "Western Region")->firstOrFail()->id,
                'code' => '037',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Vihiga',
                'region_id'=> Region::query()->where("name", "Western Region")->firstOrFail()->id,
                'code' => '038',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bungoma',
                'region_id'=> Region::query()->where("name", "Western Region")->firstOrFail()->id,
                'code' => '039',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Busia',
                'region_id'=> Region::query()->where("name", "Western Region")->firstOrFail()->id,
                'code' => '040',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Siaya',
                'region_id'=> Region::query()->where("name", "Nyanza Region")->firstOrFail()->id,
                'code' => '041',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kisumu',
                'region_id'=> Region::query()->where("name", "Nyanza Region")->firstOrFail()->id,
                'code' => '042',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Homabay',
                'region_id'=> Region::query()->where("name", "Nyanza Region")->firstOrFail()->id,
                'code' => '043',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Migori',
                'region_id'=> Region::query()->where("name", "Nyanza Region")->firstOrFail()->id,
                'code' => '044',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kisii',
                'region_id'=> Region::query()->where("name", "Nyanza Region")->firstOrFail()->id,
                'code' => '045',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Nyamira',
                'region_id'=> Region::query()->where("name", "Nyanza Region")->firstOrFail()->id,
                'code' => '046',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Nairobi City',
                'region_id'=> Region::query()->where("name", "Nairobi")->firstOrFail()->id,
                'code' => '047',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        County::insert($counties);
    }
}
