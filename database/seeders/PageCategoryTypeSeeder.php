<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageCategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('page_category_types')->insert([[
            'id' => '1',
            'page_category' => 'Technology',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'id' => '2',
            'page_category' => 'Fashion',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            
        ],
        [
            'id' => '3',
            'page_category' => 'Sport',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            
        ],
       
        ]
    );

}
    }

