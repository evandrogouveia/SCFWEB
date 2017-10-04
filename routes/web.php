<?php

Route::match(['post', 'get'], '/', 
    ['as' =>'login', 'uses' => 'LoginController@index']);

Route::match(['post', 'get'], '/login', 
    ['as' =>'login2', 'uses' => 'LoginController@index']);

Route::match(['post', 'get'], '/novo', 
    ['as' =>'novo', 'uses' => 'LoginController@novo']);

Route::match(['post', 'get'], '/sair', 
    ['as' =>'sair', 'uses' => 'LoginController@sair']);

Route::match(['post', 'get'], '/esqueci', 
    ['as' =>'esqueci', 'uses' => 'LoginController@esqueci']);

Route::group(['prefix' => 'admin/', 'middleware' => ['auth',
    'can:publica,App\Usuario']], function(){    

    Route::match(['post', 'get'], '/', 
        ['as' =>'home', 'uses' => 'FuncionarioController@index']);

    Route::match(['post', 'get'], '/cadastrar.html', 
        ['as' =>'funcionario_cadastrar', 'uses' => 'FuncionarioController@cadastrar'])
            ->middleware('can:adm,App\Usuario');

    Route::match(['post', 'get'], '/buscar.html', 
        ['as' =>'funcionario_buscar', 'uses' => 'FuncionarioController@buscar']);

    Route::match(['post', 'get'], '/{id}/detalhes.html', 
        ['as' =>'funcionario_detalhes', 'uses' => 'FuncionarioController@detalhes']);

    Route::match(['post', 'get'], '/{id}/excluir.html', 
        ['as' =>'funcionario_excluir', 'uses' => 'FuncionarioController@excluir']);
    
    Route::group(['prefix' =>'cargo/'],function(){
          Route::match(['post', 'get'], '/novo.htm', 
                ['as' =>'cargo_novo', 'uses' => 'CargoController@novo']);
    });
});
