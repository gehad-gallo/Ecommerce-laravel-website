<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void

     */

    //to create admin via seeders
    
    public function run()
    {
        Admin::create([
            'name'  => 'Gehad',
            'email'  => 'gggg@gmail.com',
            'password'  => bcrypt('369369369'),

         ]);
    }
}
