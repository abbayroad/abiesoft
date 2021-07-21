<?php

namespace AbieSoft\Sistem\Magic;

use AbieSoft\Sistem\Mysql\DB;
use AbieSoft\Sistem\Utility\Tanggal;
use AbieSoft\Sistem\Utility\Hash;
use AbieSoft\Sistem\Magic\Form;


class Reader
{


    public static function ip(): string
    {
        $ip = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ip = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ip = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = 'Ip Tidak Dikenali';
        return $ip;
    }

    public static function perangkat(): string
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    public static function acak()
    {
        $ip = self::ip();
        $csrf = Hash::token();
        $cek = DB::terhubung()->query("SELECT * FROM token WHERE ip = '" . $ip . "' ");
        if ($cek->hitung()) {
            DB::terhubung()->query("UPDATE token SET generate_token = '" . $csrf . "' WHERE ip = '" . $ip . "' ");
        } else {
            DB::terhubung()->input('token', array('ip' => $ip, 'generate_token' => $csrf));
        }
        define('CSRF', " <input type='hidden' name='_token' value='" . $csrf . "'> \n");
    }

    public static function generate_api(): bool
    {
        $create = DB::terhubung()->input("api", array('apikey' => Hash::unique()));
        if ($create) {
            return true;
        }
        return false;
    }

    public static function api(string $kode): bool
    {
        $cek = DB::terhubung()->query("SELECT * FROM api WHERE apikey = '" . $kode . "' ");
        if ($cek->hitung()) {
            return true;
        }
        return false;
    }

    public static function token(): string
    {
        $ip = self::ip();
        $sesitoken = DB::terhubung()->query("SELECT * FROM token WHERE ip = '" . $ip . "' ");
        foreach ($sesitoken->hasil() as $token) {
            return $token->generate_token;
        }
    }

    public static function scanner(string $token): bool
    {
        $allpin = DB::terhubung()->query("SELECT id, pin FROM users");
        foreach ($allpin->hasil() as $user) {
            if ($token == sha1(self::token() . $user->pin)) {
                return true;
            }
        }
        return false;
    }

    public static function validasi(string $file, string $tabel, string $txt)
    {
        $folder = "asset/jsa/" . $tabel;
        if (file_exists($folder)) {
            $createView = fopen($folder . '/' . $file . '.js', "w") or die("Tidak dapat membuka file!");
            $isiDefault = $txt;
            fwrite($createView, $isiDefault);
            fclose($createView);
        } else {
            mkdir($folder, 0777, true);
            $createView = fopen($folder . '/' . $file . '.js', "w") or die("Tidak dapat membuka file!");
            $isiDefault = $txt;
            fwrite($createView, $isiDefault);
            fclose($createView);
        }
    }

    public static function select(string $tabel, string $placeholder, array $array): string
    {
        $option = "";
        $option .= "<option value=''>" . $placeholder . "</option>";
        if (is_array($array)) {
            $kolval = "";
            $dop = "";
            $jumlahdataarray = count($array);
            $nourut = 1;
            foreach ($array as $kol => $val) {
                if (count(explode("!", $kol)) == 2) {
                    if ($nourut == $jumlahdataarray) {
                        $kolval .= explode("!", $kol)[1] . " != '" . $val . "'";
                    } else {
                        $kolval .= explode("!", $kol)[1] . " != '" . $val . "' AND ";
                    }
                } else {
                    if ($nourut == $jumlahdataarray) {
                        $kolval .= $kol . " = '" . $val . "'";
                    } else {
                        $kolval .= $kol . " = '" . $val . "' AND ";
                    }
                }
                $nourut++;
            }

            $data = DB::terhubung()->query("SELECT * FROM " . $tabel . " WHERE " . $kolval . " ");
            foreach ($data->hasil() as $d) {
                $dop .= "<option value='" . $d->id . "'>" . $d->nama . "</option>";
            }
            $option .= $dop;
        } else {
            $dop = "";
            $data = DB::terhubung()->query("SELECT * FROM " . $tabel . " ");
            foreach ($data->hasil() as $d) {
                $dop .= "<option value='" . $d->id . "'>" . $d->nama . "</option>";
            }
            $option .= $dop;
        }
        return $option;
    }


    public static function radio(string $tabel, string $placeholder, array $array): string
    {
        if (is_array($array)) {
            $kolval = "";
            $dop = "";
            $jumlahdataarray = count($array);
            $nourut = 1;
            foreach ($array as $kol => $val) {
                if (count(explode("!", $kol)) == 2) {
                    if ($nourut == $jumlahdataarray) {
                        $kolval .= explode("!", $kol)[1] . " != '" . $val . "'";
                    } else {
                        $kolval .= explode("!", $kol)[1] . " != '" . $val . "' AND ";
                    }
                } else {
                    if ($nourut == $jumlahdataarray) {
                        $kolval .= $kol . " = '" . $val . "'";
                    } else {
                        $kolval .= $kol . " = '" . $val . "' AND ";
                    }
                }
                $nourut++;
            }

            $data = DB::terhubung()->query("SELECT * FROM " . $tabel . " WHERE " . $kolval . " ");
            foreach ($data->hasil() as $d) {
                $dop .= "<div class='radio-block'><input class='radio' type='radio' id='" . $d->id . "' name='" . $tabel . "' value='" . $d->id . "'><label for='" . $d->id . "' class='radio'>" . $d->nama . "</label><div class='endflo'></div></div>";
            }
            $option = $dop;
        } else {
            $dop = "";
            $data = DB::terhubung()->query("SELECT * FROM " . $tabel . " ");
            foreach ($data->hasil() as $d) {
                $dop .= "<div class='radio-block'><input class='radio' type='radio' id='" . $d->id . "' name='" . $tabel . "' value='" . $d->id . "'><label for='" . $d->id . "' class='radio'>" . $d->nama . "</label><div class='endflo'></div></div>";
            }
            $option = $dop;
        }
        return $option;
    }

    public static function checkbox(string $tabel, string $placeholder, array $array)
    {
        if (is_array($array)) {
            $kolval = "";
            $dop = "";
            $jumlahdataarray = count($array);
            $nourut = 1;
            foreach ($array as $kol => $val) {
                if (count(explode("!", $kol)) == 2) {
                    if ($nourut == $jumlahdataarray) {
                        $kolval .= explode("!", $kol)[1] . " != '" . $val . "'";
                    } else {
                        $kolval .= explode("!", $kol)[1] . " != '" . $val . "' AND ";
                    }
                } else {
                    if ($nourut == $jumlahdataarray) {
                        $kolval .= $kol . " = '" . $val . "'";
                    } else {
                        $kolval .= $kol . " = '" . $val . "' AND ";
                    }
                }
                $nourut++;
            }

            $data = DB::terhubung()->query("SELECT * FROM " . $tabel . " WHERE " . $kolval . " ");
            foreach ($data->hasil() as $d) {
                $dop .= "<div class='radio-block'><input class='radio' type='checkbox' id='" . $d->id . "' name='" . $tabel . "' value='" . $d->id . "'><label for='" . $d->id . "' class='radio'>" . $d->nama . "</label><div class='endflo'></div></div>";
            }
            $option = $dop;
        } else {
            $dop = "";
            $data = DB::terhubung()->query("SELECT * FROM " . $tabel . " ");
            foreach ($data->hasil() as $d) {
                $dop .= "<div class='radio-block'><input class='radio' type='checkbox' id='" . $d->id . "' name='" . $tabel . "' value='" . $d->id . "'><label for='" . $d->id . "' class='radio'>" . $d->nama . "</label><div class='endflo'></div></div>";
            }
            $option = $dop;
        }
        return $option;
    }

    public static function data(string $tabel, string $kolom, int $id)
    {
        $cek = DB::terhubung()->query("SELECT * FROM " . $tabel . " WHERE id = '" . $id . "'  ");
        if ($cek->hitung()) {
            foreach ($cek->hasil() as $h) {
                return $h->$kolom;
            }
        } else {
            return "NULL";
        }
    }

    public static function button(string $page, int $grupid)
    {
        $csrf = "";
        $btnlihat = "";
        $btnedit = "";
        $btndelete = "";

        $cekakses = DB::terhubung()->query("SELECT * FROM grup WHERE id = '" . getGrupIdUser . "' ");
        foreach ($cekakses->hasil() as $ca) {
            foreach (explode(",", $ca->act) as $aksesopsi) {
                if (page . '_detail' == $aksesopsi) {
                    $btnlihat = '<button onClick=window.location.href="' . weburl . $page . '?id={{ID}}/detail"><span class="las la-eye"></span><span class="label-opsi">Lihat</span></button>';
                }

                if (page . '_edit' == $aksesopsi) {
                    $btnedit = '<button onClick=window.location.href="' . weburl . $page . '?id={{ID}}/edit"><span class="las la-edit"></span><span class="label-opsi">Edit</span></button>';
                }

                if (page . '_delete' == $aksesopsi) {
                    $btndelete = Form::delete($page);
                }
            }
        }





        $button = ' <div class="opsi-tabel">
                        ' . $btnlihat . '
                        ' . $btnedit . '
                        ' . $btndelete . '
                    </div>';

        return $button;
    }

    public static function menu(string $menu): string
    {
        $status = "ditolak";
        $cekmenu = DB::terhubung()->query("SELECT * FROM grup WHERE id = '" . getGrupIdUser . "' ");
        foreach ($cekmenu->hasil() as $mn) {
            foreach (explode(",", $mn->menu) as $aksesmenu) {
                if ($menu == $aksesmenu) {
                    $status = "diijinkan";
                    return $status;
                }
            }
        }
        return $status;
    }

    public static function tanggal(string $part, string $model, string $val): string
    {
        switch ($part) {
            case 'bulan':
                return Tanggal::bulan($model, $val);
                break;

            case 'dt':
                return Tanggal::dt($model, $val);
                break;
        }
    }

    public static function numbering(string $text): string
    {
        $textjadi = "";
        if (count(explode(",", $text)) == 1) {
            $textjadi = $text;
        } else {
            $total = count(explode(",", $text));
            for ($i = 0; $i < $total; $i++) {
                $no = $i + 1;
                $textjadi .= "<div>
                                <div style='float: left; width: 20px;'>" . $no . "</div>
                                <div style='float: left;'>" . explode(",", $text)[$i] . "</div>
                                <div style='clear: both;'></div>
                                <div style='margin-top: 5px;'></div>
                              </div>";
            }
        }
        return $textjadi;
    }
}
