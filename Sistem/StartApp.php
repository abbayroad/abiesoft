<?php

namespace AbieSoft\Sistem;

use AbieSoft\Sistem\Http\Route;

class StartApp extends Route
{

    public static string $RootFolder;
    public function __construct(string $rootPath)
    {
        self::$RootFolder = $rootPath;
    }

    public function start()
    {
        parent::pageAktif();
    }
}
