<?php 

namespace AbieSoft\Sistem\Utility;

class Input {
    
    public static function metode(string $type = 'post') : bool{
        switch($type){
            case 'post':
                return (!empty($_POST)) ? true : false;
            break;
            case 'get':
                return (!empty($_GET)) ? true : false;
            break;
            default:
				return false;
            break;
        }
    }
	
    public static function get(string $item) : string{
        if(isset($_POST[$item])){
             return $_POST[$item];
        }else if (isset($_GET[$item])){
            return $_GET[$item];
        }else{
            return '';   
        }
    }

    public static function file(string $item, string $tipe) : string{
        if(isset($_FILES[$item][$tipe])){
             return $_FILES[$item][$tipe];
        }else{
            return '';   
        }
    }

}