<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupAdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            //
            DB::table('group_admin_roles')->insert([[
                'id' => '1',
                'roles_permission' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '2',
                'roles_permission' => 'Moderator',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                
            ],
           
            ]
        );
    
    }
}
