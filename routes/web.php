<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',  'Auth\LoginController@showLoginForm')->name('login');
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/home2', 'HomeController@menu2')->name('home2');
Route::get('/home', 'HomeController@menu2')->name('home2');

//Route::resource('Usuarios','UserController');
//Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::get('menu','MenuController@index')->name('menu');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    // rutas del menú
        Route::get('menu','MenuController@index')->name('menu');
        Route::get('menu/create','MenuController@create')->name('create_menu');
        Route::post('menu', 'MenuController@save')->name('save_menu');
        Route::post('menu/save-order', 'MenuController@saveOrder')->name('save_order');
        Route::get('menu/{id}/edit','MenuController@edit')->name('edit_menu');
        Route::put('menu/{id}','MenuController@update')->name('update_menu');
        Route::get('menu/{id}/delete','MenuController@destroy')->name('delete_menu');

    // rutas para menú-rol
        Route::get('roleMenu','RoleMenuController@index')->name('role_menu');
        Route::post('roleMenu','RoleMenuController@save')->name('save_role_menu');

    // rutas para usuarios

        Route::get('user','UserController@index')->name('menu');
        Route::get('user/create','UserController@create')->name('create_user');
        Route::post('user', 'UserController@save')->name('save_user');
        Route::get('user/{id}/edit','UserController@edit')->name('edit_user');
        Route::put('user/{id}','UserController@update')->name('update_user');
        Route::post('updateStatus','UserController@updateStatus')->name('update_status_user');

});

        Route::get('registro','RegisterController@index')->name('registro');
        Route::post('registro','RegisterController@alta')->name('registro.alta');

        Route::get('recepcion','RecepcionController@index')->name('recepcion');
        Route::post('recepcion','RecepcionController@baja')->name('recepcion.baja');

        //Route::get('recepcion','RecepcionController@index')->name('recepcion.recepcion_dispositivos');

                        //* Lista de caddies *\\
        Route::get('caddies','CaddiesController@index')->name('cadddies');
        Route::get('new','CaddiesController@new')->name('new_caddy');
        Route::post('registercad','CaddiesController@registerCad')->name('registerCad');
        Route::post('updateCaddies','CaddiesController@updateCaddies')->name('update_status_caddies');
        Route::get('editcad/{id}','CaddiesController@edit')->name('editCad');
        Route::post('savecad','CaddiesController@save')->name('saveCad');
        Route::post('delcad','CaddiesController@delCad')->name('delCad');


        Route::get('carrito','CarritoController@index')->name('carrito');
        Route::get('solicitudesMapa1','CarritoController@solicitudes')->name('solicitudesMapa1');
        Route::get('solicitudesMapa2','CarritoController@solicitudesMapa2')->name('solicitudesMapa2');
        Route::get('mapa','CarritoController@mapa')->name('mapa');

        //Route::get('estatus','MarshallEstatusController@dispositivo')->name('estatus');

        Route::get('map','MarshallMapa1Controller@viewMap')->name('map');
        Route::get('rutas','MarshallMapa1Controller@Rutas')->name('rutas');
        Route::get('rutas_track','MarshallMapa1Controller@track')->name('rutas_track');
        Route::get('mapa_1','MarshallMapa1Controller@mapa1')->name('mapa_1');
        Route::get('mapa_2','MarshallMapa1Controller@mapa2')->name('mapa_2');
        Route::get('estatus','MarshallEstatusController@index')->name('estatus');

        Route::get('getInterval','MarshallMapa1Controller@getInterval')->name('getInterval');
        Route::get('getUbicacionesMapaCarCombine','CarritoController@getUbicacionesMapaCarCombine')->name('getUbicacionesMapaCarCombine');
        Route::get('enviaPedido/','CarritoController@enviaPedido')->name('enviaPedido');
        Route::get('peticiones/','CarritoController@peticiones')->name('peticiones');


