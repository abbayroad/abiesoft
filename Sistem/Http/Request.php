<?php

namespace AbieSoft\Sistem\Http;

use AbieSoft\Sistem\Auth\AuthUser;

class Request
{

    public static function getPath(): string
    {
        $path = $_SERVER["REQUEST_URI"] ?? "/";
        $path = str_replace("'", "", $path);
        if ($path == "/") {
            $path = $path;
        } else {
            if (substr($path, -1) == "/") {
                $path = substr($path, 0, -1);
            }
        }
        return $path;
    }

    public static function getMethod(): string
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public static function getPosisi(string $path): string
    {
        $posisi = strpos($path, "?");
        if ($posisi === false) {
            return $path;
        }
        $path = substr($path, 0, $posisi);
        return $path;
    }

    public static function getSession(string $path): string
    {
        $auth = new AuthUser;
        if (
            $path == "/login"
            or $path == "/konfirmasi"
            or $path == "/reset"
            or $path == "/webservice"
        ) {
            if ($auth->isLogin()) {
                return "index";
            } else {
                return $path;
            }
        } else {
            if (!$auth->isLogin()) {
                return "secure";
            } else {
                return $path;
            }
        }
    }
}
