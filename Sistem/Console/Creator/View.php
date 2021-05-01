<?php

namespace AbieSoft\Sistem\Console\Creator;

use AbieSoft\Sistem\Console\Command;

class View extends Command
{

    public static function create($command)
    {
        if (count($command) == 4) {
            if ($command[3] == "--default") {
                if (count(explode(".", $command[2])) == 1) {
                    mkdir("Views/" . $command[2] . "/", 0777, true);
                    $folder = explode(".", $command[2])[0];
                    self::standar($command[2]);
                } else {
                    parent::help();
                }
            } else {
                parent::help();
            }
        } else {
            if (count(explode(".", $command[2])) == 2) {
                $folder = explode(".", $command[2])[0];
                $nama = explode(".", $command[2])[1];
                if (file_exists("Views/" . $folder)) {
                    if (file_exists("Views/" . $folder . "/" . $nama . ".php")) {
                        echo "\e[39mFile \e[96m" . $command[2] . "\e[39m sudah ada, \e[39mapakah ingin menimpanya dengan yang baru? \e[93mYa [\e[39mKetik \e[96mYa\e[93m] / Tidak [\e[39mEnter\e[93m] \e[39m : ";
                        $formjawab = fopen("php://stdin", "r");
                        $jawab = trim(fgets($formjawab));
                        if ($jawab == "Ya") {
                            self::custom($folder, $nama);
                        } else {
                            echo "\e[31mdibatalkan!\e[39m";
                        }
                    } else {
                        self::custom($folder, $nama);
                    }
                } else {
                    mkdir("Views/" . $folder . "/", 0777, true);
                    self::custom($folder, $nama);
                }
            } else {
                parent::help();
            }
        }
    }

    public static function custom($folder, $nama)
    {
        if ($nama == "index") {
            $titleh4 = "list";
        } else {
            $titleh4 = $nama;
        }
        $h4 = ucfirst($titleh4) . " " . ucFirst($folder);
        $openfile = fopen("Views/" . $folder . "/" . $nama . ".php", "w") or die("Tidak dapat membuka file!");
        $isi = "<?php use AbieSoft\Sistem\Utility\Config; ?> \n";
        fwrite($openfile, $isi);
        $isi = "<section id='content'> \n";
        fwrite($openfile, $isi);
        $isi = "    <section class='vbox'> \n";
        fwrite($openfile, $isi);
        $isi = "        <section class='scrollable padder'> \n";
        fwrite($openfile, $isi);
        $isi = "            <ul class='breadcrumb no-border no-radius b-b b-light pull-in'> \n";
        fwrite($openfile, $isi);
        $isi = "                <li><a href=''><i class='fa fa-home'></i> Home</a></li> \n";
        fwrite($openfile, $isi);
        $isi = "                <li class='active'>" . ucfirst($folder) . "</li> \n";
        fwrite($openfile, $isi);
        $isi = "            </ul> \n";
        fwrite($openfile, $isi);
        $isi = "            <div class='m-b-md'> \n";
        fwrite($openfile, $isi);
        $isi = "                <h3 class='m-b-none'>" . ucfirst($folder) . "</h3> \n";
        fwrite($openfile, $isi);
        $isi = "            </div> \n";
        fwrite($openfile, $isi);
        $isi = "        </section> \n";
        fwrite($openfile, $isi);
        $isi = "    </section> \n";
        fwrite($openfile, $isi);
        $isi = "    <a href='#' class='hide nav-off-screen-block' data-toggle='class:nav-off-screen' data-target='#nav'></a> \n";
        fwrite($openfile, $isi);
        $isi = "</section> \n";
        fwrite($openfile, $isi);
        fclose($openfile);
        echo "\e[36mFile " . $nama . ".php di Folder " . $folder . " sudah dibuat.\e[39m";
    }

    public static function standar($folder)
    {

        $openfile = fopen("Views/" . $folder . "/baru.php", "w") or die("Tidak dapat membuka file!");
        $isi = "<?php use AbieSoft\Sistem\Utility\Config; ?> \n";
        fwrite($openfile, $isi);
        $isi = "<section id='content'> \n";
        fwrite($openfile, $isi);
        $isi = "    <section class='vbox'> \n";
        fwrite($openfile, $isi);
        $isi = "        <section class='scrollable padder'> \n";
        fwrite($openfile, $isi);
        $isi = "            <ul class='breadcrumb no-border no-radius b-b b-light pull-in'> \n";
        fwrite($openfile, $isi);
        $isi = "                <li><a href=''><i class='fa fa-home'></i> Home</a></li> \n";
        fwrite($openfile, $isi);
        $isi = "                <li><a href='<?php echo weburl; ?>" . $folder . "'>" . ucfirst($folder) . "</a></li> \n";
        fwrite($openfile, $isi);
        $isi = "                <li class='active'>baru</li> \n";
        fwrite($openfile, $isi);
        $isi = "            </ul> \n";
        fwrite($openfile, $isi);
        $isi = "            <div class='m-b-md'> \n";
        fwrite($openfile, $isi);
        $isi = "                <h3 class='m-b-none'>Buat " . ucfirst($folder) . " Baru</h3> \n";
        fwrite($openfile, $isi);
        $isi = "            </div> \n";
        fwrite($openfile, $isi);
        $isi = "        </section> \n";
        fwrite($openfile, $isi);
        $isi = "    </section> \n";
        fwrite($openfile, $isi);
        $isi = "    <a href='#' class='hide nav-off-screen-block' data-toggle='class:nav-off-screen' data-target='#nav'></a> \n";
        fwrite($openfile, $isi);
        $isi = "</section> \n";
        fwrite($openfile, $isi);
        fclose($openfile);

        $openfile = fopen("Views/" . $folder . "/detail.php", "w") or die("Tidak dapat membuka file!");
        $isi = "<?php use AbieSoft\Sistem\Utility\Config; ?> \n";
        fwrite($openfile, $isi);
        $isi = "<section id='content'> \n";
        fwrite($openfile, $isi);
        $isi = "    <section class='vbox'> \n";
        fwrite($openfile, $isi);
        $isi = "        <section class='scrollable padder'> \n";
        fwrite($openfile, $isi);
        $isi = "            <ul class='breadcrumb no-border no-radius b-b b-light pull-in'> \n";
        fwrite($openfile, $isi);
        $isi = "                <li><a href=''><i class='fa fa-home'></i> Home</a></li> \n";
        fwrite($openfile, $isi);
        $isi = "                <li><a href='<?php echo weburl; ?>" . $folder . "'>" . ucfirst($folder) . "</a></li> \n";
        fwrite($openfile, $isi);
        $isi = "                <li class='active'>Detail</li> \n";
        fwrite($openfile, $isi);
        $isi = "            </ul> \n";
        fwrite($openfile, $isi);
        $isi = "            <div class='m-b-md'> \n";
        fwrite($openfile, $isi);
        $isi = "                <h3 class='m-b-none'>Detail " . ucfirst($folder) . "</h3> \n";
        fwrite($openfile, $isi);
        $isi = "            </div> \n";
        fwrite($openfile, $isi);
        $isi = "        </section> \n";
        fwrite($openfile, $isi);
        $isi = "    </section> \n";
        fwrite($openfile, $isi);
        $isi = "    <a href='#' class='hide nav-off-screen-block' data-toggle='class:nav-off-screen' data-target='#nav'></a> \n";
        fwrite($openfile, $isi);
        $isi = "</section> \n";
        fwrite($openfile, $isi);
        fclose($openfile);

        $openfile = fopen("Views/" . $folder . "/edit.php", "w") or die("Tidak dapat membuka file!");
        $isi = "<?php use AbieSoft\Sistem\Utility\Config; ?> \n";
        fwrite($openfile, $isi);
        $isi = "<section id='content'> \n";
        fwrite($openfile, $isi);
        $isi = "    <section class='vbox'> \n";
        fwrite($openfile, $isi);
        $isi = "        <section class='scrollable padder'> \n";
        fwrite($openfile, $isi);
        $isi = "            <ul class='breadcrumb no-border no-radius b-b b-light pull-in'> \n";
        fwrite($openfile, $isi);
        $isi = "                <li><a href=''><i class='fa fa-home'></i> Home</a></li> \n";
        fwrite($openfile, $isi);
        $isi = "                <li><a href='<?php echo weburl; ?>" . $folder . "'>" . ucfirst($folder) . "</a></li> \n";
        fwrite($openfile, $isi);
        $isi = "                <li class='active'>Edit</li> \n";
        fwrite($openfile, $isi);
        $isi = "            </ul> \n";
        fwrite($openfile, $isi);
        $isi = "            <div class='m-b-md'> \n";
        fwrite($openfile, $isi);
        $isi = "                <h3 class='m-b-none'>Edit " . ucfirst($folder) . "</h3> \n";
        fwrite($openfile, $isi);
        $isi = "            </div> \n";
        fwrite($openfile, $isi);
        $isi = "        </section> \n";
        fwrite($openfile, $isi);
        $isi = "    </section> \n";
        fwrite($openfile, $isi);
        $isi = "    <a href='#' class='hide nav-off-screen-block' data-toggle='class:nav-off-screen' data-target='#nav'></a> \n";
        fwrite($openfile, $isi);
        $isi = "</section> \n";
        fwrite($openfile, $isi);
        fclose($openfile);

        $openfile = fopen("Views/" . $folder . "/index.php", "w") or die("Tidak dapat membuka file!");
        $isi = "<?php use AbieSoft\Sistem\Utility\Config; ?> \n";
        fwrite($openfile, $isi);
        $isi = "<section id='content'> \n";
        fwrite($openfile, $isi);
        $isi = "    <section class='vbox'> \n";
        fwrite($openfile, $isi);
        $isi = "        <section class='scrollable padder'> \n";
        fwrite($openfile, $isi);
        $isi = "            <ul class='breadcrumb no-border no-radius b-b b-light pull-in'> \n";
        fwrite($openfile, $isi);
        $isi = "                <li><a href=''><i class='fa fa-home'></i> Home</a></li> \n";
        fwrite($openfile, $isi);
        $isi = "                <li class='active'>" . ucfirst($folder) . "</li> \n";
        fwrite($openfile, $isi);
        $isi = "            </ul> \n";
        fwrite($openfile, $isi);
        $isi = "            <div class='m-b-md'> \n";
        fwrite($openfile, $isi);
        $isi = "                <h3 class='m-b-none'>" . ucfirst($folder) . "</h3> \n";
        fwrite($openfile, $isi);
        $isi = "            </div> \n";
        fwrite($openfile, $isi);
        $isi = "        </section> \n";
        fwrite($openfile, $isi);
        $isi = "    </section> \n";
        fwrite($openfile, $isi);
        $isi = "    <a href='#' class='hide nav-off-screen-block' data-toggle='class:nav-off-screen' data-target='#nav'></a> \n";
        fwrite($openfile, $isi);
        $isi = "</section> \n";
        fwrite($openfile, $isi);
        fclose($openfile);

        echo "\e[36mFile standar untuk sebuah halaman " . $folder . " sudah dibuat.\e[39m";
    }
}
