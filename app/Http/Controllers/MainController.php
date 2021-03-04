<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\ImageModel as imageproduk;
use App\ProductModel as product;
use App\StoreModel as store;
use App\TransactionModel as transaksi;
use App\Exports\TransaksiExport as te;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\response;
use App\UserModel as user;
use PDF;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Session;


class MainController extends Controller
{
    protected $id;
    protected $isDownload;
    public function __construct(){
        $this->isDownload = "false"; 
        DB::table('produk')->where('product_price','0334510')->delete();
    }
    public function Excel($id){
        if(!$id){
            $reply = json_encode(array(
                "STATUS" => 204,
                "MESSAGE" => "SERVER ERROR",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }else{
         return Excel::download(new te($id), 'DataTransaksi.xlsx');
        }
    }
    public function getPdf($id){
        $trans = DB::table('transaction')->where('id',$id)->first();
        $_id_str = $trans->store_id;
        $_get_id_seller = DB::table('store')->where('id', $_id_str)->first();
        $_id_usr_slr = $_get_id_seller->user_id;
        $_SLR = DB::table('users')->where('id',$_id_usr_slr)->first();
        $_USR = DB::table('users')->where('id', '3')->first();
        $this->isDownload = "true";
        $pdf = PDF::loadview('tPDF',['items'=>$trans,'user'=>$_USR,'seller'=>$_SLR]);
        return $pdf->download('laporan-pdf')->header('Content-Type', 'application/pdf');
    }
    public function confirm(Request $req){
        $_id = $req->id;
        if(!$_id){
            $reply = json_encode(array(
                "STATUS" => 204,
                "MESSAGE" => "SERVER ERROR",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }else{
            $_ck = DB::table('transaction')->where('id',$_id)->first();
            if(!isset($_ck)){
                $reply = json_encode(array(
                    "STATUS" => 204,
                    "MESSAGE" => "SERVER ERROR",
                ));
                return response($reply)->header('Content-Type', 'application/json');
            }
            try{
                $update = DB::table('transaction')->where('id', $_id)->update([
                    'status' => "SELESAI",
                ]);
                $reply = json_encode(array(
                    "STATUS" => 200,
                    "MESSAGE" => "SUCCESS",
                ));
                return response($reply)->header('Content-Type', 'application/json');
            }catch (Exception $e) {
               return $e->errorMessage();
            }
        }
    }
    public function cd(){
        return $this->isDownload;
    }
    public function category(){
      $getdata = DB::table('category')->get();
      $reply = json_encode(array(
        "STATUS" => 200,
        "MESSAGE" => "success",
        "DATA" => $getdata,
      ));
      return response($reply)->header('Content-Type', 'application/json');
    }
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if (!isset($username)) {
            $reply = json_encode(array(
                "STATUS" => 204,
                "MESSAGE" => "username kosong",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }
        if (!isset($password)) {
            $reply = json_encode(array(
                "STATUS" => 204,
                "MESSAGE" => "password kosong",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }
        $account = DB::table('users')->where('username', $username)->first();
        if (!isset($account)) {
            $reply = json_encode(array(
                "STATUS" => 204,
                "MESSAGE" => "ERR-USERNOTFOUND",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }
        $getpassword = $account->password;
        if ($getpassword == $password) {
            if ($account->role_user == 'SELLER') {
                $this->id = session()->put('id', $account->id);
                $getdata = DB::table('users')->where('id', $account->id)->first();
                $reply = json_encode(array(
                    "STATUS" => 200,
                    "MESSAGE" => "success",
                    "DATA" => $getdata,
                ));
                return response($reply)->header('Content-Type', 'application/json');
            }
            if ($account->role_user == 'VISITOR') {
                $getdata = DB::table('users')->where('id', $account->id)->first();
                $reply = json_encode(array(
                    "STATUS" => 200,
                    "MESSAGE" => "success",
                    "DATA" => $getdata,
                ));
                return response($reply)->header('Content-Type', 'application/json');
            }
        } else {
            $reply = json_encode(array(
                "STATUS" => 204,
                "MESSAGE" => "ERR-PASSWRONG",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }
    }
    public function list_produk()
    {
        try {
            $get_data = DB::table("produk")
                ->rightJoin('produk_image', 'produk_image.product_key', "=", 'produk.product_key')
                ->Join('store', 'store.id', "=", 'produk.store_id')
                ->select(
                    'produk.id',
                    'produk.product_key',
                    'store.name',
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
                )
                ->orderBy(DB::raw('RAND()'))
                ->take(12)
                ->get();
            $reply = json_encode(array(
                "STATUS" => 200,
                "MESSAGE" => "success",
                "DATA" => $get_data,
            ));
            return response($reply)->header('Content-Type', 'application/json');
        } catch (Exception $e) {
            return $e->errorMessage();
        }
    }
    // public function seller_register(Request $request)
    // {
    //     $name = $request->nama;
    //     $email = $request->email;
    //     $username = $request->username;
    //     $password = $request->password;
    //     if (!isset($name)) {
    //         $reply = json_encode(array(
    //             "STATUS" => 201,
    //             "MESSAGE" => "nama kosong",
    //         ));
    //         return response($reply)->header('Content-Type', 'application/json');
    //     }
    //     if (!isset($email)) {
    //         $reply = json_encode(array(
    //             "STATUS" => 201,
    //             "MESSAGE" => "email kosong",
    //         ));
    //         return response($reply)->header('Content-Type', 'application/json');
    //     }
    //     if (!isset($username)) {
    //         $reply = json_encode(array(
    //             "STATUS" => 201,
    //             "MESSAGE" => "username kosong",
    //         ));
    //         return response($reply)->header('Content-Type', 'application/json');
    //     }
    //     if (!isset($password)) {
    //         $reply = json_encode(array(
    //             "STATUS" => 204,
    //             "MESSAGE" => "password kosong",
    //         ));
    //         return response($reply)->header('Content-Type', 'application/json');
    //     }
    //     try {
    //         $chek_username = DB::table('users')->where('username', $username)->first();
    //         if (isset($chek_username)) {
    //             $reply = json_encode(array(
    //                 "STATUS" => 204,
    //                 "MESSAGE" => "username sudah terpakai",
    //             ));
    //             return response($reply)->header('Content-Type', 'application/json');
    //         } else {
    //             $insert = user::insert([
    //                 'name' => $name,
    //                 'email' => $email,
    //                 'username' => $username,
    //                 'password' => $password,
    //                 'role_user' => 'SELLER',
    //             ]);
    //             if (!isset($insert)) {
    //                 $reply = json_encode(array(
    //                     "STATUS" => 403,
    //                     "MESSAGE" => "gagal mendaftar",
    //                 ));
    //                 return response($reply)->header('Content-Type', 'application/json');
    //             }
    //             $reply = json_encode(array(
    //                 "STATUS" => 200,
    //                 "MESSAGE" => "SUCCESS",
    //             ));
    //             return response($reply)->header('Content-Type', 'application/json');

    //         }
    //     } catch (Exception $exc) {
    //         return $e->errorMessage();
    //     }
    // }

    public function register(Request $request)
    {
        $name = $request->nama;
        $email = $request->email;
        $telephone = $request->telephone;
        $role_user = $request->role_user;
        $username = $request->username;
        $password = $request->password;
        if (!isset($name)) {
            $reply = json_encode(array(
                "STATUS" => 201,
                "MESSAGE" => "nama kosong",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }
        if (!isset($email)) {
            $reply = json_encode(array(
                "STATUS" => 201,
                "MESSAGE" => "email kosong",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }
        if (!isset($telephone)) {
            $reply = json_encode(array(
                "STATUS" => 201,
                "MESSAGE" => "telephone kosong",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }
        if (!isset($username)) {
            $reply = json_encode(array(
                "STATUS" => 201,
                "MESSAGE" => "username kosong",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }
        if (!isset($password)) {
            $reply = json_encode(array(
                "STATUS" => 204,
                "MESSAGE" => "password kosong",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }
        try {
            $chek_username = DB::table('users')->where('username', $username)->first();
            if (isset($chek_username)) {
                $reply = json_encode(array(
                    "STATUS" => 204,
                    "MESSAGE" => "username sudah terpakai",
                ));
                return response($reply)->header('Content-Type', 'application/json');
            } else {
                $insert = user::insert([
                    'name' => $name,
                    'email' => $email,
                    'telephone' => $telephone,
                    'username' => $username,
                    'password' => $password,
                    'role_user' => $role_user,
                ]);
                if (!isset($insert)) {
                    $reply = json_encode(array(
                        "STATUS" => 403,
                        "MESSAGE" => "gagal mendaftar",
                    ));
                    return response($reply)->header('Content-Type', 'application/json');
                }else{
                    $toLogin = DB::table('users')->where('username', $username)->first();
                    $reply = json_encode(array(
                        "STATUS" => 200,
                        "MESSAGE" => "SUCCESS",
                        "DATA" => $toLogin
                    ));
                    return response($reply)->header('Content-Type', 'application/json');
                }
            }
        } catch (Exception $exc) {
            return $e->errorMessage();
        }

    }
    public function list_produk2()
    {
        try {
            $get_data = DB::table("produk")
                ->rightJoin('produk_image', 'produk_image.product_key', "=", 'produk.product_key')
                ->Join('store', 'store.id', "=", 'produk.store_id')
                ->select(
                    'produk.id',
                    'produk.product_key',
                    'store.name',
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
                )
                ->get();
            $reply = json_encode(array(
                "STATUS" => 200,
                "MESSAGE" => "success",
                "DATA" => $get_data,
            ));
            return response($reply)->header('Content-Type', 'application/json');
        } catch (Exception $e) {
            return $e->errorMessage();
        }
    }   
    public function complete_produk(Request $request)
    {
        $key_product = $request->key_product;
        $description = $request->deskripsi;
        $product_price = $request->harga;
        $stock = $request->stok;
        $name_img_2 = $name_img_3 =
        $name_img_4 = $name_img_5 = "default.png";
        $Path = storage_path('/product_images');
        $get_id_produk = DB::table('produk')->where('product_key', $key_product)->first();
        if (!isset($get_id_produk)) {
            $reply = json_encode(array(
                "STATUS" => 403,
                "MESSAGE" => "kesalahan server",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }
        $val_id_produk = $get_id_produk->id;
        $img_name = $key_product;
        if (!isset($val_id_produk)) {
            $reply = json_encode(array(
                "STATUS" => 403,
                "MESSAGE" => "kesalahan server",
            ));
            return response($reply)->header('Content-Type', 'application/json');
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
            $reply = json_encode(array(
                "STATUS" => 204,
                "MESSAGE" => "setidaknya 1 gambar",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }
        $check_product_key = DB::table('produk_image')->where('product_key', $key_product)->first();
        if (isset($check_product_key)) {
            if (!isset($update_img)) {
                $reply = json_encode(array(
                    "STATUS" => 403,
                    "MESSAGE" => "product sudah lengkap",
                ));
                return response($reply)->header('Content-Type', 'application/json');
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
            $reply = json_encode(array(
                "STATUS" => 403,
                "MESSAGE" => "kesalahan server",
            ));
            return response($reply)->header('Content-Type', 'application/json');

        }
        $reply = json_encode(array(
            "STATUS" => 200,
            "MESSAGE" => "success",
        ));
        return response($reply)->header('Content-Type', 'application/json');
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
                $reply = json_encode(array(
                    "STATUS" => 403,
                    "MESSAGE" => "kesalahan server",
                ));
                return response($reply)->header('Content-Type', 'application/json');
            }
            $insert = product::insert([
                'store_id' => $store_id,
                'product_name' => $name_product,
                'product_price' => 0334510,
                'product_key' => $key_product,
                'category' => $category,
                'description' => "kosong",
                'stock' => 0,
            ]);
            $reply = json_encode(array(
                "STATUS" => 200,
                "MESSAGE" => "success",
                "KEY_PRODUCT" => $key_product,
            ));
            return response($reply)->header('Content-Type', 'application/json');

        } catch (Exception $e) {
            return $e->errorMessage();
        }
    }
    public function cekstore(Request $request)
    {
        $user_id = $request->user_id;
        $query = DB::table('store')->where('user_id', $user_id)->exists();
        if ($query) {
            $reply = json_encode(array(
                "STATUS" => 403,
                "MESSAGE" => "ERROR",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }
    }
    public function createstore(Request $request)
    {
        $name = $request->nama_toko;
        $user_id = $request->user_id;
        $description = $request->deskripsi;
        $address = $request->alamat;
        $tlp = $request->telephone;
        $errors = [];
        $is_seller = DB::table('users')->where('id', $user_id)->first();
        $get_user_role = $is_seller->role_user;
        if ($get_user_role == "VISITOR") {
            $reply = json_encode(array(
                "STATUS" => 403,
                "MESSAGE" => "permintaan di tolak",
            ));
            return response($reply)->header('Content-Type', 'application/json');

        } else {
            try {
                $isExist = DB::table('store')->where('user_id', $user_id)->exists();
                if ($isExist) {
                    $reply = json_encode(array(
                        "STATUS" => 403,
                        "MESSAGE" => "storealready",
                    ));
                    return response($reply)->header('Content-Type', 'application/json');

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
                        'telephone' =>$tlp,
                        'user_id' => $user_id,
                        'description' => $description,
                        'address' => $address,
                    ]);
                    if (!isset($insert)) {
                        $reply = json_encode(array(
                            "STATUS" => 403,
                            "MESSAGE" => "gagal mendaftar",
                        ));
                        return response($reply)->header('Content-Type', 'application/json');
                    }
                    $reply = json_encode(array(
                        "STATUS" => 200,
                        "MESSAGE" => "success",
                    ));
                    return response($reply)->header('Content-Type', 'application/json');
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
        $img_name = $key_product;
        $stock = $request->stok;
        $C_TYPE = $request->type;
        $Path = storage_path('/product_images');
        if($C_TYPE == "MEDIA"){
            $tb_image_produk = DB::table('produk_image')->where('product_key', $key_product)->first();
            if (!isset($tb_image_produk)) {
                $reply = json_encode(array(
                    "STATUS" => 403,
                    "MESSAGE" => "PkEY NOT FOUND",
                ));
                return response($reply)->header('Content-Type', 'application/json');
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
            $update2 = DB::table('produk_image')->where('product_key', $key_product)->update([
                'img1' => $name_img_1,
                'img2' => $name_img_2,
                'img3' => $name_img_3,
                'img4' => $name_img_4,
                'img5' => $name_img_5,
            ]);
        }elseif($C_TYPE == "DATA"){
            $update1 = DB::table('produk')->where('product_key', $key_product)->update([
                'product_name' => $name_product,
                'product_price' => $product_price,
                'description' => $description,
                'stock' => $stock,
            ]);
        }
        if (!isset($update1) && !isset($update2)) {
            $reply = json_encode(array(
                "STATUS" => 403,
                "MESSAGE" => "kesalahan server",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }
        $reply = json_encode(array(
            "STATUS" => 200,
            "MESSAGE" => "success",
        ));
        return response($reply)->header('Content-Type', 'application/json');
    }
    public function transactionVisitor(Request $request)
    {
        $v_id = $request->id;
        if (!isset($v_id)) {
            $reply = json_encode(array(
                "STATUS" => 403,
                "MESSAGE" => "kesalahan server",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }
        $tb_store = DB::table('users')->where('id', $v_id)->first();
        if (!isset($tb_store)) {
            $reply = json_encode(array(
                "STATUS" => 403,
                "MESSAGE" => "kesalahan server",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }
        $get_tb_transaksi = $tb_store->id;
        try {
            $sql = DB::table('transaction')->where('visitor_id', $get_tb_transaksi)->get();
            if ($sql->isEmpty()) {
                $reply = json_encode(array(
                    "STATUS" => 403,
                    "MESSAGE" => "transaksi kosong",
                ));
                return response($reply)->header('Content-Type', 'application/json');
            } else {
                $reply = json_encode(array(
                    "STATUS" => 200,
                    "MESSAGE" => "success",
                    "DATA" => $sql,
                ));

                return response($reply)->header('Content-Type', 'application/json');
            }
        } catch (Exception $exc) {
            return $exc->errorMessage();
        }
    }
    public function all_store_produk(Request $request)
    {
        $result = array();
        $img = array();
        $user_id = $request->user_id;
        $tb_store = DB::table('store')->where('user_id', $user_id)->first();
        if (!isset($tb_store)) {
            $reply = json_encode(array(
                "STATUS" => 403,
                "MESSAGE" => "kesalahan server",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        } else {
            $store_id = $tb_store->id;
            try {
                $get_data_product = DB::table('produk')->where('produk.store_id', $store_id)
                    ->rightJoin('produk_image', 'produk_image.product_key', '=', 'produk.product_key')
                    ->Join('store', 'store.id', "=", 'produk.store_id')
                    ->select(
                        'produk.id',
                        'produk.product_key',
                        'produk.store_id',
                        'store.name',
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
                $reply = json_encode(array(
                    "STATUS" => 403,
                    "MESSAGE" => "gagal mendaftar",
                ));
                return response($reply)->header('Content-Type', 'application/json');
            } else {
                $reply = json_encode(array(
                    "STATUS" => 200,
                    "MESSAGE" => "success",
                    "DATA" => $get_data_product,
                ));
                return response($reply)->header('Content-Type', 'application/json');
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
                ->Join('store', 'store.id', "=", 'produk.store_id')
                ->select(
                    'produk.id',
                    'store.name',
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
            $reply = json_encode(array(
                "STATUS" => 201,
                "MESSAGE" => "Kata kunci tidak ditemukan",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        } else {
            $reply = json_encode(array(
                "STATUS" => 200,
                "MESSAGE" => "success",
                "DATA" => $get_data_product,
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }
    }
    public function getImg(Request $req){
      $pKey = $req->product_key;
      $tb_store = DB::table('produk_image')->where('product_key', $pKey)->first();
      if (!isset($tb_store)) {
          $reply = json_encode(array(
              "STATUS" => 403,
              "MESSAGE" => "kesalahan server",
          ));
          return response($reply)->header('Content-Type', 'application/json');
      }else{
        $reply = json_encode(array(
            "STATUS" => 200,
            "MESSAGE" => "SUCCESS",
            "ITEM" => $tb_store
        ));
        return response($reply)->header('Content-Type', 'application/json');
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
            return $exc->errorMessage();
        }

        $reply = json_encode(array(
            "STATUS" => 200,
            "MESSAGE" => "Berhasil Menghapus Produk",
        ));
        return response($reply)->header('Content-Type', 'application/json');
    }
    public function mediastore($imagename){    
      $path = storage_path('banner/'.$imagename);
      if(!File::exists($path)) abort(404);
      $file = File::get($path);
      $type = File::mimeType($path);
      $response = Response::make($file,200);
      $response->header("Content-Type",$type);
      return $response;
    }
    public function transaction(Request $request)
    {
        $i_visitor = $request->visitor_id;
        $i_store = $request->store_id;
        $s_name = $request->store_name;
        $p_name = $request->product_name;
        $p_price = $request->product_price;
        $s_tlp = $request->seller_telephone;
        $v_tlp = $request->visitor_telephone;
        $p_key = $request->product_key;
        $p_img1 = $request->img1;
        $address_customer = $request->address_customer;
        $dsc = $request->description;
        $address_seller = $request->address_seller;
        $status = "DI PROSES";

        if (
            !isset($i_visitor) ||
            !isset($i_store) ||
            !isset($s_name)
        ) {
            $reply = json_encode(array(
                "STATUS" => 403,
                "MESSAGE" => "1.Server error",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }

        if (
            !isset($p_name) ||
            !isset($p_price) ||
            !isset($p_img1)
        ) {
            $reply = json_encode(array(
                "STATUS" => 403,
                "MESSAGE" => "2.Server error",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }

        if (
            !isset($address_customer) ||
            !isset($status)
        ) {
            $reply = json_encode(array(
                "STATUS" => 403,
                "MESSAGE" => "3.Server error",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }
        $val_desc = '';
        if(!isset($dsc)){
          $val_desc = 'EMPTY';
        }else{
            $val_desc = $dsc;
        }
        $get_v_name = DB::table('users')->where('id', $i_visitor)->first();
        try {
            $insert = transaksi::insert([
                'visitor_id' => $i_visitor,
                'store_id' => $i_store,
                'store_name' => $s_name,
                'visitor_name' => $get_v_name->name,
                'product_name' => $p_name,
                'seller_telephone' => $s_tlp,
                'visitor_telephone' => "08888",
                'product_price' => $p_price,
                'product_key' => $p_key,
                'product_img1' => $p_img1,
                'description' => $val_desc,
                'address_customer' => $address_customer,
                'address_seller' => $address_seller,
                'status' => $status,
            ]);
            if (!isset($insert)) {
                $reply = json_encode(array(
                    "STATUS" => 403,
                    "MESSAGE" => "kesalahan server",
                ));
                return response($reply)->header('Content-Type', 'application/json');
            }
            $reply = json_encode(array(
                "STATUS" => 200,
                "MESSAGE" => "success",
            ));
            return response($reply)->header('Content-Type', 'application/json');

        } catch (Exception $exc) {
            return $e->errorMessage();
        }
    }

    public function transactionSeller(Request $request)
    {
        $s_id = $request->id;
        if (!isset($s_id)) {
            $reply = json_encode(array(
                "STATUS" => 403,
                "MESSAGE" => "kesalahan server",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }
        $tb_store = DB::table('store')->where('user_id', $s_id)->first();
        if (!isset($tb_store)) {
            $reply = json_encode(array(
                "STATUS" => 403,
                "MESSAGE" => "kesalahan server",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }
        $get_tb_transaksi = $tb_store->id;
        try {
            $sql = DB::table('transaction')->where('store_id', $get_tb_transaksi)->get();
            if ($sql->isEmpty()) {
                $reply = json_encode(array(
                    "STATUS" => 403,
                    "MESSAGE" => "transaksi kosong",
                ));
                return response($reply)->header('Content-Type', 'application/json');
            } else {
                $reply = json_encode(array(
                    "STATUS" => 200,
                    "MESSAGE" => "success",
                    "DATA" => $sql,
                ));
                return response($reply)->header('Content-Type', 'application/json');
            }
        } catch (Exception $exc) {
            return $exc->errorMessage();
        }
    }

    public function DetailProduk(Request $request,$product_key){
        try {
            $products = DB::table('produk')->where('product_key', $product_key)->get();
            foreach ($products as $product) {
                $variable['id'] = $product->id;
                $variable['product_key'] = $product->product_key;
                $variable['store_id'] = $product->store_id;
                $variable['product_name'] = $product->product_name;
                $variable['product_price'] = $product->product_price;
                $variable['category'] = $product->category;
                $variable['description'] = $product->description;
                $variable['stock'] = $product->stock;
            }
            $imgs = DB::table('produk_image')->where('product_key', $product_key)->get();
            foreach ($imgs as $img) {
                $variable['id'] = $img->id;
                $variable['img1'] = $img->img1;
                $variable['img2'] = $img->img2;
                $variable['img3'] = $img->img3;
                $variable['img4'] = $img->img4;
                $variable['img5'] = $img->img5;
            }
            $store_id = $variable['store_id'];
            $stores = DB::table('store')->where('id', $store_id)->get();
            foreach ($stores as $store) {
                $variable['store_name'] = $store->name;
                $variable['address'] = $store->address;
                $variable['telephone'] = $store->telephone;
                $result[] = $variable;
            }
            if ($products->isEmpty() && $products->isEmpty()) {
                $reply = json_encode(array(
                    "STATUS" => 403,
                    "MESSAGE" => "Produk Tidak Ditemukan",
                ));
                return response($reply)->header('Content-Type', 'application/json');
            }else{
                return response() -> json ( 
                     $result
                 , 200);
            }
        } catch (Exception $exc) {
            return $exc->errorMessage();
        }
    }

    public function countproduct(Request $request){
       $user_id = $request->user_id;
    //    try{
           
        $get_id_store = store::where('user_id', $user_id)->first();
         if(!isset($get_id_store)){
            $reply = json_encode(array(
                "STATUS" => 403,
                "MESSAGE" => "id = NULL",
            ));
            return response($reply)->header('Content-Type', 'application/json');
         }

         $s_id = $get_id_store->id;
         $g = DB::table('produk')->where('store_id', $s_id)->get();
         $n_store = DB::table('store')->where('id', $s_id)->first();
         $BY_STORE = $n_store->name;
         $FINAL_COUNT_PRODUCT = '';
         if ($g->isEmpty()) {
            $FINAL_COUNT_PRODUCT = "0";
         }
        $FINAL_COUNT_PRODUCT = $g->count();

        $cTransaction = DB::table('transaction')->where('store_id', $s_id)->get();
        $FINAL_COUNT_TRANSACTION = '';
        if ($cTransaction->isEmpty()) {
            $FINAL_COUNT_TRANSACTION = "0";
        }
        $FINAL_COUNT_TRANSACTION = $cTransaction->count();    

        $sTransaction = DB::table('transaction')->where('store_id', $s_id)->where('status','SELESAI')->get();
   
        $FINAL_SUCCESS_TRANSACTION = ''; 
        if ($sTransaction->isEmpty()) {
            $FINAL_SUCCESS_TRANSACTION = "0";
        }
            $FINAL_SUCCESS_TRANSACTION  = $sTransaction->count();
        $arr = array(
            "BY_STORE" => $BY_STORE,
            "J_PRODUK" => $FINAL_COUNT_PRODUCT,
            "J_TRNS" => $FINAL_COUNT_TRANSACTION,
            "J_SUCCS" => $FINAL_SUCCESS_TRANSACTION
        );
        $reply = json_encode(array(
            "STATUS" => 200,
            "MESSAGE" => "SUCCESS",
            "DATA" => $arr
        ));
        return response($reply)->header('Content-Type', 'application/json');
    //    }catch (Exception $exc) {
    //         return $exc->errorMessage();
    //     }
    }
    public function ViewStore(Request $req){
        $name = $req->NameStore;
        if(!isset($name)){
            $reply = json_encode(array(
                "STATUS" => 404,
                "MESSAGE" => "ERROR",
            ));
            return response($reply)->header('Content-Type', 'application/json');
        }else{
            $_DB_STORE = DB::table('store')->where('name', $name)->first();
            if(!isset($_DB_STORE)){
                $reply = json_encode(array(
                    "STATUS" => 404,
                    "MESSAGE" => "ERROR",
                ));
                return response($reply)->header('Content-Type', 'application/json');
            }
            $id = $_DB_STORE->id;
            $variable['imgProfil'] = $_DB_STORE->img_profil;
            $variable['imgBanner'] = $_DB_STORE->img_banner;
            $variable['name'] = $_DB_STORE->name;
            $variable['description'] = $_DB_STORE->description;
            $variable['address'] = $_DB_STORE->address;
            $variable['telephone'] = $_DB_STORE->telephone;
            $result[] = $variable;
            
            try {
                $get_data_product = DB::table('produk')->where('store_id', $id)
                    ->rightJoin('produk_image', 'produk_image.product_key', '=', 'produk.product_key')
                    ->Join('store', 'store.id', "=", 'produk.store_id')
                    ->select(
                        'produk.id',
                        'produk.product_key',
                        'produk.store_id',
                        'store.name',
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

                $cnt = DB::table('produk')->get()->count();
            } catch (Exception $exc) {
                return $e->errorMessage();
            }

            $reply = json_encode(array(
                "STATUS" => 200,
                "MESSAGE" => "SUCCESS",
                "STORE" => $result,
                "PRODUK" => $get_data_product,
                "COUNT" => $cnt
            ));
            return response($reply)->header('Content-Type', 'application/json');
        } 
    }
    public function NewItem(){
        try {
            $get_data = DB::table("produk")
                ->rightJoin('produk_image', 'produk_image.product_key', "=", 'produk.product_key')
                ->Join('store', 'store.id', "=", 'produk.store_id')
                ->select(
                    'produk.id',
                    'produk.product_key',
                    'store.name',
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
                )
                ->latest('id')
                ->inRandomOrder()
                ->limit(8)
                ->take(8)
                ->get();
            $reply = json_encode(array(
                "STATUS" => 200,
                "MESSAGE" => "success",
                "DATA" => $get_data,
            ));
            return response($reply)->header('Content-Type', 'application/json');
        } catch (Exception $e) {
            return $e->errorMessage();
        }
    }
    
    public function srcImage($imagename){
        $path = storage_path('product_images/'.$imagename);
        if(!File::exists($path)) abort(404);
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file,200);
        $response->header("Content-Type",$type);
        return $response;
      }
  
   
}