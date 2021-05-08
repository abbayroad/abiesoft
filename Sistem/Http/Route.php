<?php

namespace AbieSoft\Sistem\Http;

use AbieSoft\Sistem\StartApp;
use AbieSoft\Sistem\Http\Request;
use AbieSoft\Sistem\Http\Lanjut;
use AbieSoft\Sistem\Magic\Reader;
use AbieSoft\Sistem\Auth\AuthUser;
use AbieSoft\Sistem\Utility\Input;
use AbieSoft\Sistem\Mysql\DB;

class Route
{

    protected static array $routes = [];

    public static function get(string $path, string|array $callback)
    {
        self::$routes['get'][$path] = $callback;
    }

    public static function post(string $path, string|array $callback)
    {
        self::$routes['post'][$path] = $callback;
    }

    public static function grup(string $path, string $controller)
    {
        Route::get('/' . $path, [$controller, 'index']);
        Route::get('/' . $path . '/baru', [$controller, 'baru']);
        Route::get('/' . $path . '/detail', [$controller, 'detail']);
        Route::get('/' . $path . '/edit', [$controller, 'edit']);
        Route::get('/' . $path . '/data', [$controller, 'loaddata']);
        Route::get('/' . $path . '/konfirmasi', [$controller, 'konfirmasi']);
        Route::post('/' . $path . '/create', [$controller, 'create']);
        Route::post('/' . $path . '/update', [$controller, 'update']);
        Route::post('/' . $path . '/delete', [$controller, 'delete']);
    }

    public static function perijinan(string $page, string $opsi)
    {
        $status = "ditolak";
        $auth = new AuthUser;
        if ($auth->isLogin()) {

            if ($opsi != "") {
                $opsipage = $page . '_' . $opsi;
                $cekakses = DB::terhubung()->query("SELECT * FROM grup WHERE id = '" . getGrupIdUser . "' ");
                foreach ($cekakses->hasil() as $ca) {
                    foreach (explode(",", $ca->act) as $aksesopsi) {
                        if ($opsipage == $aksesopsi) {
                            $status = "diijinkan";
                            return $status;
                        }
                        // echo $opsipage . "(" . strlen($opsipage) . ")" . "---" . $aksesopsi . "(" . strlen($aksesopsi) . ")" . " " . $status . "</br>";
                    }
                }
            } else {
                $cekakses = DB::terhubung()->query("SELECT * FROM grup WHERE id = '" . getGrupIdUser . "' ");
                foreach ($cekakses->hasil() as $ca) {
                    foreach (explode(",", $ca->akses) as $aksespage) {
                        if ($page == $aksespage) {
                            $status = "diijinkan";
                            return $status;
                        }
                    }
                }
            }
            return $status;
        }
    }

    public function pageAktif()
    {
        $path = Request::getPath();
        $posisi = Request::getPosisi($path);
        $akses = Request::getSession($posisi);
        $method = Request::getMethod();
        $callback = self::$routes[$method][$posisi] ?? false;

        if ($akses == "index") {
            Lanjut::ke('/');
        } else if ($akses == "secure") {
            Lanjut::ke('/login');
        }

        if ($callback === false) {
            return self::view('error.404');
        }

        if (is_string($callback)) {
            return self::view($callback);
        }

        if (is_array($callback)) {
            $func = new $callback[0]();
            $act = $callback[1];

            ////////----Cek Url Model
            if (count(explode("/", $path)) == 3) {
                $page = explode("/", $posisi)[1];
                $opsi = explode("/", $path)[2];
            } else if (count(explode("/", $path)) == 2) {
                $page = explode("/", $posisi)[1];
                $opsi = "";
            } else {
                $page = "";
                $opsi = "";
            }


            if (self::perijinan($page, $opsi) == "ditolak") {
                Lanjut::ke('/');
            }

            // echo self::perijinan($page, $opsi);
            // die();

            ////////----Cek Method
            if ($method == "post") {
                $auth = new AuthUser;
                if ($auth->isLogin()) {

                    $token = Input::get('_token');
                    if (Reader::scanner(sha1($token . getPin))) {
                        if ($opsi == "update" or $opsi == "delete") {
                            if (Input::get('id')) {
                                $id = filter_var(Input::get('id'), FILTER_SANITIZE_NUMBER_INT);
                                if ($id != "") {
                                    return $func->$opsi($id);
                                } else {
                                    Lanjut::ke("/" . $page);
                                }
                            } else {
                                Lanjut::ke("/" . $page);
                            }
                        } else {
                            return $func->$act();
                        }
                    } else {
                        echo "Token Expire";
                        die();
                    }
                } else {
                    return $func->$act();
                }
            } else {

                if ($opsi == "edit" or $opsi == "detail" or $opsi == "konfirmasi") {
                    if (isset($_GET['id'])) {
                        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
                        if ($id != "") {
                            return $func->$opsi($id);
                        } else {
                            Lanjut::ke("/" . $page);
                        }
                    } else {
                        Lanjut::ke("/" . $page);
                    }
                } else {
                    if ($opsi == "create" or $opsi == "update" or $opsi == "delete") {
                        Lanjut::ke("/" . $page);
                    } else {
                        return $func->$act();
                    }
                }
            }
        }

        echo call_user_func($callback);
    }

    public static function view(string $view, $data = null)
    {
        $layout = self::layoutRender();
        $css = self::cssRender();
        $top = self::topRender();
        $side = self::sideRender();
        $konten = self::kontenRender($view, $data);
        $js = self::jsRender();
        $jsa = self::jsaRender($view);
        $setcss = str_replace("{{CSS}}", $css, $layout);
        $settop = str_replace("{{Top}}", $top, $setcss);
        $setside = str_replace("{{Side}}", $side, $settop);
        $setkonten = str_replace("{{Konten}}", $konten, $setside);
        $setjs = str_replace("{{JS}}", $js, $setkonten);
        $launcher = str_replace("{{JSA}}", $jsa, $setjs);
        echo $launcher;
    }

    public static function layoutRender(): string
    {
        ob_start();
        include_once StartApp::$RootFolder . "/Views/layout/launcher.php";
        return ob_get_clean();
    }

    public static function cssRender(): string
    {
        ob_start();
        $result = "";

        // $dir = "assets/css/";
        // $cdir = scandir($dir);
        // foreach ($cdir as $key => $value){
        //     if (!in_array($value,array(".",".."))){
        //         if (is_dir($dir . DIRECTORY_SEPARATOR . $value)){
        //             $result[$value] .= $dir . DIRECTORY_SEPARATOR . $value;
        //         }else{
        //             $result .= "<link rel='stylesheet' href='assets/css/".$value."'> \n";
        //         }
        //     }
        // }
        $result .= "<link rel='stylesheet' href='" . weburl . "asset/css/bootstrap.css'> \n";
        $result .= "<link rel='stylesheet' href='" . weburl . "asset/css/animate.css'> \n";
        $result .= "<link rel='stylesheet' href='" . weburl . "asset/css/font-awesome.min.css'> \n";
        $result .= "<link rel='stylesheet' href='" . weburl . "asset/css/font.css'> \n";
        $result .= "<link rel='stylesheet' href='" . weburl . "asset/js/datatables/datatables.css'> \n";
        $result .= "<link rel='stylesheet' href='" . weburl . "asset/css/app.css'> \n";
        return $result . " " . ob_get_clean();
    }

    public static function topRender(): string
    {
        ob_start();
        include_once StartApp::$RootFolder . "/Views/layout/top.php";
        return ob_get_clean();
    }

    public static function sideRender(): string
    {
        ob_start();
        include_once StartApp::$RootFolder . "/Views/layout/side.php";
        return ob_get_clean();
    }

    public static function kontenRender(string $view, $data = null)
    {
        ob_start();
        if (count(explode(".", $view)) == 2) {
            $file = StartApp::$RootFolder . "/views/" . explode(".", $view)[0] . "/" . explode(".", $view)[1] . ".php";
        } else {
            $file = StartApp::$RootFolder . "/views/" . explode(".", $view)[0] . ".php";
        }
        if (file_exists($file)) {
            include_once $file;
        } else {
            return $view;
        }
        return ob_get_clean();
    }

    public static function jsRender(): string
    {
        ob_start();
        $result = "";
        $result .= "<script src='" . weburl . "asset/js/jquery.min.js'></script> \n    ";
        $result .= "<script src='" . weburl . "asset/js/bootstrap.js'></script> \n    ";
        $result .= "<script src='" . weburl . "asset/js/app.js'></script> \n    ";
        $result .= "<script src='" . weburl . "asset/js/app.plugin.js'></script> \n    ";
        $result .= "<script src='" . weburl . "asset/js/slimscroll/jquery.slimscroll.min.js'></script> \n    ";
        $result .= "<script src='" . weburl . "asset/js/datatables/jquery.dataTables.min.js'></script> \n    ";
        return $result . "" . ob_get_clean();
    }

    public static function jsaRender(string $view): string
    {
        ob_start();
        ///File JSA yang akan tampil di index
        // if($view == "index"){
        //     if(file_exists("asset/jsa/".$view.".abbay")){
        //        include_once "asset/jsa/".$view.".abbay";
        //     }
        //     include_once "asset/jsa/realtime.abbay";
        // }

        ///File JSA yang akan tampil di page tertentu
        // if(file_exists("asset/jsa/".str_replace(".","/",$view).".abbay")){
        //     include_once "asset/jsa/".str_replace(".","/",$view).".abbay";
        // }

        return ob_get_clean();
    }
}
