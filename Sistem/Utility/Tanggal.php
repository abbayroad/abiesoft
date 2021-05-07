<?php

namespace AbieSoft\Sistem\Utility;

class Tanggal
{

    public static function bulan($model, $val)
    {
        switch ($model) {
            case 'romawi':
                return self::romawi($val);
                break;
        }
    }


    public static function romawi($val)
    {
        if ($val == "01") {
            return "I";
        } else if ($val == "02") {
            return "II";
        } else if ($val == "03") {
            return "III";
        } else if ($val == "04") {
            return "IV";
        } else if ($val == "05") {
            return "V";
        } else if ($val == "06") {
            return "VI";
        } else if ($val == "07") {
            return "VII";
        } else if ($val == "08") {
            return "VIII";
        } else if ($val == "09") {
            return "IX";
        } else if ($val == "10") {
            return "X";
        } else if ($val == "11") {
            return "XI";
        } else {
            return "XII";
        }
    }
}
