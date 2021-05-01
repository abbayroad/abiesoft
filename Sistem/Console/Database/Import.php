<?php

namespace AbieSoft\Sistem\Console\Database;

use AbieSoft\Sistem\Console\Command;
use AbieSoft\Sistem\Utility\Config;
use AbieSoft\Sistem\Mysql\DB;

class Import extends Command
{

    public static function proses($command)
    {
        if (count($command) == 3) {
            if ($command[2] != "--semua") {
                self::satu($command[2]);
            } else {
                self::semua();
            }
        } else {
            parent::help();
        }
    }

    public static function satu($nama)
    {
        $cektabelmigrasi = DB::terhubung()->query("SELECT * FROM migrasi");
        if ($cektabelmigrasi->hitung()) {
            $cekimport = DB::terhubung()->query("SELECT * FROM migrasi WHERE nama = '" . $nama . "' ");
            $total = 0;
            if (!$cekimport->hitung()) {
                include 'Schema/' . $nama . '.php';
                DB::terhubung()->input('migrasi', array('nama' => str_replace(".php", "", $nama)));
                echo "  -----Tabel \e[36m" . $nama . "\e[39m sudah diimport \n";
                $total++;
            }
            echo "\e[39mTotal \e[36m" . $total . "\e[39m tabel \e[32msudah diimport.\e[39m";
        } else {
            echo "\e[31mTabel migrasi belum ada, silahkan import semua dulu.\e[39m";
        }
    }

    public static function semua()
    {
        $cektabelmigrasi = DB::terhubung()->query("SELECT * FROM information_schema.tables WHERE table_schema = 'migrasi' LIMIT 1");
        if ($cektabelmigrasi->hitung()) {
            $dir = "Schema/";
            $befortotal1 = array();
            $no1 = 1;
            foreach (scandir($dir) as $file) {
                if ($file != "." && $file != ".." && $file != "migrasi.php") {
                    $ex = explode("_", $file);
                    if ($ex[0] != "alter") {
                        $nama = str_replace('.php', '', $file);
                        $cekimport = DB::terhubung()->query("SELECT * FROM migrasi WHERE nama = '" . $nama . "' ");
                        if (!$cekimport->hitung()) {
                            $befortotal1[] = $no1;
                            include "Schema/" . $file;
                            $setmigrasi = DB::terhubung()->input('migrasi', array('nama' => str_replace(".php", "", $file)));
                            echo "  -----Tabel \e[36m" . str_replace(".php", "", $file) . "\e[39m sudah diimport \n";
                        }
                    }
                }
            }
            $total1 = array_sum($befortotal1);
            echo "\e[39mTotal \e[36m" . $total1 . "\e[39m tabel. \e[32msudah diimport.\e[39m";
        } else {
            include 'Schema/migrasi.php';
            echo "  -----Tabel \e[36mmigrasi\e[39m sudah diimport \n";

            $dir = "Schema/";
            $befortotal = array();
            $no = 1;
            foreach (scandir($dir) as $file) {
                if ($file != "." && $file != ".." && $file != "migrasi.php") {
                    $ex = explode("_", $file);
                    if ($ex[0] != "alter") {
                        $befortotal[] = $no;
                        $nama = str_replace('.php', '', $file);
                        $cekimport = DB::terhubung()->query("SELECT * FROM migrasi WHERE nama = '" . $nama . "' ");
                        if (!$cekimport->hitung()) {
                            include "Schema/" . $file;
                            $setmigrasi = DB::terhubung()->input('migrasi', array('nama' => str_replace(".php", "", $file)));
                            echo "  -----Tabel \e[36m" . str_replace(".php", "", $file) . "\e[39m sudah diimport \n";
                        }
                    }
                }
            }
            $total = array_sum($befortotal) + 1;
            echo "\e[39mTotal \e[36m" . $total . "\e[39m tabel. \e[32msudah diimport.\e[39m";
        }
    }
}
