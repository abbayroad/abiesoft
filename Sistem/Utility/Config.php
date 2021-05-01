<?php

namespace AbieSoft\Sistem\Utility;

class Config {

    public static function envReader($envRequest = null){
        $env = parse_ini_file(__DIR__."/../../.env");
        return $env[$envRequest];
    }

}