<?php

namespace Database\Seeders;

use App\Models\SubCounty;
use App\Models\Ward;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ward::truncate();

        $wards =  [
            [
                'name' => 'CBD',
                'sub_county_id' => SubCounty::query()->where("name","Starehe")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ngara',
                'sub_county_id' => SubCounty::query()->where("name","Starehe")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Pangani',
                'sub_county_id' => SubCounty::query()->where("name","Starehe")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ziwani/Kariokor',
                'sub_county_id' => SubCounty::query()->where("name","Starehe")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Landmawe',
                'sub_county_id' => SubCounty::query()->where("name","Starehe")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Harambee',
                'sub_county_id' => SubCounty::query()->where("name","Makadara")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Makongeni',
                'sub_county_id' => SubCounty::query()->where("name","Makadara")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Viwandani',
                'sub_county_id' => SubCounty::query()->where("name","Makadara")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Hamza/Maringo',
                'sub_county_id' => SubCounty::query()->where("name","Makadara")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Pumwani',
                'sub_county_id' => SubCounty::query()->where("name","Kamukunji")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Airbase',
                'sub_county_id' => SubCounty::query()->where("name","Kamukunji")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Califonia',
                'sub_county_id' => SubCounty::query()->where("name","Kamukunji")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Eastleigh South',
                'sub_county_id' => SubCounty::query()->where("name","Kamukunji")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Eastleigh North',
                'sub_county_id' => SubCounty::query()->where("name","Kamukunji")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Parklands/Highrise',
                'sub_county_id' => SubCounty::query()->where("name","Westlands")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kangemi',
                'sub_county_id' => SubCounty::query()->where("name","Westlands")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kitisuru',
                'sub_county_id' => SubCounty::query()->where("name","Westlands")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Highridge/Karura',
                'sub_county_id' => SubCounty::query()->where("name","Westlands")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mountain View',
                'sub_county_id' => SubCounty::query()->where("name","Westlands")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kilimani',
                'sub_county_id' => SubCounty::query()->where("name","Dagoreti North")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kawangware',
                'sub_county_id' => SubCounty::query()->where("name","Dagoreti North")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gatina',
                'sub_county_id' => SubCounty::query()->where("name","Dagoreti North")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kileleshwa',
                'sub_county_id' => SubCounty::query()->where("name","Dagoreti North")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kabiria',
                'sub_county_id' => SubCounty::query()->where("name","Dagoreti North")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mutuine',
                'sub_county_id' => SubCounty::query()->where("name","Dagoretti South")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ngando',
                'sub_county_id' => SubCounty::query()->where("name","Dagoretti South")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Riruta',
                'sub_county_id' => SubCounty::query()->where("name","Dagoretti South")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Uthiru/Ruthimitu',
                'sub_county_id' => SubCounty::query()->where("name","Dagoretti South")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Waithaka',
                'sub_county_id' => SubCounty::query()->where("name","Dagoretti South")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Laini Saba',
                'sub_county_id' => SubCounty::query()->where("name","Kibra")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Lindi',
                'sub_county_id' => SubCounty::query()->where("name","Kibra")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Makina',
                'sub_county_id' => SubCounty::query()->where("name","Kibra")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Sarangombe',
                'sub_county_id' => SubCounty::query()->where("name","Kibra")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kenyatta/Woodley',
                'sub_county_id' => SubCounty::query()->where("name","Kibra")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Golfcourse',
                'sub_county_id' => SubCounty::query()->where("name","Kibra")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Karen',
                'sub_county_id' => SubCounty::query()->where("name","Langata")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Nairobi West',
                'sub_county_id' => SubCounty::query()->where("name","Langata")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mugumuine',
                'sub_county_id' => SubCounty::query()->where("name","Langata")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'South C',
                'sub_county_id' => SubCounty::query()->where("name","Langata")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Nyayo Highrise',
                'sub_county_id' => SubCounty::query()->where("name","Langata")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Pipeline',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi South")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kware',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi South")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kwa Reuben',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi South")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kwa Njenga',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi South")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Imara Daima',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi South")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Utawala',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi East")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mihango',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi East")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Embakasi',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi East")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Upper Savanna',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi East")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Lower Savanna',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi East")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Umoja 1',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi West")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Umoja 2',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi West")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Morlem',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi West")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kariobangi South',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi West")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Komarock',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi Central")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Matopeni',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi Central")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kayole North',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi Central")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kayole South',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi Central")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kayole Central',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi Central")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kariobangi North',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi North")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Dandora 1',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi North")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Dandora 2',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi North")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Dandora 3',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi North")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Dandora 4',
                'sub_county_id' => SubCounty::query()->where("name","Embakasi North")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kasarani',
                'sub_county_id' => SubCounty::query()->where("name","Kasarani")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Claycity',
                'sub_county_id' => SubCounty::query()->where("name","Kasarani")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mwiki',
                'sub_county_id' => SubCounty::query()->where("name","Kasarani")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Njiru',
                'sub_county_id' => SubCounty::query()->where("name","Kasarani")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ruai',
                'sub_county_id' => SubCounty::query()->where("name","Kasarani")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Roysambu',
                'sub_county_id' => SubCounty::query()->where("name","Roysambu")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Zimmerman',
                'sub_county_id' => SubCounty::query()->where("name","Roysambu")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Githurai 44',
                'sub_county_id' => SubCounty::query()->where("name","Roysambu")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kahawa West',
                'sub_county_id' => SubCounty::query()->where("name","Roysambu")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kahawa Wendani',
                'sub_county_id' => SubCounty::query()->where("name","Roysambu")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kiwanja',
                'sub_county_id' => SubCounty::query()->where("name","Roysambu")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Babadogo',
                'sub_county_id' => SubCounty::query()->where("name","Ruaraka")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Luckysummer',
                'sub_county_id' => SubCounty::query()->where("name","Ruaraka")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Utalii',
                'sub_county_id' => SubCounty::query()->where("name","Ruaraka")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Korogocho',
                'sub_county_id' => SubCounty::query()->where("name","Ruaraka")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mathare North',
                'sub_county_id' => SubCounty::query()->where("name","Ruaraka")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kiamaiko',
                'sub_county_id' => SubCounty::query()->where("name","Ruaraka")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Huruma',
                'sub_county_id' => SubCounty::query()->where("name","Mathare")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ngei',
                'sub_county_id' => SubCounty::query()->where("name","Mathare")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Hospital',
                'sub_county_id' => SubCounty::query()->where("name","Mathare")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mabatini',
                'sub_county_id' => SubCounty::query()->where("name","Mathare")->firstOrFail()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        Ward::insert($wards);
    }
}
