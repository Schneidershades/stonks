<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::Create([
        	'first_name'                   => 'frank',
            'last_name'                  	=> 'ocean',
            'username'          			=> 'ocean',
            'email'                  		=> 'frank@ocean.com',
            'password'                  	=> bcrypt('password'),
        ]);

        User::Create([
            'first_name'                   => 'Aaron',
            'last_name'                     => 'Phillip',
            'username'           			=> 'aron123',
            'email'                         => 'a.phillip@gmail.com',
            'password'                      => bcrypt('password'),
        ]);
    }
}
