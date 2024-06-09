<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsrPensionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        
        DB::table('usrpensiones')->insert([
            'usr_usuario'=>'SuperAdmin ',
            'email'=>'spadmin@vn.com',
            'password'=>bcrypt('171402'),
            'created_at'=>date('Y-m-d')             
       ]); 
    }
}
