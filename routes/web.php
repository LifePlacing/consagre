<?php

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
Auth::routes();

Route::get('/', function () {
    return view('app.index');
});

Route::get('/usuario/confirmar/{token}', 'Auth\RegisterController@verifyUser');
Route::get('/home', 'HomeController@index')->name('home');


/*=====================ROTAS DOS ADMINISTRADORES===================== */

Route::prefix('sis/administracao/admin')->group(function() {

	/* ROTAS DO LOGIN ADMINISTRADOR */

    Route::get('/login', 'Auth\Admin\AdminLoginController@showLoginForm')
    			->name('admin.login');
    Route::get('/logout', 'Auth\Admin\AdminLoginController@logout')
    			->name('admin.logout');
    Route::post('/login', 'Auth\Admin\AdminLoginController@login')
    			->name('admin.login.submit');  

	/* ROTAS DO REGISTRO ADMINISTRADOR */

    Route::get('/register', 'Auth\Admin\AdminRegisterController@showRegistrationForm')
    		->name('admin.register'); 
    Route::post('/register', 'Auth\Admin\AdminRegisterController@register')
    		->name('admin.register.submit');

	/* ROTAS REDEFINIÇÃO DE SENHA ADMINISTRADOR */
    Route::get('/password/reset', 'Auth\Admin\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');

    Route::post('/password/reset', 'Auth\Admin\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

	/*=================== PAINEL DO ADMINISTRADOR============================= */
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

});