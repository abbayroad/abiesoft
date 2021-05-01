<?php 
namespace AbieSoft\Backup; 
 
use AbieSoft\Sistem\Mysql\DB; 
 
class token { 
 
    public function restoreData(){

        DB::terhubung()->input('token', array(
           'id' => "1",
           'ip' => "127.0.0.1",
           'token' => "14e4f284194d63623ad1613e33e52c5e7c24e342",
           'dibuat' => "2021-05-01 14:31:55",
           'diupdate' => NULL,
        ));
 
 
    }
 
} 
 
$create = new token(); 
$create->restoreData();