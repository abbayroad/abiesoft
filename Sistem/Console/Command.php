<?php

namespace AbieSoft\Sistem\Console;

use AbieSoft\Sistem\Utility\Config;
//Database
use AbieSoft\Sistem\Console\Database\Backup;
use AbieSoft\Sistem\Console\Database\Import;
use AbieSoft\Sistem\Console\Database\Restore;

//Creator
use AbieSoft\Sistem\Console\Creator\Schema;
use AbieSoft\Sistem\Console\Creator\Controller;
use AbieSoft\Sistem\Console\Creator\Model;
use AbieSoft\Sistem\Console\Creator\View;

//Dropper
use AbieSoft\Sistem\Console\Dropper\Dropper;

class Command
{

    public function do($command)
    {
        if ($command[1] == "--versi") {
            return self::versi();
        } else if ($command[1] == "-v") {
            return self::versi();
        } else if ($command[1] == "-V") {
            return self::versi();
        } else if ($command[1] == "help") {
            return self::help();
        } else if ($command[1] == "start") {
            return self::start();
        } else if ($command[1] == "backup") {
            return Backup::proses($command);
        } else if ($command[1] == "import") {
            return Import::proses($command);
        } else if ($command[1] == "restore") {
            return Restore::proses($command);
        } else {
            if (count(explode(":", $command[1])) == 2) {
                $action = explode(":", $command[1])[0];
                $konten = explode(":", $command[1])[1];
                if ($action == "create" or $action == "Create") {
                    $action = "create";
                }
                switch ($action) {
                    case "create":
                        if ($konten == "schema" or $konten == "Schema") {
                            return Schema::create($command);
                        } else if ($konten == "model" or $konten == "Model") {
                            return Model::create($command);
                        } else if ($konten == "view" or $konten == "View") {
                            return View::create($command);
                        } else if ($konten == "controller" or $konten == "Controller") {
                            return Controller::create($command);
                        } else {
                            return self::help();
                        }
                        break;
                    case "drop":
                        if ($konten == "schema" or $konten == "Schema") {
                            return Dropper::schema($command);
                        } else if ($konten == "model" or $konten == "Model") {
                            return Dropper::model($command);
                        } else if ($konten == "view" or $konten == "View") {
                            return Dropper::view($command);
                        } else if ($konten == "controller" or $konten == "Controller") {
                            return Dropper::controller($command);
                        } else {
                            return self::help();
                        }
                        break;
                    default:
                        return self::help();
                        break;
                }
            } else {
                return self::help();
            }
        }
    }

    public static function versi()
    {
        echo "AbieSoft Versi " . Config::envReader('RELEASE_VERSI');
    }

    public static function start()
    {
        chdir('public');
        if (Config::envReader('WEB_SSL') == true) {
            $ssl = "https://";
        } else {
            $ssl = "http://";
        }
        $WebUrl = $ssl . Config::envReader('WEB_ID');
        $serverWeb = str_replace($ssl, "", $WebUrl);
        $output = null;
        $retrive = null;
        exec("php -S " . $serverWeb, $output, $retrive);
    }

    public static function help()
    {
        echo "\n";
        echo "\e[39m=======================  Abiesoft Help  ======================= \n \n";
        echo "  Perintah yang tersedia adalah :\n \n";
        echo "     Versi Aplikasi \n";
        echo "          \e[32m--versi\e[39m\n \n";
        echo "          \e[32m-v\e[39m\n \n";
        echo "          \e[32m-V\e[39m\n \n";
        echo "     Help\n";
        echo "          \e[32mhelp\e[39m\n \n";
        echo "     Start Server \n";
        echo "          \e[32mstart\e[39m\n \n";
        echo "     Backup Data Tabel \n";
        echo "          \e[32mbackup\e[39m \e[33m--semua\e[39m\n";
        echo "          \e[32mbackup\e[39m [\e[33mnama tabel\e[39m]\n \n";
        echo "     Import Data Tabel \n";
        echo "          \e[32mimport\e[39m \e[33m--semua\e[39m\n";
        echo "          \e[32mimport\e[39m [\e[33mnamaschema\e[39m]\n";
        echo "          \e[32mimport\e[39m alter_[\e[33mnamaschema\e[39m]\n \n";
        echo "     Restore Data Tabel \n";
        echo "          \e[32mrestore\e[39m \e[33m--semua\e[39m\n";
        echo "          \e[32mrestore\e[39m [\e[33mnama tabel\e[39m]\n \n";
        echo "     Membuat Schema \n";
        echo "          \e[32mcreate:schema\e[39m [\e[33mnamaschema\e[39m] \e[33m\e[39m\n";
        echo "          \e[32mcreate:schema\e[39m alter_[\e[33mnama schema yang ingin ditambahkan kolomnya\e[39m] (Schema Alter digunakan untuk menambahkan kolom pada tabel yang sudah ada)\e[33m\e[39m\n \n";
        echo "     Menghapus Schema \n";
        echo "          \e[32mdrop:schema\e[39m [\e[33mnamaschema\e[39m] \e[33m \e[39m\n \n";
        echo "     Membuat Model \n";
        echo "          \e[32mcreate:model\e[39m [\e[33mNamamodel\e[39m] \e[33m--default\e[39m\n";
        echo "          \e[32mcreate:model\e[39m [\e[33mNamamodel\e[39m] \e[33m \e[39m\n \n";
        echo "     Menghapus Model \n";
        echo "          \e[32mdrop:model\e[39m [\e[33mNamamodel\e[39m] \e[33m \e[39m\n \n";
        echo "     Membuat View \n";
        echo "          \e[32mcreate:view\e[39m [\e[33mfolder\e[39m] \e[33m--default\e[39m Membuat 4 file default otomatis\n";
        echo "          \e[32mcreate:view\e[39m [\e[33mfolder\e[39m].[\e[33mnamafile\e[39m] \e[33m\e[39m\n \n";
        echo "     Menghapus View \n";
        echo "          \e[32mdrop:view\e[39m [\e[33mfolder\e[39m].[\e[33mnamafile\e[39m] \e[33m \e[39m\n \n";
        echo "     Membuat Controller \n";
        echo "          \e[32mcreate:controller\e[39m [\e[33mNamaController\e[39m] \e[33m--default\e[39m\n";
        echo "          \e[32mcreate:controller\e[39m [\e[33mNamaController\e[39m] \e[33m \e[39m\n \n";
        echo "     Menghapus Controller \n";
        echo "          \e[32mdrop:controller\e[39m [\e[33mNamaController\e[39m] \e[33m \e[39m\n \n";
        echo "=============================================================== \e[39m\n";
        echo "\n";
    }
}
