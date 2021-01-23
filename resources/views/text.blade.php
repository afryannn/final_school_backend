<center>
<b>REGISTER</b>
</br>
/seller_register || 
/visitor_register
<br>
nama,email,username,password
</br>
</br>
<b>LOGIN</b>
</br>
/login,
<br>
username,password
</br>
</br>
<b>CREATE STORE</b>
</br>
/create_store
<br>
img_profil,img_banner,nama_toko,user_id,deskripsi,alamat;
</br>
</br>
<b>CREATE PRODUK</b>
</br>
/create_produk
<br>
user_id,nama_produk,kategori
</br>
</br>
<b>COMPLETE PRODUK</b>
</br>
/complete_produk<br>
key_product,deskripsi,harga,stok,img1,img2,img3,img4,img5 
</br>
</br>
<b>UPDATE PRODUK</b>
</br>
/update-produk<br>
key_produk,nama_produk,deskripsi,harga,kategori,stok,img1,img2,img3,img4,img5
</br>
</br>

<b>SEARCH PRODUK</b>
<br>
/search-produk<br>
kata_kunci
</br>
</br>

<b>ALL STORE PRODUK</b>
<br>
/all-store-produk
<br>
user_id
</br>
</br>

<b>DELETE PRODUK</b>
<br>
/delete-produk<br>
key_product
</br>
</br>

<b>BUY</b>
<br>
/buy<br>
visitor_id,store_id,store_name,product_name,product_price,product_key,img1,address_seller
</br>
</br>

<b>LIST TRANSAKSI</b>
<br>
/seller_transaksi || /visitor_transaksi<br>
id
</br>
</br>
</center>