<?php

namespace AbieSoft\Schema;

use AbieSoft\Sistem\Mysql\DB;

class aktifitas
{

    public static function buattabel()
    {

        $sql = 'CREATE TABLE aktifitas ( 
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            users_id INT(6) NOT NULL,
            model VARCHAR(255) NOT NULL,
            ip VARCHAR(255) NOT NULL,
            perangkat VARCHAR(255) NOT NULL,
            catatan TEXT NOT NULL,
            dibuat DATETIME DEFAULT CURRENT_TIMESTAMP, 
            diupdate DATETIME NULL 
        )';

        DB::terhubung()->query($sql);
        self::buatdata();
    }

    public static function buatdata()
    {

        //DB::terhubung()->input('aktifitas', array(
        // Input data disini 
        //));  

    }
}

$create = new aktifitas();
$create->buattabel();
