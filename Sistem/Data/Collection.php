<?php

namespace AbieSoft\Sistem\Data;

use AbieSoft\Sistem\Mysql\DB;
use AbieSoft\Sistem\Utility\Input;
use AbieSoft\Sistem\Utility\Config;
use AbieSoft\Sistem\Http\Lanjut;
use AbieSoft\Sistem\Magic\Reader;

class Collection
{

    public static function get(string $tabel = null): array
    {
        $datatabel = DB::terhubung()->query("SELECT * FROM {$tabel} ")->hasil();
        return $datatabel;
    }

    public static function detail(string $tabel = null, int $id = null): array
    {
        $cekrequest = DB::terhubung()->query("SELECT * FROM {$tabel} WHERE id = '{$id}' ");
        if ($cekrequest->hitung()) {
            return $cekrequest->hasil();
        } else {
            Lanjut::ke("/" . $tabel);
        }
    }

    public static function create(string $tabel = null, string $akses = null)
    {

        if ($_FILES) {

            $jumlah = 0;
            $gnfile = "";
            foreach ($_FILES as $filedata) {

                if ($filedata['type'] == "image/jpeg") {
                    $dirupload = "asset/storage/photo/";
                }

                if ($filedata['type'] == "application/pdf") {
                    $dirupload = "asset/storage/pdf/";
                }

                $tempname = $filedata['tmp_name'];
                $namafile = date("d") . date("m") . date("Y") . date("H") . date("i") . date("s") . "_" . $filedata['name'];
                $gnfile .= date('d') . date('m') . date('Y') . date('H') . date('i') . date('s') . "_" . $filedata['name'] . ",";
                $target_file = $dirupload . $namafile;
                $simpanfile = move_uploaded_file($tempname, $target_file);
                if ($simpanfile) {
                    $jumlah++;
                }
            }

            if (count($_FILES) == $jumlah) {

                $namadatabase = Config::envReader('DB_NAME');
                $kolom = DB::terhubung()->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$namadatabase}' AND TABLE_NAME = '{$tabel}' ");
                foreach ($kolom->hasil() as $outer_key => $array) {
                    foreach ($array as $inner_key => $value) {
                        if ($akses != null) {
                            $fieldakses = explode(",", $akses);
                            foreach ($fieldakses as $fa) {
                                if ($fa == $value) {
                                    $akseskolomtabel[] = $value;
                                }
                            }
                        } else {
                            if ($value != "id" and $value != "dibuat" and $value != "diupdate") {
                                $akseskolomtabel[] = $value;
                            }
                        }
                    }
                }

                $datapost = array();

                foreach ($akseskolomtabel as $kolomyangdiijinkan) {
                    foreach ($_POST as $input_key => $input_value) {
                        if ($kolomyangdiijinkan == $input_key) {
                            $datapost[] = $input_value;
                        }
                    }
                }

                $jumlahstring = strlen($gnfile) - 1;
                $gnfile = substr($gnfile, 0, $jumlahstring);
                foreach (explode(",", $gnfile) as $nafile) {
                    array_push($datapost, $nafile);
                }

                foreach (explode(",", $akses) as $ak) {
                    if (substr($ak, 0, 1) == "!") {
                        array_push($akseskolomtabel, str_replace("!", "", $ak));
                    }
                }

                // $akseskolomtabel[] = "oleh";
                // $datapost[] = getIdUser;

                $datakolom = $akseskolomtabel;
                $datavalue = $datapost;
                $dataArray = array_combine($datakolom, $datavalue);

                $input = DB::terhubung()->input($tabel, $dataArray);
                if ($input) {
                    echo "Y";
                } else {
                    echo "Gagal menambahkan data " . $tabel;
                }
            } else {
                echo "Upload file Gagal";
            }
        } else {
            $namadatabase = Config::envReader('DB_NAME');
            $kolom = DB::terhubung()->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$namadatabase}' AND TABLE_NAME = '{$tabel}' ");
            foreach ($kolom->hasil() as $outer_key => $array) {
                foreach ($array as $inner_key => $value) {
                    if ($akses != null) {
                        $fieldakses = explode(",", $akses);
                        foreach ($fieldakses as $fa) {
                            if ($fa == $value and Input::get($value) != "") {
                                $akseskolomtabel[] = $value;
                            }
                        }
                    } else {
                        if ($value != "id" and $value != "dibuat" and $value != "diupdate") {
                            $akseskolomtabel[] = $value;
                        }
                    }
                }
            }

            $datapost = array();

            foreach ($akseskolomtabel as $kolomyangdiijinkan) {
                foreach ($_POST as $input_key => $input_value) {
                    if ($kolomyangdiijinkan == $input_key) {
                        $datapost[] = $input_value;
                    }
                }
            }

            // $akseskolomtabel[] = "oleh";
            // $datapost[] = getIdUser;

            $datakolom = $akseskolomtabel;
            $datavalue = $datapost;

            $dataArray = array_combine($datakolom, $datavalue);

            $input = DB::terhubung()->input($tabel, $dataArray);
            if ($input) {
                echo "Y";
            } else {
                echo "Gagal menambahkan data " . $tabel;
            }
        }

        DB::terhubung()->input('aktifitas', array(
            'users_id' => getIdUser,
            'model' => 'Membuat data ' . $tabel . ' baru',
            'ip' => Reader::ip(),
            'perangkat' => Reader::perangkat(),
            'catatan' => '-'
        ));
    }

    public static function update(string $tabel = null, int $id = null, string $akses = null)
    {

        $catatan = '';

        if ($_FILES) {
            $dirupload = "asset/storage/pdf/";

            foreach ($_FILES as $f) {
                $tmpfile = $f['tmp_name'];
            }

            if (count($_FILES) == 0 or $tmpfile == null) {

                $namadatabase = Config::envReader('DB_NAME');
                $kolom = DB::terhubung()->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$namadatabase}' AND TABLE_NAME = '{$tabel}' ");
                foreach ($kolom->hasil() as $outer_key => $array) {
                    foreach ($array as $inner_key => $value) {
                        if ($akses != null) {
                            $fieldakses = explode(",", $akses);
                            foreach ($fieldakses as $fa) {
                                if ($fa == $value) {
                                    $akseskolomtabel[] = $value;
                                }
                            }
                        } else {
                            if ($value != "id" and $value != "dibuat" and $value != "diupdate") {
                                $akseskolomtabel[] = $value;
                            }
                        }
                    }
                }

                $datapost = array();

                foreach ($akseskolomtabel as $kolomyangdiijinkan) {
                    foreach ($_POST as $input_key => $input_value) {
                        if ($kolomyangdiijinkan == $input_key) {
                            $datapost[] = $input_value;
                        }
                    }
                }

                foreach ($_POST as $input_key => $input_value) {
                    if (explode(".", $input_value)[1] == "pdf") {
                        array_push($datapost, $input_value);
                    }
                }

                foreach (explode(",", $akses) as $ak) {
                    if (substr($ak, 0, 1) == "!") {
                        array_push($akseskolomtabel, str_replace("!", "", $ak));
                    }
                }

                // $akseskolomtabel[] = "oleh";
                // $datapost[] = getIdUser;

                $datakolom = $akseskolomtabel;
                $datavalue = $datapost;

                $dataArray = array_combine($datakolom, $datavalue);
                $perbarui = DB::terhubung()->perbarui($tabel, $id, $dataArray);
                if ($perbarui) {
                    if (Input::get('diupdate')) {
                        DB::terhubung()->perbarui($tabel, $id, array(
                            'diupdate' => Input::get('diupdate')
                        ));
                    } else {
                        DB::terhubung()->perbarui($tabel, $id, array(
                            'diupdate' => date('Y-m-d H:i:s')
                        ));
                    }
                    echo "Y";
                } else {
                    echo "Gagal memperbarui data " . $tabel;
                }
            } else {
                $jumlah = 0;
                $gnfile = "";
                foreach ($_FILES as $filedata) {
                    $tempname = $filedata['tmp_name'];
                    $namafile = date("d") . date("m") . date("Y") . date("H") . date("i") . date("s") . "_" . $filedata['name'];
                    $gnfile .= date('d') . date('m') . date('Y') . date('H') . date('i') . date('s') . "_" . $filedata['name'] . ",";
                    $target_file = $dirupload . $namafile;
                    $simpanfile = move_uploaded_file($tempname, $target_file);
                    if ($simpanfile) {
                        $jumlah++;
                    }
                }
                if (count($_FILES) == $jumlah) {

                    $namadatabase = Config::envReader('DB_NAME');
                    $kolom = DB::terhubung()->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$namadatabase}' AND TABLE_NAME = '{$tabel}' ");
                    foreach ($kolom->hasil() as $outer_key => $array) {
                        foreach ($array as $inner_key => $value) {
                            if ($akses != null) {
                                $fieldakses = explode(",", $akses);
                                foreach ($fieldakses as $fa) {
                                    if ($fa == $value) {
                                        $akseskolomtabel[] = $value;
                                    }
                                }
                            } else {
                                if ($value != "id" and $value != "dibuat" and $value != "diupdate") {
                                    $akseskolomtabel[] = $value;
                                }
                            }
                        }
                    }

                    $datapost = array();

                    foreach ($akseskolomtabel as $kolomyangdiijinkan) {
                        foreach ($_POST as $input_key => $input_value) {
                            if ($kolomyangdiijinkan == $input_key) {
                                $datapost[] = $input_value;
                            }
                        }
                    }

                    $jumlahstring = strlen($gnfile) - 1;
                    $gnfile = substr($gnfile, 0, $jumlahstring);
                    foreach (explode(",", $gnfile) as $nafile) {
                        array_push($datapost, $nafile);
                    }

                    // $akseskolomtabel[] = "oleh";
                    // $datapost[] = getIdUser;

                    $datakolom = $akseskolomtabel;
                    $datavalue = $datapost;

                    $dataArray = array_combine($datakolom, $datavalue);

                    $perbarui = DB::terhubung()->perbarui($tabel, $id, $dataArray);
                    if ($perbarui) {
                        if (Input::get('diupdate')) {
                            DB::terhubung()->perbarui($tabel, $id, array(
                                'diupdate' => Input::get('diupdate')
                            ));
                        } else {
                            DB::terhubung()->perbarui($tabel, $id, array(
                                'diupdate' => date('Y-m-d H:i:s')
                            ));
                        }
                        echo "Y";
                    } else {
                        echo "Gagal memperbarui data " . $tabel;
                    }
                } else {
                    echo "Gagal memperbarui file";
                }
            }
        } else {

            $namadatabase = Config::envReader('DB_NAME');
            $kolom = DB::terhubung()->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$namadatabase}' AND TABLE_NAME = '{$tabel}' ");
            foreach ($kolom->hasil() as $outer_key => $array) {
                foreach ($array as $inner_key => $value) {
                    if ($akses != null) {
                        $fieldakses = explode(",", $akses);
                        foreach ($fieldakses as $fa) {
                            if ($fa == $value and Input::get($value) != "") {
                                $akseskolomtabel[] = $value;
                            }
                        }
                    } else {
                        if ($value != "id" and $value != "dibuat" and $value != "diupdate") {
                            $akseskolomtabel[] = $value;
                        }
                    }
                }
            }

            $datapost = array();

            foreach ($akseskolomtabel as $kolomyangdiijinkan) {
                foreach ($_POST as $input_key => $input_value) {
                    if ($kolomyangdiijinkan == $input_key) {
                        $datapost[] = $input_value;
                    }
                }
            }

            // $akseskolomtabel[] = "oleh";
            // $datapost[] = getIdUser;

            $datakolom = $akseskolomtabel;
            $datavalue = $datapost;

            $dataArray = array_combine($datakolom, $datavalue);

            $perbarui = DB::terhubung()->perbarui($tabel, $id, $dataArray);
            if ($perbarui) {
                if (Input::get('diupdate')) {
                    DB::terhubung()->perbarui($tabel, $id, array(
                        'diupdate' => Input::get('diupdate')
                    ));
                } else {
                    DB::terhubung()->perbarui($tabel, $id, array(
                        'diupdate' => date('Y-m-d H:i:s')
                    ));
                }
                echo "Y";
            } else {
                echo "Gagal memperbarui data " . $tabel;
            }
        }

        DB::terhubung()->input('aktifitas', array(
            'users_id' => getIdUser,
            'model' => 'Mengupdate data ' . $tabel . ' id ' . $id,
            'ip' => Reader::ip(),
            'perangkat' => Reader::perangkat(),
            'catatan' => $catatan
        ));
    }

    public static function drop(string $tabel = null, int $id = null)
    {

        $hapus = DB::terhubung()->hapus($tabel, array("id", "=", $id));
        if ($hapus) {
            $kembali = filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL);
            Lanjut::ke($kembali);
        } else {
            $kembali = filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL);
            Lanjut::ke($kembali);
        }
    }
}
