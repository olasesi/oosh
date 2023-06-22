<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagePrivacyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('page_privacy_types')->insert([[
            'id' => '1',
            'page_privacy' => 'Public',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'id' => '2',
            'page_privacy' => 'Private',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            
        ],
       
       
        ]
    );
    }
}
