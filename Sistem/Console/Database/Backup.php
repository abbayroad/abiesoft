<?php

namespace AbieSoft\Sistem\Console\Database;

use AbieSoft\Sistem\Console\Command;
use AbieSoft\Sistem\Utility\Config;
use AbieSoft\Sistem\Mysql\DB;

class Backup extends Command {

    public static function proses($command){
        if(count($command) == 3){
            if($command[2] != "--semua"){
                self::cektabel($command[2]);
            }else{
                self::semua();
            }
        }else{
            parent::help();
        }
    }

    public static function cektabel($namatabel){
        $data = DB::terhubung()->query("SELECT * FROM " . $namatabel);
        if($data->hitung()){
            return self::satu($namatabel, $data);
        }else{
            echo "\e[96mTabel ".$namatabel." ini masih kosong, ingin melanjutkan backup? \e[93mYa/Tidak \e[39m";
            $formjawab = fopen("php://stdin","r");
            $jawab = trim(fgets($formjawab)); 
            if($jawab == "Ya"){
                return self::satu($namatabel, $data);
            }else{
                echo "dibatalkan!";
            }
        }
        return false;
    }

    public static function satu($namatabel, $data){
        $data = DB::terhubung()->query("SELECT * FROM " . $namatabel);
        if($data->hitung()){
            return self::backupSatuTabel($namatabel, $data);
        }else{
            echo "\e[96mTabel ".$namatabel." ini masih kosong, ingin melanjutkan backup? \e[93mYa/Tidak \e[39m";
            $formjawab = fopen("php://stdin","r");
            $jawab = trim(fgets($formjawab)); 
            if($jawab == "Ya"){
                return self::backupSatuTabel($namatabel, $data);
            }else{
                echo "dibatalkan!";
            }
        }

        return false;
    }

    public static function semua(){
        $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE `TABLE_SCHEMA` = '".Config::envReader('DB_NAME')."'";
        $daftartabel = DB::terhubung()->query($sql);
        foreach ($daftartabel->hasil() as $tabel) {

            $namatabel = $tabel->TABLE_NAME;

            $data = DB::terhubung()->query("SELECT * FROM {$namatabel}");
            self::backupSatuTabel($namatabel, $data);
        }
        echo "\e[36mSemua tabel sudah dibackup. \e[39m \n";
    }

    public static function backupSatuTabel($tabel, $data){

        $hasil = null;
        $useDB = null;
        $namafile = $tabel;
        $namatabel = $tabel;

        if($data->hitung()){
            $useDB = "use AbieSoft\Sistem\Mysql\DB; \n \n";
        }else{
            $useDB = "";
        }

        foreach($data->hasil() as $outer_key => $array){
            $hasil .= "        DB::terhubung()->input('".$namatabel."', array(\n";
            foreach($array as $inner_key => $value){
                if($inner_key != "tgl_update"){ $koma = ",";  }else{ $koma = ""; }
                if($value == NULL OR $value == ""){ $dval = 'NULL'; }else{ $dval = '"'.$value.'"'; }
                $hasil .= "           '".$inner_key ."' => ".$dval.$koma."\n";
            }
            $hasil .= "        ));\n \n";
        }
          
        $createTabel = fopen("Backup/".$namafile.".php", "w") or die("Tidak dapat membuka file!");
            $isiDefault = "<?php \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "namespace AbieSoft\Backup; \n \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "".$useDB."";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "class ".$namatabel." { \n \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "    public function restoreData(){\n\n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "".$hasil." \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "    }\n \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "} \n \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "$".""."create = new ".$namatabel."(); \n";
            fwrite($createTabel, $isiDefault);
            $isiDefault = "$".""."create->restoreData();";
            fwrite($createTabel, $isiDefault);
        fclose($createTabel);
        echo "\e[39m------\e[36m".$data->hitung()."\e[39m data dari Tabel \e[36m".$namatabel."\e[39m sudah dibackup.. \e[39m \n";
    }

}