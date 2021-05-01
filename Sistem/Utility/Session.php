<?php

namespace AbieSoft\Sistem\Utility;

class Session {

    public static function ada(string $nama) : bool{
        return isset($_SESSION[$nama]) ? true : false;
    }
        
    public static function simpan(string $nama, string|int $value) : string|int {
        return $_SESSION[$nama] = $value;
    }
        
    public static function lihat(string $nama) : string|int {
        return $_SESSION[$nama];
    }
        
    public static function hapus(string $nama){
        if(self::ada($nama)){
            unset($_SESSION[$nama]);
        }
    }
        
    public static function pesan(string $nama, string|int $string = ''){
        if(self::ada($nama)){
            $sesi = self::lihat($nama);
            self::hapus($nama);
            self::simpan($nama, $string);
            return $sesi;
        }else{
            self::simpan($nama, $string);
        }
    }

}