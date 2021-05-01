<?php

namespace AbieSoft\Sistem\Magic;

use AbieSoft\Sistem\Mysql\DB;
// use AbieSoft\Sistem\Utility\Config;


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
        //$csrf = Hash::token();
        $csrf = sha1(date('Y-m-d H:i'));
        $cek = DB::terhubung()->query("SELECT * FROM token WHERE ip = '" . $ip . "' ");
        if ($cek->hitung()) {
            DB::terhubung()->query("UPDATE token SET token = '" . $csrf . "' WHERE ip = '" . $ip . "' ");
        } else {
            DB::terhubung()->input('token', array('ip' => $ip, 'token' => $csrf));
        }
        define('CSRF', " <input type='hidden' name='_token' value='" . $csrf . "'> \n");
    }

    public static function api(string $kode): string
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
            return $token->token;
        }
    }

    public static function scanner(string $token)
    {
        $allpin = DB::terhubung()->query("SELECT pin FROM users ");
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
        $ip = self::ip();
        //$csrf = Hash::token();
        $csrf = sha1(date('Y-m-d H:i'));
        $cek = DB::terhubung()->query("SELECT * FROM token WHERE ip = '" . $ip . "' ");
        if ($cek->hitung()) {
            DB::terhubung()->query("UPDATE token SET token = '" . $csrf . "' WHERE ip = '" . $ip . "' ");
        } else {
            DB::terhubung()->input('token', array('ip' => $ip, 'token' => $csrf));
        }

        $btnlihat = "";
        $btnedit = "";
        $btndelete = "";

        $cekakses = DB::terhubung()->query("SELECT * FROM grup WHERE id = '" . getGrupIdUser . "' ");
        foreach ($cekakses->hasil() as $ca) {
            foreach (explode(",", $ca->act) as $aksesopsi) {
                if (page . '_detail' == $aksesopsi) {
                    $btnlihat = '<button type="button" class="btn btn-sm" onClick=window.location.href="' . weburl . $page . '?id={{ID}}/detail">Lihat</button>';
                }

                if (page . '_edit' == $aksesopsi) {
                    $btnedit = '<button type="button" class="btn btn-sm" onClick=window.location.href="' . weburl . $page . '?id={{ID}}/edit">Edit</button>';
                }

                if (page . '_delete' == $aksesopsi) {
                    $btndelete = '<form id="formhapus" name="formhapus" method="POST" action="' . weburl . $page . '/delete" style="float: left;" onClick="return hapus({{ID}})">    
                        <input type="hidden" value="' . $csrf . '" id="_token" name="_token">  
                        <input type="hidden" value="{{ID}}" id="id" name="id">  
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>';
                }
                // echo $opsipage . "(" . strlen($opsipage) . ")" . "---" . $aksesopsi . "(" . strlen($aksesopsi) . ")" . " " . $status . "</br>";
            }
        }





        $button = ' <div class="btn-group">
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
}
