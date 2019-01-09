<?php

use Illuminate\Support\Facades\Auth;
use App\Xml;


Auth::routes();

Route::get('/', 'HomeController@app')->name('index');



/*====================== ROTAS DOS USUARIOS ====================================*/

Route::get('/usuario/confirmar/{token}', 'Auth\RegisterController@verifyUser');

Route::get('/usuario/profile/home', 'UserController@index')->name('home');

Route::get('/usuario/profile/my-account', 'UserController@account')->name('account.show');

Route::get('/usuario/profile/show', 'UserController@show')->name('perfil.show');

Route::post('/usuario/profile/show', 'UserController@avatar')->name('avatar');

Route::any('/usuario/profile/anuncios/ativos', 'UserController@listarAtivos')->name('anuncios.listar');

Route::get('/usuario/profile/show/update/{id}', 'UserController@getUpdate')->name('get.update');

Route::post('/usuario/profile/show/update/{id}', 'UserController@update')->name('updateUser');

/*=================== ROTAS DOS IMOVEIS=========================*/

Route::post('/anunciante/imovel/apagar', 'ImovelanunciantesController@delete')->name('apagarImovel');


/*======================ROTAS DAS BUSCAS DOS IMOVEIS ============================*/

Route::get('/busca/imoveis/{cidade}', 'BuscaController@getCidade')->name('buscaCidade');

Route::get('/busca/todososimoveis/{meta}', 'BuscaController@getMeta')->name('buscaTodos');

Route::any('/buscar/imoveis/filtro-search', 'BuscaController@getImoveis')->name('buscaImoveis');

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



/*================ ROTAS DOS PLANOS =====================*/

Route::get('anunciante/planos/{token}', 'PlanosController@planos')->name('anunciante.planos');

Route::post('/planos/contratar/payment/boleto', 'GerenciaNetController@payment')->name('contratar.planos');

Route::post('/planos/contratar/payment/cartao/', 'GerenciaNetController@credito')->name('contratar.planos.cartao');

Route::get('/planos/contratar/payment/cartao/{anunciante_id}/{plano_id}', 'GerenciaNetController@cartao')->name('contratar.planos.cartao');


/*===================ROTAS DOS ANUNCIANTES================*/


Route::post('perfil/anuncio/{perfil}', 'Auth\AnuncianteRegisterController@create')->name('anunciante.store');

Route::get('anunciante/login', 'Auth\AnuncianteLoginController@index')
->name('anunciante.login');
Route::post('anunciante/login', 'Auth\AnuncianteLoginController@login')
->name('anunciante.login.submit');
Route::get('perfil/anuncio/{perfil}', 'AnunciantesController@cadastro')
->name('anunciante.cadastro');

Route::get('/anunciante/password/cadastrar/perfil/{token}', 'Auth\AnuncianteRegisterController@verifyUser')
->name('anunciante.ativar');

Route::post('/anunciante/password/cadastrar/perfil/', 'Auth\AnuncianteRegisterController@update')
->name('anunciante.ativar.update');


/*=============== ROTAS DOS ANUNCIANTES PAINEL DASHBOARD===================*/

Route::get('anunciante', 'AnunciantesController@index')->name('anunciante.dashboard');

Route::get('anunciante/plano', 'AnunciantesController@infoPlano')->name('anunciante.plano');

Route::get('anunciante/anuncios', 'ImovelAnunciantesController@listarAnuncios')->name('anunciantes.listar.anuncios');

Route::get('anunciante/profile', 'AnunciantesController@profile')->name('anunciante.profile');

Route::post('anunciante/profile', 'AnunciantesController@profileUpdate')->name('anunciante.profile.update');

Route::post('anunciante/profile/avatar', 'AnunciantesController@profileAvatar')->name('anunciante.profile.avatar');

Route::get('anunciante/integracoes', 'ImovelAnunciantesController@cadastraIntegracao')->name('anunciante.integrar.xml');

Route::post('anunciante/integracoes', 'ImovelAnunciantesController@parseXml')->name('anunciante.parse.xml');

Route::post('anunciante/integracoes/delete', 'ImovelAnunciantesController@deleteParseXml')->name('anunciante.parseXml.delete');

Route::post('anunciante/integracoes/update', 'ImovelAnunciantesController@updateParseXml')->name('anunciante.parseXml.update');

Route::post('anunciante/integracoes/xml', 'ImovelAnunciantesController@leitorXml')->name('anunciante.xml.leitura');

Route::post('anunciante/integracoes/xml/detalhes', 'XmlController@singleXml')->name('single.xml.detalhes');

Route::get('anunciante/integracoes/single/detalhes/anuncio', 'XmlController@singleDetalhesXml')->name('xml.detalhesdoimovel');

Route::get('anunciante/integracoes/xml', 'ImovelAnunciantesController@leitorGetXml')->name('anunciante.xml.get');

/*================Cadastros dos anunciantes============================*/

Route::get('anunciante/novoanuncio', 'ImovelAnunciantesController@adicionarStep1')->name('adicionaImovelAnunciante');
Route::post('anunciante/novoanuncio', 'ImovelAnunciantesController@postCreateStep1')->name('postImovelAdd');

Route::get('anunciante/novoanuncio/imagens', 'ImovelAnunciantesController@adicionarStep2')->name('adicionaImovelAnuncianteSegundoPasso');
Route::post('anunciante/novoanuncio/imagens', 'ImovelAnunciantesController@postCreateStep2')->name('postImovelAddSegundoPasso');

