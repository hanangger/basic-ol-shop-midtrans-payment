<?php
use Illuminate\Http\Request;

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

Route::get('/catalog/list/', 'Catalog@index');

Route::get('/catalog/create', function(){
	return view('commerce/create');
});

Route::post('/catalog/payment/customer', 'Catalog@customerDetail');

Route::post('/catalog/payment/confirm', 'Catalog@confirm');

Route::post('/catalog/payment/confirmPayment', 'Catalog@confirm');

Route::post('/catalog/payment/checkoutvtweb', 'Catalog@checkoutvtweb'); //checkout

Route::post('/catalog/addCart', 'Catalog@addCart');

Route::post('/catalog/doCreate', 'Catalog@create');

Route::get('/catalog/cart', 'Catalog@listCart');

Route::get('images/{filename}', function ($filename)
{
    $path = storage_path() . '/uploads/' . $filename;

    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
/*
Route::get('/homepage', function(){
	return view('test/homepage');
});

Route::get('/items', function(){
	$items = ['xiaomi redmi5', 'google pixel'];
	return view('test/index', compact('items'));
});*/