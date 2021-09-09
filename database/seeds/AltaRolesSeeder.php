<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class AltaRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Marshall']);
        Role::create(['name' => 'Carrito']);
        Role::create(['name' => 'Starter']);

        // php artisan db:seed --class=AltaRolesSeeder
        // php artisan make:migration create_inn_catalog_caddy_table


    }
}
