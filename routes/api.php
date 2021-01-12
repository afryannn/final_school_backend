<?php

use Illuminate\Http\Request;
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login','MainController@login');
Route::post('/seller_register','MainController@seller_register');
Route::post('/buyer_register','MainController@visitor_register');
Route::post('/create_store','MainController@createstore');
Route::post('/create_produk','MainController@product');
Route::post('/complete_produk','MainController@complete_produk');
Route::post('/update-produk','MainController@product_update');
Route::post('/search-produk','MainController@search_function');
Route::post('/all-store-produk','MainController@all_store_produk');
Route::post('/delete-produk','MainController@delete_produk');
Route::post('/test','MainController@test_img');



// $result['id'] = $produk->id;
// $result['produk_key'] = $produk->product_key;
// $result['store_id'] = $produk->store_id;
// $result['produk_name'] = $produk->product_name;
// $result['produk_price'] = $produk->product_price;
// $result['kategori'] = $produk->category;
// $result['deskripsi'] = $produk->description;
// $result['stok'] = $produk->stock;