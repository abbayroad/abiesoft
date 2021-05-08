<?php

namespace AbieSoft\Sistem\Utility;

use DateTime;

class Tanggal
{

    ///// Bulan
    public static function bulan(string $model, string $val): string
    {
        switch ($model) {
            case 'text':
                return self::text($val);
                break;
            case 'romawi':
                return self::romawi($val);
                break;
        }
    }

    public static function text(string $val): string
    {
        if ($val == "01") {
            return "Januari";
        } else if ($val == "02") {
            return "Februari";
        } else if ($val == "03") {
            return "Maret";
        } else if ($val == "04") {
            return "April";
        } else if ($val == "05") {
            return "Mei";
        } else if ($val == "06") {
            return "Juni";
        } else if ($val == "07") {
            return "Juli";
        } else if ($val == "08") {
            return "Agustus";
        } else if ($val == "09") {
            return "September";
        } else if ($val == "10") {
            return "Oktober";
        } else if ($val == "11") {
            return "November";
        } else {
            return "Desember";
        }
    }

    public static function romawi(string $val): string
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



    ///// DateTime (DT)
    public static function dt(string $model, string $val): string
    {
        switch ($model) {
            case 'jam':
                return self::jam($val);
                break;
            case 'hari':
                return self::hari($val);
                break;
            case 'text':
                return self::text(explode("-", explode(" ", $val)[0])[1]);
                break;
            case 'romawi':
                return self::romawi(explode("-", explode(" ", $val)[0])[1]);
                break;
            case 'tahun':
                return self::tahun($val);
                break;
            case 'tglfull':
                return self::tglfull($val);
                break;
            case 'tgledit':
                return self::tgledit($val);
                break;
            case 'tgleditlocal':
                return self::tgleditlocal($val);
                break;
        }
    }

    public static function jam(string $val): string
    {
        $valjam = explode(" ", $val)[1];
        $jarumjam = explode(":", $valjam)[0];
        $jarummenit = explode(":", $valjam)[1];
        $jam = $jarumjam . ":" . $jarummenit;
        return $jam;
    }

    public static function hari(string $val): string
    {
        $datahari = new DateTime($val);
        if ($datahari->format('N') == 1) {
            $hari = "Senin";
        } else if ($datahari->format('N') == 2) {
            $hari = "Selasa";
        } else if ($datahari->format('N') == 3) {
            $hari = "Rabu";
        } else if ($datahari->format('N') == 4) {
            $hari = "Kamis";
        } else if ($datahari->format('N') == 5) {
            $hari = "Jum'at";
        } else if ($datahari->format('N') == 6) {
            $hari = "Sabtu";
        } else {
            $hari = "Minggu";
        }
        return $hari;
    }

    public static function tahun(string $val): string
    {
        return explode("-", explode(" ", $val)[0])[0];
    }

    public static function tglfull(string $val): string
    {
        $tanggalformat = explode(" ", $val)[0];
        $tgl = ltrim(explode("-", $tanggalformat)[2], 0);
        $bln = explode("-", $tanggalformat)[1];
        $thn = explode("-", $tanggalformat)[0];
        $tanggal = $tgl . " " . self::text($bln) . " " . $thn;
        return $tanggal;
    }

    public static function tgledit(string $val): string
    {
        return explode(" ", $val)[0];
    }

    public static function tgleditlocal(string $val): string
    {
        $formattgl = explode(" ", $val)[0];
        $formatjam = explode(" ", $val)[1];
        $localtimetype = $formattgl . "T" . $formatjam;
        return $localtimetype;
    }
}
