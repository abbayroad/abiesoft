<?php

namespace AbieSoft\Models;

use AbieSoft\Sistem\Data\Collection;

class Users extends Collection
{

      public static function tabel()
      {
            $tabel = explode('?', explode('/', $_SERVER['REQUEST_URI'])[1])[0];
            return $tabel;
      }

      public static function only($id)
      {
            return parent::detail(self::tabel(), $id);
      }

      public static function postDrop($id)
      {
            return parent::drop(self::tabel(), $id);
      }
}
