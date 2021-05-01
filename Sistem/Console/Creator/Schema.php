<?php
namespace AbieSoft\Sistem\Console\Creator;

use AbieSoft\Sistem\Console\Command;

class Schema extends Command{
    
    public static function create($command){
        if(count($command) == 4){
            if($command[3] != "--default"){
                self::standar();
            }else{
                self::standar();
            }
        }else{
            if($command[2]){
                if(file_exists("Schema/".$command[2].".php")){
                    echo "\e[39mFile Schema \e[96m".$command[2]."\e[39m sudah ada, \e[39mapakah ingin menimpanya dengan yang baru? \e[93mYa [\e[39mKetik \e[96mYa\e[93m] / Tidak [\e[39mEnter\e[93m] \e[39m : ";
                    $formjawab = fopen("php://stdin","r");
                    $jawab = trim(fgets($formjawab)); 
                    if($jawab == "Ya"){
                        self::custom($command);
                    }else{
                        echo "\e[31mdibatalkan!\e[39m";
                    }
                }else{
                    self::custom($command);
                }
            }else{
                parent::help();
            }
        }
    }

    public static function custom($command){
        $namafile = explode("_",$command[2]);
        if(count($namafile) == 2){
            if($namafile[0] == "alter"){
                self::shcemaAlter($command);
            }else{
                parent::help();
            }
        }else{
            self::schemaInduk($command);
        }
    }

    public static function shcemaAlter($command){
        $str = explode('_', $command[2]);
        $namaTabel = $str[1];
        $namafile = $command[2];

        $altername = $str[0];
        if($altername != "alter"){
            parent::help();
        }else{
            $createTabel = fopen("Schema/".$namafile.".php", "w") or die("Tidak dapat membuka file!");
                $isiDefault = "<?php \n";
                fwrite($createTabel, $isiDefault);
                $isiDefault = "namespace AbieSoft\Schema; \n \n";
                fwrite($createTabel, $isiDefault);
                $isiDefault = "use AbieSoft\Sistem\Mysql\DB; \n \n";
                fwrite($createTabel, $isiDefault);
                $isiDefault = "class ".$namafile." { \n \n";
                fwrite($createTabel, $isiDefault);
                $isiDefault = "    public static function alterTabel(){ \n \n";
                fwrite($createTabel, $isiDefault);
                $isiDefault = "        $".""."sql = 'ALTER TABLE ".$namaTabel." \n";
                fwrite($createTabel, $isiDefault);
                $isiDefault = "            /* ADD nama_kolom_baru properti_kolom AFTER nama_kolom_sebelumnya */ \n";
                fwrite($createTabel, $isiDefault);
                $isiDefault = "        '; \n \n";
                fwrite($createTabel, $isiDefault);
                $isiDefault = "        DB::terhubung()->query($".""."sql); \n";
                fwrite($createTabel, $isiDefault);
                $isiDefault = "    } \n \n";
                fwrite($createTabel, $isiDefault);
                $isiDefault = "} \n \n";
                fwrite($createTabel, $isiDefault);
                $isiDefault = "$".""."create = new ".$namafile."(); \n";
                fwrite($createTabel, $isiDefault);
                $isiDefault = "$".""."create->alterTabel();";
                fwrite($createTabel, $isiDefault);
            fclose($createTabel);
            echo "\e[36mSchema alter untuk tabel ".$namaTabel." telah dibuat.\e[39m";
        }
    }

    public static function schemaInduk($command){
        $namafile = $command[2];
        $createTabel = fopen("Schema/".$namafile.".php", "w") or die("Tidak dapat membuka file!");
            $isiDefault = "<?php \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "namespace AbieSoft\Schema; \n \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "use AbieSoft\Sistem\Mysql\DB; \n \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "class ".$namafile." { \n \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "    public static function buattabel(){ \n \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "        $".""."sql = 'CREATE TABLE ".$namafile." ( \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "            /* isi format tabel anda disini */ \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "            dibuat DATETIME DEFAULT CURRENT_TIMESTAMP, \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "            diupdate DATETIME NULL \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "        )'; \n \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "        DB::terhubung()->query($".""."sql); \n ";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "       self::buatdata(); \n \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "    } \n \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "    public static function buatdata(){\n\n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "        //DB::terhubung()->input('".$namafile."', array(\n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "            // Input data disini \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "        //));  \n \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "    }\n \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "} \n \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "$".""."create = new ".$namafile."(); \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "$".""."create->buattabel();";
            fwrite($createTabel, $isiDefault);
        fclose($createTabel);
        echo "\e[32mSchema tabel ".$namafile." telah dibuat.\e[39m";
    }

    public static function standar(){
        parent::help();
    }

}