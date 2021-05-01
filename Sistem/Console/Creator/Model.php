<?php

namespace AbieSoft\Sistem\Console\Creator;

use AbieSoft\Sistem\Console\Command;

class Model extends Command
{

    public static function create($command)
    {
        if (count($command) == 4) {
            if ($command[3] != "--default") {
                parent::help();
            } else {
                if (file_exists("Models/" . $command[2] . ".php")) {
                    echo "\e[39mFile \e[96m" . $command[2] . "\e[39m sudah ada, \e[39mapakah ingin menimpanya dengan yang baru? \e[93mYa [\e[39mKetik \e[96mYa\e[93m] / Tidak [\e[39mEnter\e[93m] \e[39m : ";
                    $formjawab = fopen("php://stdin", "r");
                    $jawab = trim(fgets($formjawab));
                    if ($jawab == "Ya") {
                        self::standar($command);
                    } else {
                        echo "\e[31mdibatalkan!\e[39m";
                    }
                } else {
                    self::standar($command);
                }
            }
        } else {
            if ($command[2]) {
                if (file_exists("Models/" . $command[2] . ".php")) {
                    echo "\e[39mFile \e[96m" . $command[2] . "\e[39m sudah ada, \e[39mapakah ingin menimpanya dengan yang baru? \e[93mYa [\e[39mKetik \e[96mYa\e[93m] / Tidak [\e[39mEnter\e[93m] \e[39m : ";
                    $formjawab = fopen("php://stdin", "r");
                    $jawab = trim(fgets($formjawab));
                    if ($jawab == "Ya") {
                        self::custom($command);
                    } else {
                        echo "\e[31mdibatalkan!\e[39m";
                    }
                } else {
                    self::custom($command);
                }
            } else {
                parent::help();
            }
        }
    }

    public static function custom($command)
    {
        $createController = fopen("Models/" . $command[2] . ".php", "w") or die("Tidak dapat membuka file!");
        $isiDefault = "<?php \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "namespace AbieSoft\Models; \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "class " . $command[2] . " { \n \n ";
        fwrite($createController, $isiDefault);
        $isiDefault = "     // " . $command[2] . " \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "}";
        fwrite($createController, $isiDefault);
        fclose($createController);
        echo "\e[96m" . $command[2] . " sudah dibuat. lokasi filenya di Models/" . $command[2] . "\e[39m";
    }

    public static function standar($command)
    {
        $createController = fopen("Models/" . $command[2] . ".php", "w") or die("Tidak dapat membuka file!");
        $isiDefault = "<?php \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "namespace AbieSoft\Models; \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "use AbieSoft\Sistem\Data\Collection; \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "class " . $command[2] . " extends Collection{ \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    public static function tabel(){ \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        $" . "" . "tabel = explode('?', explode('/',$" . "" . "_SERVER['REQUEST_URI'])[1])[0]; \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        return $" . "" . "tabel; \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    } \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    public static function all(){ \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        //return parent::get(self::tabel()); \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    } \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    public static function only($" . "" . "id){ \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        //return parent::detail(self::tabel(),$" . "" . "id); \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    } \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    public static function post(){ \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        //return parent::create(self::tabel(),null); \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    } \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    public static function postUpdate($" . "" . "id){ \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        //return parent::update(self::tabel(),$" . "" . "id,null); \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    } \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    public static function postDrop($" . "" . "id){ \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        //return parent::drop(self::tabel(),$" . "" . "id); \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    } \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "}";
        fwrite($createController, $isiDefault);
        fclose($createController);
        echo "\e[96m" . $command[2] . " sudah dibuat. lokasi filenya di Models/" . $command[2] . "\e[39m";
    }
}
