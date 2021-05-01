<?php 
namespace AbieSoft\Backup; 
 
use AbieSoft\Sistem\Mysql\DB; 
 
class aktifitas { 
 
    public function restoreData(){

        DB::terhubung()->input('aktifitas', array(
           'id' => "1",
           'users_id' => "0",
           'model' => "Login Aplikasi",
           'ip' => "127.0.0.1",
           'perangkat' => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36",
           'catatan' => "-",
           'dibuat' => "2021-05-01 14:32:04",
           'diupdate' => NULL,
        ));
 
        DB::terhubung()->input('aktifitas', array(
           'id' => "2",
           'users_id' => "1",
           'model' => "Membuat data grup baru",
           'ip' => "127.0.0.1",
           'perangkat' => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36",
           'catatan' => "-",
           'dibuat' => "2021-05-01 15:28:44",
           'diupdate' => NULL,
        ));
 
        DB::terhubung()->input('aktifitas', array(
           'id' => "3",
           'users_id' => "1",
           'model' => "Memperbarui Profile",
           'ip' => "127.0.0.1",
           'perangkat' => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36",
           'catatan' => "Melakukan perubahan pada  phone semula <b></b> menjadi <b>0000000000000</b>,  pertanyaan semula <b></b> menjadi <b>Ini menggunakan project apa?</b>,  jawaban, ",
           'dibuat' => "2021-05-01 16:13:53",
           'diupdate' => NULL,
        ));
 
        DB::terhubung()->input('aktifitas', array(
           'id' => "4",
           'users_id' => "1",
           'model' => "Keluar Aplikasi",
           'ip' => "127.0.0.1",
           'perangkat' => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36",
           'catatan' => "-",
           'dibuat' => "2021-05-01 16:14:00",
           'diupdate' => NULL,
        ));
 
        DB::terhubung()->input('aktifitas', array(
           'id' => "5",
           'users_id' => "0",
           'model' => "Login Aplikasi",
           'ip' => "127.0.0.1",
           'perangkat' => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36",
           'catatan' => "-",
           'dibuat' => "2021-05-01 16:55:35",
           'diupdate' => NULL,
        ));
 
        DB::terhubung()->input('aktifitas', array(
           'id' => "6",
           'users_id' => "1",
           'model' => "Keluar Aplikasi",
           'ip' => "127.0.0.1",
           'perangkat' => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36",
           'catatan' => "-",
           'dibuat' => "2021-05-01 16:55:50",
           'diupdate' => NULL,
        ));
 
        DB::terhubung()->input('aktifitas', array(
           'id' => "7",
           'users_id' => "0",
           'model' => "Login Aplikasi",
           'ip' => "127.0.0.1",
           'perangkat' => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36",
           'catatan' => "-",
           'dibuat' => "2021-05-01 17:08:34",
           'diupdate' => NULL,
        ));
 
        DB::terhubung()->input('aktifitas', array(
           'id' => "8",
           'users_id' => "1",
           'model' => "Keluar Aplikasi",
           'ip' => "127.0.0.1",
           'perangkat' => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36",
           'catatan' => "-",
           'dibuat' => "2021-05-01 17:09:13",
           'diupdate' => NULL,
        ));
 
        DB::terhubung()->input('aktifitas', array(
           'id' => "9",
           'users_id' => "0",
           'model' => "Login Aplikasi",
           'ip' => "127.0.0.1",
           'perangkat' => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36",
           'catatan' => "-",
           'dibuat' => "2021-05-01 17:09:25",
           'diupdate' => NULL,
        ));
 
 
    }
 
} 
 
$create = new aktifitas(); 
$create->restoreData();