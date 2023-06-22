<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[

            'active'=>'1',
            'firstname'=>'ahmed',
            'lastname'=>'olusesi',
            'email'=>'ola.sesi@yahoo.com',
            'phone'=>null,
            'date_of_birth'=>'2023-06-23',
            'gender'=>'Male',
            'password'=>Hash::make('123456'),
            'remember_token'=>null,
            'profile_picture'=>'storage/profile/placeholder.png',
            'username'=>null,
            'location'=>null,
            'country'=>null,
            'website'=>null,
            'bio'=>null,
            'peerID'=>null,
            'cover_photo'=>null,
            'profile_verify'=>0,
            'page_verify'=>0,
            'voicepeerID'=>null,
            'verification_code'=>null,
            'forget_password'=>null,
            'occupation'=>null,
            'zipcode'=>null,
            'state'=>null,
            'city'=>null,
            'address'=>null,
            'hobby'=>null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            
            'active'=>'1',
            'firstname'=>'qudus',
            'lastname'=>'opeyemi',
            'email'=>'qudus@yahoo.com',
            'phone'=>null,
            'date_of_birth'=>'2023-06-23',
            'gender'=>'Male',
            'password'=>Hash::make('123456'),
            'remember_token'=>null,
            'profile_picture'=>'storage/profile/placeholder.png',
            'username'=>null,
            'location'=>null,
            'country'=>null,
            'website'=>null,
            'bio'=>null,
            'peerID'=>null,
            'cover_photo'=>null,
            'profile_verify'=>0,
            'page_verify'=>0,
            'voicepeerID'=>null,
            'verification_code'=>null,
            'forget_password'=>null,
            'occupation'=>null,
            'zipcode'=>null,
            'state'=>null,
            'city'=>null,
            'address'=>null,
            'hobby'=>null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        ]
    );

    }
}

