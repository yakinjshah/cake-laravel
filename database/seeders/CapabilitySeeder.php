<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Capability;

class CapabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Capability::create( [
            'id'=>1,
            'feature_id'=>1,
            'capability'=>'Add'
        ]);

        Capability::create( [
            'id'=>2,
            'feature_id'=>1,
            'capability'=>'View'
        ]);

        Capability::create( [
            'id'=>3,
            'feature_id'=>1,
            'capability'=>'Update'
        ]);

        Capability::create( [
            'id'=>4,
            'feature_id'=>1,
            'capability'=>'Delete'
        ]);

        Capability::create( [
            'id'=>5,
            'feature_id'=>2,
            'capability'=>'Add'
        ]);

        Capability::create( [
            'id'=>6,
            'feature_id'=>2,
            'capability'=>'View'
        ]);

        Capability::create( [
            'id'=>7,
            'feature_id'=>2,
            'capability'=>'Update'
        ]);

        Capability::create( [
            'id'=>8,
            'feature_id'=>2,
            'capability'=>'Delete'
        ]);

        Capability::create( [
            'id'=>9,
            'feature_id'=>3,
            'capability'=>'Add'
        ]);

        Capability::create( [
            'id'=>10,
            'feature_id'=>3,
            'capability'=>'View'
        ]);

        Capability::create( [
            'id'=>11,
            'feature_id'=>3,
            'capability'=>'Update'
        ]);

        Capability::create( [
            'id'=>12,
            'feature_id'=>3,
            'capability'=>'Delete'
        ]);



    }
}
