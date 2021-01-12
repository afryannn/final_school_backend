REGISTER
</br>
nama,email,username,password
Route::post('/seller_register','MainController@seller_register');
Route::post('/visitor_register','MainController@visitor_register');
</br>
LOGIN
</br>
username,password
</br>
STORE
</br>
img_profil,img_banner,nama_toko,user_id,deskripsi,alamat;
Route::post('/create_store','MainController@createstore');
</br>
CREATE PRODUK
</br>
user_id,nama_produk,kategori
Route::post('/create_produk','MainController@product');
</br>
COMPLETE PRODUK
</br>
key_product,deskripsi,harga,stok,img1,img2,img3,img4,img5 
</br>
UPDATE PRODUK
</br>
key_produk,nama_produk,deskripsi,harga,kategori,stok,img1,img2,img3,img4,img5