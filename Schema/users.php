<?php

namespace AbieSoft\Schema;

use AbieSoft\Sistem\Mysql\DB;

class users
{

    public static function buattabel()
    {

        $sql = 'CREATE TABLE users ( 
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            nama VARCHAR(255) NOT NULL,
            username VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            salt VARCHAR(255) NOT NULL,
            grup_id INT(6) NOT NULL,
            pin INT(4) NOT NULL,
            photo VARCHAR(255) NOT NULL,
            phone VARCHAR(255) NULL,
            pertanyaan VARCHAR(255) NULL,
            jawaban VARCHAR(255) NULL,
            dibuat DATETIME DEFAULT CURRENT_TIMESTAMP, 
            diupdate DATETIME NULL 
        )';

        DB::terhubung()->query($sql);
        self::buatdata();
    }

    public static function buatdata()
    {

        //DB::terhubung()->input('users', array(
        // Input data disini 
        //));  

    }
}

$create = new users();
$create->buattabel();
