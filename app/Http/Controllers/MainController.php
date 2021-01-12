<?php

namespace App\Http\Controllers;

use App\ImageModel as imageproduk;
use App\ProductModel as product;
use App\StoreModel as store;
use App\UserModel as user;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Session;

class MainController extends Controller
{
    public $id;
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if (!isset($username)) {
            $arr = array("message" => "maaf,username tidak boleh kosong!");
            return response()->json($arr);
        }
        if (!isset($password)) {
            $arr = array("message" => "maaf,password tidak boleh kosong!");
            return response()->json($arr);
        }
        $account = DB::table('users')->where('username', $username)->first();
        if (!isset($account)) {
            $arr = array("status" => 204, "message" => "username tidak ditemukan!");
            return response()->json($arr);
        }
        $getpassword = $account->password;
        if ($getpassword == $password) {
            if ($account->role_user == 'SELLER') {
                $this->id = session()->put('id', $account->id);
                $getdata = DB::table('users')->where('id', $account->id)->first();
                $arr = array("status" => 200, "message" => "SUCCES", "data" => $getdata);
                return json_encode($arr);
            }
            if ($account->role_user == 'VISITOR') {
                $getdata = DB::table('users')->where('id', $account->id)->first();
                $arr = array("status" => 200, "message" => "SUCCES", "data" => $getdata);
                return json_encode($arr);
            }
        } else {
            $arr = array("status" => 204, "message" => "password salah!");
            return response()->json($arr);
        }
    }

    public function seller_register(Request $request)
    {
        $name = $request->nama;
        $email = $request->email;
        $username = $request->username;
        $password = $request->password;
        if (!isset($name)) {
            $arr = array("message" => "maaf,nama tidak boleh kosong!");
            return response()->json($arr);
        }
        if (!isset($email)) {
            $arr = array("message" => "maaf,email tidak boleh kosong!");
            return response()->json($arr);
        }
        if (!isset($username)) {
            $arr = array("message" => "maaf,username tidak boleh kosong!");
            return response()->json($arr);
        }
        if (!isset($password)) {
            $arr = array("message" => "maaf,password tidak boleh kosong!");
            return response()->json($arr);
        }
        if (isset($is_username)) {
            $arr = array("message" => "username sudah terpakai!");
            return $arr;
        }
        $insert = user::insert([
            'name' => $name,
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'role_user' => 'SELLER',
        ]);
        if (!isset($insert)) {
            $arr = array(
                "status" => 403,
                "message" => "GAGAL MENDAFTAR",
            );
            return response()->json($arr);
        }
        $arr = array(
            "status" => 200,
            "message" => "SUKSES MENDAFTAR",
        );
        return response()->json($arr);
    }

    public function visitor_register(Request $request)
    {
        $name = $request->nama;
        $email = $request->email;
        $username = $request->username;
        $password = $request->password;
        if (!isset($name)) {
            $arr = array("message" => "maaf,nama tidak boleh kosong!");
            return response()->json($arr);
        }
        if (!isset($email)) {
            $arr = array("message" => "maaf,email tidak boleh kosong!");
            return response()->json($arr);
        }
        if (!isset($username)) {
            $arr = array("message" => "maaf,username tidak boleh kosong!");
            return response()->json($arr);
        }
        if (!isset($password)) {
            $arr = array("message" => "maaf,password tidak boleh kosong!");
            return response()->json($arr);
        }
        $is_username = user::where('username', $username)->first();
        if (isset($is_username)) {$arr = array("message" => "username sudah terpakai!");
            return $arr;
        }
        $insert = user::insert([
            'name' => $name,
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'role_user' => 'VISITOR',
        ]);
        if (!isset($insert)) {
            $arr = array("status" => 403, "message" => "data anda gagal didaftarkan!");
            return response()->json($arr);
        }
        $arr = array("status" => 200, "message" => "Berhasil Menambahkan data!");
        return response()->json($arr, 200);
    }
    public function complete_produk(Request $request)
    {
        $key_product = $request->key_product;
        $description = $request->deskripsi;
        $product_price = $request->harga;
        $stock = $request->stok;
        $name_img_2 = $name_img_3 =
        $name_img_4 = $name_img_5 = "Default";
        $Path = storage_path('/product_images');
        $get_id_produk = DB::table('produk')->where('product_key', $key_product)->first();
        if (!isset($get_id_produk)) {
            $arr = array("status" => 403, "message" => "KESALAHAN SERVER TIDAK DI KETAHUI");
            return json_encode($arr);
        }
        $val_id_produk = $get_id_produk->id;
        $img_name = $key_product;
        if (!isset($val_id_produk)) {
            $arr = array("status" => 403, "message" => "KESALAHAN SERVER TIDAK DI KETAHUI");
            return json_encode($arr);
        }

        try {
            if ($request->hasFile('img1')) {
                $image = $request->file('img1');
                $name_img_1 = $img_name . str_random(9) . '.' . $image->getClientOriginalExtension();
                $image->move($Path, $name_img_1);
            }
            if ($request->hasFile('img2')) {
                $image = $request->file('img2');
                $name_img_2 = $img_name . str_random(9) . '.' . $image->getClientOriginalExtension();
                $image->move($Path, $name_img_2);
            }
            if ($request->hasFile('img3')) {
                $image = $request->file('img3');
                $name_img_3 = $img_name . str_random(9) . '.' . $image->getClientOriginalExtension();
                $image->move($Path, $name_img_3);
            }
            if ($request->hasFile('img4')) {
                $image = $request->file('img4');
                $name_img_4 = $img_name . str_random(9) . '.' . $image->getClientOriginalExtension();
                if (isset($name_img_4)) {
                    $name_img_4 = "Null";
                }
                $image->move($Path, $name_img_4);
            }
            if ($request->hasFile('img5')) {
                $image = $request->file('img5');
                $name_img_5 = $img_name . str_random(9) . '.' . $image->getClientOriginalExtension();
                $image->move($Path, $name_img_5);
            }
        } catch (Exception $exc) {
            return $e->errorMessage();
        }
        if (!isset($name_img_1)) {
            $arr = array("status" => 204, "message" => "SETIDAKNYA ADA 1 GAMBAR");
            return response()->json($arr);
        }
        $check_product_key = DB::table('produk_image')->where('product_key', $key_product)->first();
        if (isset($check_product_key)) {
            if (!isset($update_img)) {
                $arr = array("status" => 403, "message" => "PRODUK SUDAH LENGKAP", "redirect" => "update-produk");
                return json_encode($arr);
            }
        } else {
            $image = imageproduk::insert([
                'product_key' => $key_product,
                'img1' => $name_img_1,
                'img2' => $name_img_2,
                'img3' => $name_img_3,
                'img4' => $name_img_4,
                'img5' => $name_img_5,
            ]);
        }
        $update = DB::table('produk')->where('product_key', $key_product)->update([
            'product_price' => $product_price,
            'description' => $description,
            'stock' => $stock,
        ]);
        if (!isset($update)) {
            $arr = array("status" => 403, "message" => "KESALAHAN SERVER TIDAK DI KETAHUI");
            return json_encode($arr);
        }
        $arr = array("status" => 200, "message" => "BERHASIL MELENGKAPI PRODUK");
        return response()->json($arr);
    }
    public function product(Request $request)
    {
        $user_id = $request->user_id;
        $name_product = $request->nama_produk;
        $category = $request->kategori;
        $key_product = $user_id . str_random(8);

        try {
            $table_store = DB::table('store')->where('user_id', $user_id)->first();
            $store_id = $table_store->id;
            if (!isset($table_store)) {
                $arr = array("status" => 403, "message" => "USER ID NOT FOUND");
                return response()->json($arr);
            }
            $insert = product::insert([
                'store_id' => $store_id,
                'product_name' => $name_product,
                'product_price' => 200000,
                'product_key' => $key_product,
                'category' => $category,
                'description' => "kosong",
                'stock' => 0,
            ]);
            $arr = array("status" => 200, "key_product" => $key_product, "message" => "PRODUK BERHASIL DI TAMBAHKAN");
            return response()->json($arr, 200);
        } catch (Exception $e) {
            return $e->errorMessage();
        }
    }

    public function createstore(Request $request)
    {
        $name = $request->nama_toko;
        $user_id = $request->user_id;
        $description = $request->deskripsi;
        $address = $request->alamat;
        $errors = [];
        $is_seller = DB::table('users')->where('id', $user_id)->first();
        $get_user_role = $is_seller->role_user;
        if ($get_user_role == "VISITOR") {
            $arr = array(
                "status" => 403,
                "message" => "PERMINTAAN DI TOLAK",
            );
            return response()->json($arr);
        } else {
            try {
                $isExist = DB::table('store')->where('user_id', $user_id)->exists();
                if ($isExist) {
                    $arr = array(
                        "status" => 403,
                        "message" => "ANDA SUDAH MEMBUAT TOKO",
                    );
                    return response()->json($arr);
                } else {
                    if ($request->hasFile('img_profil')) {
                        $image = $request->file('img_profil');
                        $img_profil = "profil" . str_random(10) . '.' . $image->getClientOriginalExtension();
                        $destinationPath = storage_path('/profil');
                        $image->move($destinationPath, $img_profil);
                    } else {
                        $img_profil = "default-profil.jpg";
                    }
                    if ($request->hasFile('img_banner')) {
                        $image = $request->file('img_banner');
                        $banner_image_name = "banner" . str_random(10) . '.' . $image->getClientOriginalExtension();
                        $destinationPath = storage_path('/banner');
                        $image->move($destinationPath, $banner_image_name);
                    } else {
                        $banner_image_name = "default-profil.jpg";
                    }
                    $insert = store::insert([
                        'img_profil' => $img_profil,
                        'img_banner' => $banner_image_name,
                        'name' => $name,
                        'user_id' => $user_id,
                        'description' => $description,
                        'address' => $address,
                    ]);
                    if (!isset($insert)) {
                        $arr = array(
                            "status" => 403, "message" => "data anda gagal didaftarkan!");
                        return response()->json($arr);
                    }
                    $arr = array(
                        "status" => 200,
                        "message" => "TOKO BERHASIL DI BUAT",
                    );
                    return response()->json($arr, 200);
                }
            } catch (Exception $e) {
                return $e->errorMessage();
            }
        }
    }

    public function product_update(Request $request)
    {
        $path_delete = storage_path('/product_images');
        $name_product = $request->nama_produk;
        $key_product = $request->key_produk;
        $description = $request->deskripsi;
        $product_price = $request->harga;
        $category = $request->kategori;
        $img_name = $key_product;
        $stock = $request->stok;
        $Path = storage_path('/product_images');
        $tb_image_produk = DB::table('produk_image')->where('product_key', $key_product)->first();
        if (!isset($tb_image_produk)) {
            $arr = array("status" => 403, "message" => "KESALAHAN SERVER TIDAK DI KETAHUI");
            return json_encode($arr);
        }
        $old_img_1 = $tb_image_produk->img1;
        $old_img_2 = $tb_image_produk->img2;
        $old_img_3 = $tb_image_produk->img3;
        $old_img_4 = $tb_image_produk->img4;
        $old_img_5 = $tb_image_produk->img5;
        try {
            // if (!file_exists($config_file_path))
            // {
            //   throw new Exception("Configuration file not found.");
            // }
            if ($request->hasFile('img1')) {
                $image = $request->file('img1');
                $name_img_1 = $img_name . str_random(9) . '.' . $image->getClientOriginalExtension();
                $image->move($Path, $name_img_1);
                File::delete($path_delete . '/' . $old_img_1);
            } else {
                $name_img_1 = $tb_image_produk->img1;
            }
            if ($request->hasFile('img2')) {
                $image = $request->file('img2');
                $name_img_2 = $img_name . str_random(9) . '.' . $image->getClientOriginalExtension();
                $image->move($Path, $name_img_2);
                File::delete($path_delete . '/' . $old_img_2);
            } else {
                $name_img_2 = $tb_image_produk->img2;
            }
            if ($request->hasFile('img3')) {
                $image = $request->file('img3');
                $name_img_3 = $img_name . str_random(9) . '.' . $image->getClientOriginalExtension();
                $image->move($Path, $name_img_3);
                File::delete($path_delete . '/' . $old_img_3);
            } else {
                $name_img_3 = $tb_image_produk->img3;
            }
            if ($request->hasFile('img4')) {
                $image = $request->file('img4');
                $name_img_4 = $img_name . str_random(9) . '.' . $image->getClientOriginalExtension();
                $image->move($Path, $name_img_4);
                File::delete($path_delete . '/' . $old_img_4);
            } else {
                $name_img_4 = $tb_image_produk->img4;
            }
            if ($request->hasFile('img5')) {
                $image = $request->file('img5');
                $name_img_5 = $img_name . str_random(9) . '.' . $image->getClientOriginalExtension();
                $image->move($Path, $name_img_5);
                File::delete($path_delete . '/' . $old_img_5);
            } else {
                $name_img_5 = $tb_image_produk->img5;
            }
        } catch (Exception $exc) {
            return $e->errorMessage();
        }
        $update1 = DB::table('produk')->where('product_key', $key_product)->update([
            'product_name' => $name_product,
            'product_price' => $product_price,
            'category' => $category,
            'description' => $description,
            'stock' => $stock,
        ]);
        $update2 = DB::table('produk_image')->where('product_key', $key_product)->update([
            'img1' => $name_img_1,
            'img2' => $name_img_2,
            'img3' => $name_img_3,
            'img4' => $name_img_4,
            'img5' => $name_img_5,
        ]);
        if (!isset($update1) && !isset($update2)) {
            $arr = array("status" => 403, "message" => "KESALAHAN SERVER TIDAK DI KETAHUI");
            return json_encode($arr);
        }
        $arr = array("status" => 200, "message" => "BERHASIL UPDATE");
        return json_encode($arr);
    }

    public function all_store_produk(Request $request)
    {
        $result = array();
        $img = array();
        $user_id = $request->user_id;
        $tb_store = DB::table('store')->where('user_id', $user_id)->first();
        if (!isset($tb_store)) {
            $arr = array("status" => 403, "message" => "KESALAHAN SERVER TIDAK DI KETAHUI");
            return json_encode($arr);
        } else {
            $store_id = $tb_store->id;
            try {
                $get_data_product = DB::table('produk')->where('produk.store_id', $store_id)
                    ->rightJoin('produk_image', 'produk_image.product_key', '=', 'produk.product_key')
                    ->select(
                        'produk.id',
                        'produk.product_key',
                        'produk.store_id',
                        'produk.product_name',
                        'produk.product_price',
                        'produk.category',
                        'produk.description',
                        'produk.stock',
                        'produk_image.img1',
                        'produk_image.img2',
                        'produk_image.img3',
                        'produk_image.img4',
                        'produk_image.img5'
                    )->get();

            } catch (Exception $exc) {
                return $e->errorMessage();
            }
            if ($get_data_product->isEmpty()) {
                $arr = array(
                    "status" => 200,
                    "message" => "SUCCESS",
                    "data" => "TOKO ANDA TIDAK ADA PRODUK",
                );
                return response()->json($arr, 200);
            } else {
                $arr = array(
                    "status" => 200,
                    "message" => "SUCCESS",
                    "data" => $get_data_product,
                );
                return response()->json($arr, 200);
            }
        }
    }

    public function search_function(Request $request)
    {
        $result = array();
        $search_key = $request->kata_kunci;
        try {
            $get_data_product = DB::table('produk')
                ->where('product_name', 'LIKE', "%{$search_key}%")
                ->rightJoin('produk_image', 'produk_image.product_key', '=', 'produk.product_key')
                ->select(
                    'produk.id',
                    'produk.product_key',
                    'produk.store_id',
                    'produk.product_name',
                    'produk.product_price',
                    'produk.category',
                    'produk.description',
                    'produk.stock',
                    'produk_image.img1',
                    'produk_image.img2',
                    'produk_image.img3',
                    'produk_image.img4',
                    'produk_image.img5'
                )->get();
        } catch (Exception $exc) {
            return $e->errorMessage();
        }
        if ($get_data_product->isEmpty()) {
            $arr = array(
                "status" => 201,
                "message" => "KATA KUNCI TIDAK YANG ANDA CARI DITEMUKAN",
            );
            return json_encode($arr);
        } else {
            $arr = array(
                "status" => 200,
                "message" => "SUCCESS",
                "data" => $get_data_product,
            );
            return json_encode($arr);
        }
    }
    public function delete_produk(Request $request)
    {
        $product_key = $request->key_product;
        $Path = storage_path('/product_images');
        $default = "Default";
        try {
            $get_img = imageproduk::where('product_key', $product_key)->first();
            $img_1 = $get_img->img1;
            $img_2 = $get_img->img2;
            $img_3 = $get_img->img3;
            $img_4 = $get_img->img4;
            $img_5 = $get_img->img5;
            File::delete($Path . '/' . $img_1);
            File::delete($Path . '/' . $img_2);
            File::delete($Path . '/' . $img_3);
            File::delete($Path . '/' . $img_4);
            File::delete($Path . '/' . $img_5);
            $get_produk = product::where('product_key', $product_key)->first();
            $get_img->delete();
            $get_produk->delete();
        } catch (Exception $exc) {
            return $e->errorMessage();
        }
        $arr = array("status" => 200, "message" => "SUCCES");
        return response()->json($arr);
    }
}
