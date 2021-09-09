<?php

use Illuminate\Database\Seeder;

use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // usuario con rol editor
        // $editor = User::create([
        //     'name'      => 'Editor',
        //     'email'     => 'editor@gmail.com',
        //     'password'  => 'qwerty1234'
        // ]);
        // $editor->assignRole('Editor');

        // // usuario con rol moderador
        // $moderador = User::create([
        //     'name'      => 'Moderador',
        //     'email'     => 'moderador@gmail.com',
        //     'password'  => 'qwerty1234'
        // ]);
        // $moderador->assignRole('Moderador');

        // usuario con rol admin
        $admin = User::create([
            'name'      => 'Admin',
            'email'     => 'admin@gmail.com',
            'status'    => 1,
            'password'  => 'qwerty1234'
        ]);
        $admin->assignRole('Admin');

        // usuario con rol admin
        $admin2 = User::create([
            'name'      => 'Arturo',
            'email'     => 'arthurk009@gmail.com',
            'status'    => 1,
            'password'  => 'qwerty1234'
        ]);
        $admin2->assignRole('Admin');


    }
}
