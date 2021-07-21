<?php

namespace AbieSoft\Models;

use AbieSoft\Sistem\Data\Collection;

class User extends Collection
{

    public static function tabel()
    {
        $tabel = explode('?', explode('/', $_SERVER['REQUEST_URI'])[1])[0];
        return $tabel;
    }

    public static function all()
    {
        //return parent::get(self::tabel()); 
        echo "Ini all user";
    }

    public static function only($id)
    {
        echo "Ini only user " . $id;
        //return parent::detail(self::tabel(),$id); 
    }

    public static function postCreate()
    {
        //return parent::create(tabel: self::tabel()); 
    }

    public static function postUpdate()
    {
        //return parent::update(tabel: self::tabel(), id: $id); 
    }

    public static function postDrop($id)
    {
        //return parent::drop(tabel: self::tabel(), id: $id); 
    }
}
