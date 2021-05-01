<?php

namespace AbieSoft\Sistem\Utility;

use AbieSoft\Sistem\Utility\Config;
use AbieSoft\Sistem\Auth\AuthUser;
use AbieSoft\Sistem\Magic\Reader;

class Define
{

    public function __construct()
    {

        if (Config::envReader('WEB_SSL') == true) {
            $webRoot = "https://" . Config::envReader('WEB_ID') . "/";
        } else {
            $webRoot = "http://" . Config::envReader('WEB_ID') . "/";
        }
        define("weburl", $webRoot);

        $weburi = explode("/", $_SERVER["REQUEST_URI"]);
        $page = explode("?", explode("/", $_SERVER["REQUEST_URI"] ?? "/")[1])[0];
        if (count($weburi) >= 3) {
            $subpage = $weburi[2];
        } else {
            $subpage = "";
        }
        define("page", $page);
        define("subpage", $subpage);

        $auth = new AuthUser();
        if ($auth->isLogin()) {
            if ($auth->data()->phone != null) {
                $phone = $auth->data()->phone;
            } else {
                $phone = "";
            }
            if ($auth->data()->pertanyaan == null) {
                $pertanyaan = "";
            } else {
                $pertanyaan = $auth->data()->pertanyaan;
            }
            define('getIdUser', $auth->data()->id);
            define('getNamaUser', $auth->data()->nama);
            define('getEmailUser', $auth->data()->email);
            define('getPhotoUser', $auth->data()->photo);
            define('getPhoneUser', $phone);
            define('getJawabanUser', $auth->data()->jawaban);
            define('getPertanyaanUser', $pertanyaan);
            define('getGrupIdUser', $auth->data()->grup_id);
            define('getPin', $auth->data()->pin);
            $button = Reader::button(page, $auth->data()->grup_id);
            define('btnopsi', $button);
        }
    }
}
