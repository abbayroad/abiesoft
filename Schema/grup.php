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
            act TEXT NOT NULL, 
            menu TEXT NOT NULL, 
            dibuat DATETIME DEFAULT CURRENT_TIMESTAMP, 
            diupdate DATETIME NULL 
        )';

        DB::terhubung()->query($sql);
        self::buatdata();
    }

    public static function buatdata()
    {

        DB::terhubung()->input('grup', array(
            'nama' => 'Master AbieSoft',
            'akses' => 'aktifitas,api,grup,migrasi,token,users,profile,logout,setprofilenama,setprofileemail,setprofilephone,setprofilephoto',
            'act' => 'aktifitas_index,aktifitas_data,aktifitas_detail,aktifitas_create,api_index,api_data,api_create,api_update,grup_index,grup_data,token_index,token_data,token_create,token_update,profile_index,profile_data,profile_detail,profile_updateaktifitas_index,aktifitas_data,aktifitas_baru,aktifitas_edit,aktifitas_detail,aktifitas_create,aktifitas_update,aktifitas_delete,api_index,api_data,api_baru,api_edit,api_detail,api_create,api_update,api_delete,grup_index,grup_data,grup_baru,grup_edit,grup_detail,grup_create,grup_update,grup_delete,migrasi_index,migrasi_data,migrasi_baru,migrasi_edit,migrasi_detail,migrasi_create,migrasi_update,migrasi_delete,token_index,token_data,token_baru,token_edit,token_detail,token_create,token_update,token_delete,users_index,users_data,users_baru,users_edit,users_detail,users_create,users_update,users_delete,profile_index,profile_data,profile_detail,profile_update',
            'menu' => 'home,grup,users'
        ));
    }
}

$create = new grup();
$create->buattabel();
