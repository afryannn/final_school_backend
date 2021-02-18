<?php

use Illuminate\Http\Request;
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'v1'  , 'middleware' => 'cors'], function(){
Route::post('/login','MainController@login');
Route::post('/seller_register','MainController@seller_register');
Route::post('/register','MainController@register');
Route::post('/create_store','MainController@createstore');
Route::post('/create_produk','MainController@product');
Route::post('/check_store','MainController@cekstore');
Route::post('/complete_produk','MainController@complete_produk');
Route::post('/update-produk','MainController@product_update');
Route::post('/search-produk','MainController@search_function');
Route::post('/all-store-produk','MainController@all_store_produk');
Route::post('/delete-produk','MainController@delete_produk');
Route::post('/test','MainController@test_img');
Route::post('/uImg','MainController@getImg'); 
Route::get('/list-produk','MainController@list_produk');
Route::get('/list-produk2','MainController@list_produk2');
Route::post('/buy','MainController@transaction');
Route::get('/Detail/{product_key}','MainController@DetailProduk');
Route::post('/seller_transaksi','MainController@transactionSeller');
Route::post('/visitor_transaksi', 'MainController@transactionVisitor');
Route::post('/count-product', 'MainController@countproduct');
Route::post('/user-confirm', 'MainController@confirm');
Route::get('/categor', 'MainController@category');
Route::get('/new-item', 'MainController@NewItem');
Route::get('/getExcel/{id}', 'MainController@Excel');
Route::get('/getPdf/{id}', 'MainController@getPdf');
Route::get('/cd', 'MainController@cd');
Route::get('/src/{imagename}', 'MainController@srcImage');
Route::get('/mediastore/{imagename}', 'MainController@mediastore');

});




// $result['id'] = $produk->id;
// $result['produk_key'] = $produk->product_key;
// $result['store_id'] = $produk->store_id;
// $result['produk_name'] = $produk->product_name;
// $result['produk_price'] = $produk->product_price;
// $result['kategori'] = $produk->category;
// $result['deskripsi'] = $produk->description;
// $result['stok'] = $produk->stock;
