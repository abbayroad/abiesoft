<?php

namespace AbieSoft\Sistem\Console\Creator;

use AbieSoft\Sistem\Console\Command;

class Controller extends Command
{

    public static function create($command)
    {
        if (count($command) == 4) {
            if ($command[3] != "--default") {
                parent::help();
            } else {
                if (file_exists("Controllers/" . $command[2] . ".php")) {
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
                if (file_exists("Controllers/" . $command[2] . ".php")) {
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
        $createController = fopen("Controllers/" . $command[2] . ".php", "w") or die("Tidak dapat membuka file!");
        $isiDefault = "<?php \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "namespace AbieSoft\Controllers; \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "use AbieSoft\Sistem\Http\Route;\n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "class " . $command[2] . "{ \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "     // " . $command[2] . " \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "}";
        fwrite($createController, $isiDefault);
        fclose($createController);
        echo "\e[96m" . $command[2] . " sudah dibuat. lokasi filenya di Controllers/" . $command[2] . "\e[39m";
    }

    public static function standar($command)
    {
        $createController = fopen("Controllers/" . $command[2] . ".php", "w") or die("Tidak dapat membuka file!");
        $isiDefault = "<?php \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "namespace AbieSoft\Controllers; \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "use AbieSoft\Sistem\Http\Route;\n";
        fwrite($createController, $isiDefault);
        $isiDefault = "//use AbieSoft\Sistem\Utility\Input;\n";
        fwrite($createController, $isiDefault);
        $isiDefault = "//use AbieSoft\Models\\" . ucfirst(strtolower(str_replace('Controller', '', $command[2]))) . "; \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "class " . $command[2] . " extends Route{ \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    public function index(){ \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        // menampilkan file index.php yang ada di folder view/" . strtolower(str_replace('Controller', '', $command[2])) . " \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        $" . "" . "data1 = ''; \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        $" . "" . "data2 = ''; \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        // dan seterusnya isi data bisa berupa string atau berupa array \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        // dan untuk memanggil datanya di file view bisa menggunakan variabel $" . "" . "data  \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        return parent::view(view: '" . strtolower(str_replace('Controller', '', $command[2])) . ".index', data: ['data1' => $" . "" . "data1, 'data2' => $" . "" . "data2]); \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    } \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    public function loaddata(){ \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        // Load data untuk menampilkan data json yang digunakan untuk tabel index  \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    } \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    public function baru(){ \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        // return parent::view(view: '" . strtolower(str_replace('Controller', '', $command[2])) . ".baru'); \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    } \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    public function edit(int $" . "" . "id){ \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        // return parent::view(view: '" . strtolower(str_replace('Controller', '', $command[2])) . ".edit'); \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    } \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    public function detail(int $" . "" . "id){ \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        // return parent::view(view: '" . strtolower(str_replace('Controller', '', $command[2])) . ".detail'); \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    } \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    public function create(){ \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        // return " . ucfirst(strtolower(str_replace('Controller', '', $command[2]))) . "::post(); \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    } \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    public function update(){ \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        // $" . "" . "id = Input::get('id'); \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        // return " . ucfirst(strtolower(str_replace('Controller', '', $command[2]))) . "::postUpdate($" . "" . "id); \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    } \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    public function delete(){ \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        // $" . "" . "id = Input::get('id'); \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "        // return " . ucfirst(strtolower(str_replace('Controller', '', $command[2]))) . "::postDrop($" . "" . "id); \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "    } \n \n";
        fwrite($createController, $isiDefault);
        $isiDefault = "}";
        fwrite($createController, $isiDefault);
        fclose($createController);
        echo "\e[96m" . $command[2] . " sudah dibuat. lokasi filenya di controllers/" . $command[2] . "\e[39m";
    }
}
