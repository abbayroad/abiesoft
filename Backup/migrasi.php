<?php 
namespace AbieSoft\Backup; 
 
use AbieSoft\Sistem\Mysql\DB; 
 
class migrasi { 
 
    public function restoreData(){

        DB::terhubung()->input('migrasi', array(
           'id' => "1",
           'nama' => "aktifitas",
           'dibuat' => "2021-05-01 14:31:51",
           'diupdate' => NULL,
        ));
 
        DB::terhubung()->input('migrasi', array(
           'id' => "2",
           'nama' => "api",
           'dibuat' => "2021-05-01 14:31:51",
           'diupdate' => NULL,
        ));
 
        DB::terhubung()->input('migrasi', array(
           'id' => "3",
           'nama' => "grup",
           'dibuat' => "2021-05-01 14:31:51",
           'diupdate' => NULL,
        ));
 
        DB::terhubung()->input('migrasi', array(
           'id' => "4",
           'nama' => "token",
           'dibuat' => "2021-05-01 14:31:51",
           'diupdate' => NULL,
        ));
 
        DB::terhubung()->input('migrasi', array(
           'id' => "5",
           'nama' => "users",
           'dibuat' => "2021-05-01 14:31:51",
           'diupdate' => NULL,
        ));
 
 
    }
 
} 
 
$create = new migrasi(); 
$create->restoreData();