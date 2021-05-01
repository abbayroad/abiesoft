<?php

namespace AbieSoft\Models;

use AbieSoft\Sistem\Data\Collection;
use AbieSoft\Sistem\Utility\Input;
use AbieSoft\Sistem\Utility\Hash;
use AbieSoft\Sistem\Magic\Reader;
use AbieSoft\Sistem\Mysql\DB;

class Profile extends Collection
{

    public static function tabel()
    {
        $tabel = "users";
        return $tabel;
    }

    public static function all()
    {
        return parent::get(self::tabel());
    }

    public static function only($id)
    {
        return parent::detail(self::tabel(), $id);
    }

    public static function post()
    {
        //return parent::create(self::tabel(),null); 
    }

    public static function postUpdate($id)
    {
        $nama = Input::get('nama');
        $email = Input::get('email');
        $phone = Input::get('phone');
        $pertanyaan = Input::get('pertanyaan');
        $jawaban = sha1(Input::get('jawaban'));
        $passbr = Input::get('password');
        $grupid = getGrupIdUser;

        $cekjawaban = DB::terhubung()->query("SELECT jawaban, id FROM users WHERE jawaban = '" . $jawaban . "' AND id = '" . getIdUser . "' ");
        if ($cekjawaban->hitung()) {
            $jawaban = Reader::data('users', 'jawaban', getIdUser);
        } else {
            $jawaban = $jawaban;
        }

        $cekemail = DB::terhubung()->query("SELECT email, id FROM users WHERE email = '" . $email . "' AND id != '" . getIdUser . "' ");
        if ($cekemail->hitung()) {
            echo "Email tidak tersedia";
        } else {

            if ($passbr == "") {
                $salt = Reader::data('users', 'salt', getIdUser);
                $password = Reader::data('users', 'password', getIdUser);
                $passwordstatus = "";
            } else {
                $salt = Hash::salt();
                $password = Hash::make($passbr, $salt);
                $passwordstatus = "Password diubah";
            }

            if ($_FILES) {

                if (Input::file('photo', 'name') != "") {
                    $dirfile = "asset/storage/users/" . getIdUser . "/photo/";
                    $targetfile = $dirfile . basename(Input::file('photo', 'name'));
                    $status = 1;
                    $filetipe = strtolower(pathinfo($targetfile, PATHINFO_EXTENSION));
                    if (isset($_POST["submit"])) {
                        $check = getimagesize(Input::file('photo', 'tmp_name'));
                        if ($check !== false) {
                            $status = 1;
                        } else {
                            echo "File harus berupa photo.";
                            $status = 0;
                        }
                    }
                    if (file_exists($targetfile)) {
                        echo "File sudah ada.";
                        $status = 0;
                    }
                    if (Input::file('photo', 'size') > 500000) {
                        echo "File terlalu besar.";
                        $status = 0;
                    }
                    if (
                        $filetipe != "jpg" && $filetipe != "png" && $filetipe != "jpeg"
                        && $filetipe != "gif"
                    ) {
                        echo "File harus berupa JPG, JPEG, PNG dan GIF.";
                        $status = 0;
                    }
                    if ($status != 0) {
                        if (move_uploaded_file(Input::file('photo', 'tmp_name'), $targetfile)) {
                            $perbarui = DB::terhubung()->perbarui(self::tabel(), $id, array(
                                'nama' => $nama,
                                'email' => $email,
                                'phone' => $phone,
                                'pertanyaan' => $pertanyaan,
                                'jawaban' => $jawaban,
                                'password' => $password,
                                'salt' => $salt,
                                'photo' => $targetfile,
                                'grup_id' => $grupid
                            ));
                            if ($perbarui) {
                                $catatan = "";
                                $catatan = "Melakukan perubahan pada ";
                                if ($nama != getNamaUser) {
                                    $catatan .= " nama semula <b>" . getNamaUser . "</b> menjadi <b>" . $nama . "</b>, ";
                                }
                                if ($email != getEmailUser) {
                                    $catatan .= " email semula <b>" . getEmailUser . "</b> menjadi <b>" . $email . "</b>, ";
                                }
                                if ($phone != getPhoneUser) {
                                    $catatan .= " phone semula <b>" . getPhoneUser . "</b> menjadi <b>" . $phone . "</b>, ";
                                }
                                if ($pertanyaan != getPertanyaanUser) {
                                    $catatan .= " pertanyaan semula <b>" . getPertanyaanUser . "</b> menjadi <b>" . $pertanyaan . "</b>, ";
                                }
                                if (sha1($jawaban) != getJawabanUser) {
                                    $catatan .= " jawaban, ";
                                }
                                if ($passwordstatus != "") {
                                    $catatan .= " password, ";
                                }
                                $catatan .= " dan photo";
                                if ($catatan == "Melakukan perubahan pada  dan photo") {
                                    $catatan = "Melakukan perubahan pada photo";
                                } else {
                                    $catatan = $catatan;
                                }
                                DB::terhubung()->input('aktifitas', array(
                                    'users_id' => getIdUser,
                                    'model' => 'Memperbarui Profile',
                                    'ip' => Reader::ip(),
                                    'perangkat' => Reader::perangkat(),
                                    'catatan' => $catatan
                                ));
                                echo "Y";
                            } else {
                                echo "Gagal memperbarui data";
                            }
                        } else {
                            echo "Gagal mengupload photo.";
                        }
                    }
                } else {

                    $perbarui = DB::terhubung()->perbarui(self::tabel(), $id, array(
                        'nama' => $nama,
                        'email' => $email,
                        'phone' => $phone,
                        'pertanyaan' => $pertanyaan,
                        'jawaban' => $jawaban,
                        'password' => $password,
                        'salt' => $salt,
                        'grup_id' => $grupid
                    ));

                    if ($perbarui) {
                        $catatan = "";
                        $catatan = "Melakukan perubahan pada ";
                        if ($nama != getNamaUser) {
                            $catatan .= " nama semula <b>" . getNamaUser . "</b> menjadi <b>" . $nama . "</b>, ";
                        }
                        if ($email != getEmailUser) {
                            $catatan .= " email semula <b>" . getEmailUser . "</b> menjadi <b>" . $email . "</b>, ";
                        }
                        if ($phone != getPhoneUser) {
                            $catatan .= " phone semula <b>" . getPhoneUser . "</b> menjadi <b>" . $phone . "</b>, ";
                        }
                        if ($pertanyaan != getPertanyaanUser) {
                            $catatan .= " pertanyaan semula <b>" . getPertanyaanUser . "</b> menjadi <b>" . $pertanyaan . "</b>, ";
                        }
                        if (sha1($jawaban) != getJawabanUser) {
                            $catatan .= " jawaban, ";
                        }
                        if ($passwordstatus != "") {
                            $catatan .= " dan password ";
                        }
                        if ($catatan == "Melakukan perubahan pada  dan password ") {
                            $catatan = "Melakukan perubahan pada password";
                        } else {
                            $catatan = $catatan;
                        }
                        if ($catatan != "Melakukan perubahan pada ") {
                            DB::terhubung()->input('aktifitas', array(
                                'users_id' => getIdUser,
                                'model' => 'Memperbarui Profile',
                                'ip' => Reader::ip(),
                                'perangkat' => Reader::perangkat(),
                                'catatan' => $catatan
                            ));
                        }

                        echo "Y";
                    } else {
                        echo "Gagal memperbarui data";
                    }
                }
            }
        }
    }

    public static function postDrop($id)
    {
        //return parent::drop(self::tabel(),$id); 
    }
}
