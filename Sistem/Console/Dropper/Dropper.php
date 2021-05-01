<?php

namespace AbieSoft\Sistem\Console\Dropper;

use AbieSoft\Sistem\Console\Command;
use AbieSoft\Sistem\Mysql\DB;

class Dropper extends Command{

    public static function schema($command){
        if(isset($command[2])){
            if(file_exists('Schema/'.$command[2].'.php')){
                echo "\e[39mIngin menghapus File \e[96m".$command[2]."\e[39m?, \e[93mYa [\e[39mKetik \e[96mYa\e[93m] / Tidak [\e[39mEnter\e[93m] \e[39m : ";
                $formjawab = fopen("php://stdin","r");
                $jawab = trim(fgets($formjawab)); 
                if($jawab == "Ya"){
                    $cekmigrasi = DB::terhubung()->query("SELECT * FROM migrasi WHERE nama = '".$command[2]."' ");
                    if($cekmigrasi->hitung()){
                        foreach($cekmigrasi->hasil() as $cm){
                            $pesan = DB::terhubung()->hapus('migrasi', array('id','=',$cm->id));
                            $sql = "DROP TABLE ".$command[2];
                            DB::terhubung()->query($sql); 
                        }
                    }
                    unlink('Schema/'.$command[2].'.php');
                    echo "\e[39mFile \e[36m".$command[2]."\e[39m sudah dihapus dari folder Schema!\e[39m";
                }else{
                    echo "\e[31mdibatalkan!\e[39m";
                }
            }else{
                echo "Tidak Ada";
            }
        }else{
            return parent::help();
        }
    }
    
    public static function model($command){
        if(isset($command[2])){
            if(file_exists('Models/'.$command[2].'.php')){
                echo "\e[39mIngin menghapus File \e[96m".$command[2]."\e[39m?, \e[93mYa [\e[39mKetik \e[96mYa\e[93m] / Tidak [\e[39mEnter\e[93m] \e[39m : ";
                $formjawab = fopen("php://stdin","r");
                $jawab = trim(fgets($formjawab)); 
                if($jawab == "Ya"){
                    unlink('Models/'.$command[2].'.php');
                    echo "\e[39mFile \e[36m".$command[2]."\e[39m sudah dihapus dari folder Models!\e[39m";
                }else{
                    echo "\e[31mdibatalkan!\e[39m";
                }
            }else{
                echo "Tidak Ada";
            }
        }else{
            return parent::help();
        }
    }

    public static function view($command){
        if(isset($command[2])){
            if(count(explode(".",$command[2])) == 2){
                $namafile = explode(".",$command[2])[0]."/".explode(".",$command[2])[1];
            }else{
                $namafile = explode(".",$command[2])[0];
            }
            if(file_exists('Views/'.$namafile.'.php')){
                echo "\e[39mIngin menghapus File \e[96m".$namafile.".php \e[39m?, \e[93mYa [\e[39mKetik \e[96mYa\e[93m] / Tidak [\e[39mEnter\e[93m] \e[39m : ";
                $formjawab = fopen("php://stdin","r");
                $jawab = trim(fgets($formjawab)); 
                if($jawab == "Ya"){
                    unlink('Views/'.$namafile.'.php');
                    echo "\e[39mFile \e[36m".$namafile.".php \e[39m sudah dihapus dari folder Views!\e[39m";
                }else{
                    echo "\e[31mdibatalkan!\e[39m";
                }
            }else{
                echo "Tidak Ada";
            }
        }else{
            return parent::help();
        }
    }

    public static function controller($command){
        if(isset($command[2])){
            if(file_exists('Controllers/'.$command[2].'.php')){
                echo "\e[39mIngin menghapus File \e[96m".$command[2]."\e[39m?, \e[93mYa [\e[39mKetik \e[96mYa\e[93m] / Tidak [\e[39mEnter\e[93m] \e[39m : ";
                $formjawab = fopen("php://stdin","r");
                $jawab = trim(fgets($formjawab)); 
                if($jawab == "Ya"){
                    unlink('Controllers/'.$command[2].'.php');
                    echo "\e[39mFile \e[36m".$command[2]."\e[39m sudah dihapus dari folder Controllers!\e[39m";
                }else{
                    echo "\e[31mdibatalkan!\e[39m";
                }
            }else{
                echo "Tidak Ada";
            }
        }else{
            return parent::help();
        }
    }

}