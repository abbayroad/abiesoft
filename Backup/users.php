<?php 
namespace AbieSoft\Backup; 
 
use AbieSoft\Sistem\Mysql\DB; 
 
class users { 
 
    public function restoreData(){

        DB::terhubung()->input('users', array(
           'id' => "1",
           'nama' => "Admin",
           'email' => "admin@abiesoft.id",
           'password' => "158a923f950d43b717234cd9888b5e5c365e025137306032beb9e2285da58499",
           'salt' => "J~^d",
           'phone' => "0000000000000",
           'pertanyaan' => "Ini menggunakan project apa?",
           'jawaban' => "fc51668243e2b8a89aa3901c4692a67dacb8c02f",
           'pin' => "3252",
           'status_login' => NULL,
           'photo' => "asset/storage/default.jpg",
           'kode_reset' => NULL,
           'grup_id' => "1",
           'dibuat' => "2021-05-01 14:31:51",
           'diupdate' => NULL,
        ));
 
 
    }
 
} 
 
$create = new users(); 
$create->restoreData();