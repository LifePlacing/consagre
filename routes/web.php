<?php

Auth::routes();

/*Route::get('/', function () {
    return view('app.index');
});*/


Route::get('/', 'HomeController@app')->name('index');

Route::get('/usuario/confirmar/{token}', 'Auth\RegisterController@verifyUser');
Route::get('/usuario/profile/home', 'HomeController@index')->name('home');


/*=====================ROTAS DOS CADASTROS=========================== */

Route::get('/anunciar', 'ImovelController@createStep1');
Route::post('/anunciar', 'ImovelController@postCreateStep1');

Route::get('/anunciar/anunciar-step2', 'ImovelController@createStep2');
Route::post('/anunciar/anunciar-step2', 'ImovelController@postCreateStep2');

Route::get('/anunciar/finish', 'ImovelController@createFinish');
Route::post('/anunciar/finish', 'ImovelController@store');

Route::get('/planos/anuncio', 'ImovelController@index');

/*===================== ROTAS DAS IMAGENS ===========================*/

Route::post('/images-upload', 'MediaController@upload');



/*=====================ROTAS DOS ADMINISTRADORES===================== */

Route::prefix('sis/admin')->middleware(['role', 'auth'])->group(function(){

	/*=================== PAINEL DO ADMINISTRADOR============================= */
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

});