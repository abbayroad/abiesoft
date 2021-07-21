<?php

namespace AbieSoft\Sistem\Auth\Controller;

use AbieSoft\Sistem\Http\Route;
use AbieSoft\Sistem\Magic\Reader;
use AbieSoft\Sistem\Utility\Input;

use AbieSoft\Models\User;

class WebserviceController extends Route
{

    public function index()
    {
        $apikey = Input::get('key');
        if (Reader::api($apikey)) {
            if ($_POST) {
                return self::postApi();
            } else {
                $get = Input::get('get');
                $tabel = Input::get('data');
                if ($get == "only") {
                    $id = Input::get('id');
                    if ($id) {
                        return self::only($tabel, $id);
                    } else {
                        return self::errorApi(1);
                    }
                } else {
                    return self::all($tabel);
                }
            }
        } else {
            self::errorApi(0);
        }
    }

    public static function errorApi(int $kode)
    {
        if ($kode == 1) {
            $list = array();
            $data = new WebserviceController();
            $data->kode = 1;
            $data->keterangan = "Method ini membutuhkan ID untuk bisa dijalankan";
            $list[] = $data;
            echo json_encode($list);
        } else {
            $list = array();
            $data = new WebserviceController();
            $data->kode = 0;
            $data->keterangan = "Apikey Tidak Valid";
            $list[] = $data;
            echo json_encode($list);
        }
    }

    public static function postApi()
    {
        echo "POST";
    }

    public static function all(string $tabel)
    {
        if ($tabel == "user") {
            $return = User::all();
        }

        return $return;
    }

    public static function only(string $tabel, int $id)
    {
        if ($tabel == "user") {
            $return = User::only($id);
        }

        return $return;
    }
}
