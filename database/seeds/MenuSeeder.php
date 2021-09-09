<?php

use App\Models\RoleMenu;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::where('name','Admin')->first();
        $menu = Menu::create([
            'menu_id'   =>  '0',
            'nombre'    =>  'Menú',
            'url'       =>  '#',
            'order'     =>  '1',
            'icono'     =>  'list',
        ]);

        RoleMenu::create([
            'role_id'   =>  $admin->id,
            'menu_id'   =>  $menu->id
        ]);

        $menu2 = Menu::create([
            'menu_id'   =>  $menu->id,
            'nombre'    =>  'Listado menú',
            'url'       =>  'admin/menu',
            'order'     =>  '2',
            'icono'     =>  'list',
        ]);

        RoleMenu::create([
            'role_id'   =>  $admin->id,
            'menu_id'   =>  $menu2->id
        ]);

        $menu3 = Menu::create([
            'menu_id'   =>  $menu->id,
            'nombre'    =>  'Menú roles',
            'url'       =>  'admin/roleMenu',
            'order'     =>  '3',
            'icono'     =>  'chalkboard-teacher',
        ]);

        RoleMenu::create([
            'role_id'   =>  $admin->id,
            'menu_id'   =>  $menu3->id
        ]);

        $menu4 = Menu::create([
            'menu_id'   =>  $menu->id,
            'nombre'    =>  'Crear Menú',
            'url'       =>  'admin/menu/create',
            'order'     =>  '1',
            'icono'     =>  'file',
        ]);

        RoleMenu::create([
            'role_id'   =>  $admin->id,
            'menu_id'   =>  $menu4->id
        ]);

        $menu5 = Menu::create([
            'menu_id'   =>  '0',
            'nombre'    =>  'Usuarios',
            'url'       =>  '#',
            'order'     =>  '2',
            'icono'     =>  'users',
        ]);

        RoleMenu::create([
            'role_id'   =>  $admin->id,
            'menu_id'   =>  $menu5->id
        ]);

        $menu6 = Menu::create([
            'menu_id'   =>  $menu5->id,
            'nombre'    =>  'Listado de usuarios',
            'url'       =>  'admin/user',
            'order'     =>  '1',
            'icono'     =>  'list',
        ]);

        RoleMenu::create([
            'role_id'   =>  $admin->id,
            'menu_id'   =>  $menu6->id
        ]);




    }
}
