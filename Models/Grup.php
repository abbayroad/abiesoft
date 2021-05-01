<?php

namespace AbieSoft\Models;

use AbieSoft\Sistem\Data\Collection;

class Grup extends Collection
{

    public static function tabel()
    {
        $tabel = explode('?', explode('/', $_SERVER['REQUEST_URI'])[1])[0];
        return $tabel;
    }

    public static function all()
    {
        //return parent::get(self::tabel()); 
    }

    public static function only($id)
    {
        return parent::detail(self::tabel(), $id);
    }

    public static function post()
    {
        return parent::create(self::tabel(), null);
    }

    public static function postUpdate($id)
    {
        return parent::update(self::tabel(), $id, null);
    }

    public static function postDrop($id)
    {
        return parent::drop(self::tabel(), $id);
    }
}
