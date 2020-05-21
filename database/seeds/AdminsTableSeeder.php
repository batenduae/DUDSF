<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'      =>  'Md. Abdul Baten',
            'email'     =>  'batenduae@gmail.com',
            'password'  =>  bcrypt('dudsf@2020-baten416991'),
            'adminType' =>  'superAdmin',
        ]);
    }
}
