<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CapabilityFeature;

class CapabilityFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CapabilityFeature::create( [
            'id'=>1,
            'name'=>'category',
        ]);

        CapabilityFeature::create( [
            'id'=>2,
            'name'=>'Tags',
        ]);
        CapabilityFeature::create( [
            'id'=>3,
            'name'=>'Lists',
        ]);
    }
}
