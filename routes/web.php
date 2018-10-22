<?php

use App\Anunciante;

Auth::routes();

Route::get('/', 'HomeController@app')->name('index');


//Route::get('/upload', 'MediaController@index')->name('imgtemporario');


/*====================== ROTAS DOS USUARIOS ====================================*/

Route::get('/usuario/confirmar/{token}', 'Auth\RegisterController@verifyUser');

Route::get('/usuario/profile/home', 'UserController@index')->name('home');

Route::get('/usuario/profile/my-account', 'UserController@account')->name('account.show');

Route::get('/usuario/profile/show', 'UserController@show')->name('perfil.show');

Route::post('/usuario/profile/show', 'UserController@avatar')->name('avatar');

Route::get('/usuario/profile/anuncios/listar', 'UserController@listarAnucios')->name('anuncios.listar');

Route::get('/usuario/profile/show/update/{id}', 'UserController@getUpdate')->name('get.update');

Route::post('/usuario/profile/show/update/{id}', 'UserController@update')->name('updateUser');




/*======================ROTAS DAS BUSCAS DOS IMOVEIS ============================*/

Route::get('/busca/imoveis/{cidade}', 'BuscaController@getCidade')->name('buscaCidade');

Route::post('/buscar/imoveis/filtro', 'BuscaController@getImoveis')->name('buscaImoveis');

Route::get('/buscar/imoveis/filtro', 'BuscaController@searchImoveis')->name('searchImoveis');

Route::get('/{titulo?}/{id}/{meta}/{cidade}', 'BuscaController@singleImovel' )->name('imovel');


/*=====================ROTAS DOS CADASTROS=========================== */

Route::get('/perfil/anuncio', 'HomeController@anuncio')->name('anuncio');

Route::get('/anunciar', 'ImovelController@createStep1')->name('anunciar');
Route::post('/anunciar', 'ImovelController@postCreateStep1');

Route::get('/anunciar/anunciar-step2', 'ImovelController@createStep2');
Route::post('/anunciar/anunciar-step2', 'ImovelController@postCreateStep2');

Route::get('/anunciar/finish', 'ImovelController@createFinish');
Route::post('/anunciar/finish', 'ImovelController@store');



/*===================== ROTAS DAS IMAGENS ===========================*/

Route::post('/images-upload', 'MediaController@upload');



/*=====================ROTAS DOS ADMINISTRADORES===================== */

Route::prefix('admin')->middleware(['role', 'auth'])->group(function(){

	/*============ PAINEL DO ADMINISTRADOR=================== */
	Route::get('/', 'AdminController@index')->name('admin.dashboard');   

});

/*============ Rotas de Agendamentos ========================*/

Route::group(['middleware' => 'role'], function(){
    //tasks section
    Route::post('task/create', 'TaskController@store')->name('store');
    Route::get('task/data', 'TaskController@data')->name('data');
    Route::post('task/{task}/edit', 'TaskController@update')->name('update');
    Route::post('task/{task}/delete', 'TaskController@delete')->name('delete');

});


/*===================ROTAS DOS ANUNCIANTES================*/


Route::post('perfil/anuncio/{perfil}', 'Auth\AnuncianteRegisterController@create')->name('anunciante.store');

Route::get('anunciante/login', 'Auth\AnuncianteLoginController@index')->name('anunciante.login');
Route::post('anunciante/login', 'Auth\AnuncianteLoginController@login')->name('anunciante.login.submit');

Route::get('perfil/anuncio/{perfil}', 'AnunciantesController@cadastro')->name('anunciante.cadastro');
Route::get('anunciante', 'AnunciantesController@index')->name('anunciante.dashboard');