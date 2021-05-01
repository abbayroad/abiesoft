<?php

namespace AbieSoft\Sistem\Http;

class Lanjut{
    
    public static function ke ($lokasi = null) {
        if($lokasi) {
            if(is_numeric($lokasi)){
                switch($lokasi){
					case 404:
                        header('HTTP/1.0 404 Not Found');
						include 'Views/error/404.php';
						exit();
                } 
            }
			header('location:' . $lokasi) ;
            exit();
        }
    }

}