<?php 
namespace AbieSoft\Schema; 
 
use AbieSoft\Sistem\Mysql\DB; 
 
class migrasi { 
 
    public static function buattabel(){ 
 
        $sql = 'CREATE TABLE migrasi ( 
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            nama VARCHAR(255) NOT NULL, 
            dibuat DATETIME DEFAULT CURRENT_TIMESTAMP, 
            diupdate DATETIME NULL 
        )'; 
 
        DB::terhubung()->query($sql); 
        self::buatdata(); 
 
    } 
 
    public static function buatdata(){

        //DB::terhubung()->input('migrasi', array(
            // Input data disini 
        //));  
 
    }
 
} 
 
$create = new migrasi(); 
$create->buattabel();