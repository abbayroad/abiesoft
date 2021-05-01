<?php

namespace AbieSoft\Schema;

use AbieSoft\Sistem\Mysql\DB;
use AbieSoft\Sistem\Utility\Hash;

class users
{

    public static function buattabel()
    {

        $sql = 'CREATE TABLE users ( 
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            nama VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            salt VARCHAR(255) NOT NULL,
            phone VARCHAR(255) NULL,
            pertanyaan VARCHAR(255) NULL,
            jawaban VARCHAR(255) NULL,
            pin VARCHAR(255) NULL,
            status_login INT(6) NULL,
            photo VARCHAR(255) DEFAULT "default.png",
            kode_reset VARCHAR(255) NULL,
            grup_id INT(6) NULL,
            dibuat DATETIME DEFAULT CURRENT_TIMESTAMP, 
            diupdate DATETIME NULL 
        )';

        DB::terhubung()->query($sql);
        self::buatdata();
    }

    public static function buatdata()
    {

        $salt = Hash::salt();
        $password = "qwe123";
        $defaultpp = "asset/storage/default.jpg";
        $pin = rand(0000, 9999);

        DB::terhubung()->input('users', array(
            'nama' => 'Admin',
            'email' => 'admin@abiesoft.id',
            'password' => Hash::make($password, $salt),
            'salt' => $salt,
            'pertanyaan' => "",
            'jawaban' => "",
            'pin' => $pin,
            'photo' => $defaultpp,
            'grup_id' => 1
        ));
    }
}

$create = new users();
$create->buattabel();
