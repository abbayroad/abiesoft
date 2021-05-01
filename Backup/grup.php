<?php 
namespace AbieSoft\Backup; 
 
use AbieSoft\Sistem\Mysql\DB; 
 
class grup { 
 
    public function restoreData(){

        DB::terhubung()->input('grup', array(
           'id' => "1",
           'nama' => "Master AbieSoft",
           'akses' => "aktifitas,api,grup,migrasi,token,users,profile,logout,setprofilenama,setprofileemail,setprofilephone,setprofilephoto",
           'act' => "aktifitas_index,aktifitas_data,aktifitas_detail,aktifitas_create,api_index,api_data,api_create,api_update,grup_index,grup_data,token_index,token_data,token_create,token_update,profile_index,profile_data,profile_detail,profile_updateaktifitas_index,aktifitas_data,aktifitas_baru,aktifitas_edit,aktifitas_detail,aktifitas_create,aktifitas_update,aktifitas_delete,api_index,api_data,api_baru,api_edit,api_detail,api_create,api_update,api_delete,grup_index,grup_data,grup_baru,grup_edit,grup_detail,grup_create,grup_update,grup_delete,migrasi_index,migrasi_data,migrasi_baru,migrasi_edit,migrasi_detail,migrasi_create,migrasi_update,migrasi_delete,token_index,token_data,token_baru,token_edit,token_detail,token_create,token_update,token_delete,users_index,users_data,users_baru,users_edit,users_detail,users_create,users_update,users_delete,profile_index,profile_data,profile_detail,profile_update",
           'menu' => "home,grup,users",
           'dibuat' => "2021-05-01 14:31:51",
           'diupdate' => NULL,
        ));
 
        DB::terhubung()->input('grup', array(
           'id' => "2",
           'nama' => "Standar User",
           'akses' => "aktifitas,api,grup,migrasi,token,profile,logout,setprofilenama,setprofileemail,setprofilephone,setprofilephoto",
           'act' => "aktifitas_index,aktifitas_data,aktifitas_detail,aktifitas_create,api_index,api_data,api_create,api_update,grup_index,grup_data,token_index,token_data,token_create,token_update,profile_index,profile_data,profile_detail,profile_update",
           'menu' => "home",
           'dibuat' => "2021-05-01 15:28:44",
           'diupdate' => NULL,
        ));
 
 
    }
 
} 
 
$create = new grup(); 
$create->restoreData();