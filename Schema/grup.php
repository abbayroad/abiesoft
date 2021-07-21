<?php

namespace AbieSoft\Schema;

use AbieSoft\Sistem\Mysql\DB;

class grup
{

    public static function buattabel()
    {

        $sql = 'CREATE TABLE grup ( 
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            nama VARCHAR(255) NOT NULL,
            akses TEXT NOT NULL,
            opsi TEXT NOT NULL,
            dibuat DATETIME DEFAULT CURRENT_TIMESTAMP, 
            diupdate DATETIME NULL 
        )';

        DB::terhubung()->query($sql);
        self::buatdata();
    }

    public static function buatdata()
    {

        //DB::terhubung()->input('grup', array(
        // Input data disini 
        //));  

    }
}

$create = new grup();
$create->buattabel();
