<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageGeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('page_general_settings')->insert([[
            'id' => '1',
            'name' => 'page cover photo',
            'value' => 'coverphotoplaceholder.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'id' => '2',
            'name' => 'page profile photo',
            'value' => 'placeholder.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        ]
    );

    }
}
