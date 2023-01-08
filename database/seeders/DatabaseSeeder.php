<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Email;
use Illuminate\Support\Facades\Hash;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        
        User::create([
            'name' =>'Administrator',
            'email' =>'admin@admin.com',
            'password'=> Hash::make('password'),
            'address' =>'fakeaddress',
            'clinic'=>0,
            'contactno'=>'00000',
            'user_type' =>'superadmin',
            'fl'=>0,
            'otp'=>0,
            'designation'=>'admin',
             ]);

        Email::create([
            'email'=>'noreplymedicalclinic@gmail.com',
            'name' =>'Medical Clinic',
            'token' => '1//0e8Oo6ZeAN33qCgYIARAAGA4SNwF-L9IrrriLXUCpHHBtuRXoQiJputY9_EzfSdsB5xNRHPt8BqUnU3zxxJzi1Ly4nKf20Hr3JKQ',
        ]);
    }
}
