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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/empresa', function () {
    return view('site.contact');
});

Route::post('/register', function () {
    return '';
});


//Rota any permite qualquer tipo de verbo (get, post, put, etc)
Route::any('/any', function () {
    return 'Any';
});

//Rota match pode definir o tipo de verbo
Route::match(['post', 'get'], '/match', function () {
    return 'match';
});

//Rota com parâmetros obrigatórios
Route::get('/categorias/{flag}', function ($prm1) {
    return "Produtos da categoria: {$prm1}";
});

Route::get('/categorias/{flag}/posts', function ($flag) {
    return "Posts da categoria: {$flag}";
});

//Rota com parâmetros opcional
Route::get('/produtos/{idProduct?}', function ($idProduct = '') {
    return "Produto(s) {$idProduct}";
});

//Rota com redirecionamento de rotas
Route::redirect('/redirect1', '/redirect2');

// Route::get('redirect1', function(){
//     return redirect('/redirect2');
// });

Route::get('/redirect2', function () {
    return 'Redirect 02';
});

Route::view('/view', 'welcome');

//Rotas nomeadas
Route::get('/nome-url', function () {
    return 'Hey hey hey';
})->name('url.name');

Route::get('/redirect3', function () {
    return redirect()->route('url.name');
});

//Grupo de rotas
Route::get('/login', function () {
    return 'Login';
})->name('login');

/*
//Grupo de rotas para middleware
Route::middleware([])->group(function(){

    //Grupo de rotas para prefixos
    Route::prefix('admin')->group(function(){
        
        //Grupo de rotas para namespaces
        Route::namespace('Admin')->group(function(){

            //Grupo de rotas para prefixo em name
            Route::name('admin.')->group(function(){
                Route::get('/dashboard', 'TesteController@teste')->name('dashboard');
                
                Route::get('/financeiro', 'TesteController@teste')->name('financeiro');
                
                Route::get('/produtos', 'TesteController@teste')->name('produtos');
                
                Route::get('/', function(){
                    return redirect()->route('admin.dashboard');
                })->name('home');

            });
        });

    });

});
*/

//Forma mais enxuta de agrupamento de rotas
Route::group([
    'middleware' => ['auth'],
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'name' => 'admin.'
], function () {
    Route::get('/dashboard', 'TesteController@teste')->name('dashboard');

    Route::get('/financeiro', 'TesteController@teste')->name('financeiro');

    Route::get('/produtos', 'TesteController@teste')->name('produtos');

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    })->name('home');
});

/*
//Utilizando controller para a lógica da rota
Route::get('/products', 'ProductController@index')->name('products.index');

//Route para cadastrado de produto
Route::get('/products/create', 'ProductController@create')->name('products.create');

//Utilizando controller com parâmetros
Route::get('/products/{id}', 'ProductController@show')->name('products.show');

//Route para exibir form de edição de produto
Route::get('/products/{id}/edit', 'ProductController@edit')->name('products.edit');

//Route para registro no sistema - POST
Route::post('/products', 'ProductController@store')->name('products.store');

//Route para editar um registro - PUT
Route::put('/products/{id}', 'ProductController@update')->name('products.update');

//Route para deletar um registro - DELETE
Route::delete('/products/{id}', 'ProductController@destroy')->name('products.destroy');
*/

//Resource (Cria automaticamente as rotas de todos os métodos do controller)
//Middleware (Utilizando middlewares com resources e controllers)
Route::resource('products', 'ProductController'); //->middleware('auth');
