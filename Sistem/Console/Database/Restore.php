<?php

namespace AbieSoft\Sistem\Console\Database;

use AbieSoft\Sistem\Console\Command;
use AbieSoft\Sistem\Utility\Config;
use AbieSoft\Sistem\Mysql\DB;

class Restore extends Command {

    public static function proses($command){
        if(count($command) == 3){
            if($command[2] != "--semua"){
                self::satu($command[2]);
            }else{
                self::semua();
            }
        }else{
            parent::help();
        }
    }

    public static function satu($namatabel){
        if(file_exists('Backup/'.$namatabel.'.php')){
            include 'Backup/'.$namatabel.'.php';
        }
        echo "\e[36mTabel ".$namatabel." sudah direstore \e[39m";
    }

    public static function semua(){
        $dir = "Backup/";
        foreach(scandir($dir) as $file){
            if($file != "." && $file != ".."){
                include "Backup/".$file;
                echo "  -----Tabel \e[36m".str_replace(".php","",$file)."\e[39m sudah restore \n";
            }   
        }
        echo "\e[36mSemua tabel sudah restore \e[39m";
    }

}