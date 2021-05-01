<?php

namespace AbieSoft\Sistem\Auth;

use AbieSoft\Sistem\Mysql\DB;
use AbieSoft\Sistem\Http\Lanjut;
use AbieSoft\Sistem\Utility\Config;
use AbieSoft\Sistem\Utility\Session;
use AbieSoft\Sistem\Utility\Hash;
use AbieSoft\Sistem\Magic\Reader;

class AuthUser
{

    private string|int $_user;
    private object $_data;
    private bool $_isLogin = false;

    public function __construct(string|int $user = null)
    {
        if (!$user) {
            if (Session::ada(Config::envReader('SESI_ID'))) {
                $this->_user = Session::lihat(Config::envReader('SESI_ID'));
                if ($this->cariuser($this->_user)) {
                    $this->_isLogin = true;
                    $this->_data = $this->cariuser($this->_user);
                    return true;
                }
            }
        } else {
            $this->cariuser($user);
        }
    }

    protected function cariuser(string|int $user = null)
    {
        if ($user) {
            $kolom = (is_int($user)) ? 'id' : 'email';
            $data = DB::terhubung()->tampilkan('users', array($kolom, '=', $user));
            if ($data->hitung()) {
                return $data->awal();
            }
        }
        return false;
    }

    public function login(string $email, string $password, string $token)
    {
        $user = $this->cariuser($email);
        if ($user) {
            if (Reader::scanner(sha1($token . $user->pin))) {
                if ($user->password == Hash::make($password, $user->salt)) {
                    if (!file_exists("asset/storage/users/" . $user->id . "/")) {
                        mkdir("asset/storage/users/" . $user->id, 0700);
                    }
                    if (!file_exists("asset/storage/users/" . $user->id . "/photo/")) {
                        mkdir("asset/storage/users/" . $user->id . "/photo", 0700);
                    }
                    if (!file_exists("asset/storage/users/" . $user->id . "/dokumen/")) {
                        mkdir("asset/storage/users/" . $user->id . "/dokumen/", 0700);
                    }
                    $idu = (int)$user->id;
                    Session::simpan(Config::envReader("SESI_ID"), $idu);
                    DB::terhubung()->input('aktifitas', array(
                        'users_id' => $this->_isLogin,
                        'model' => 'Login Aplikasi',
                        'ip' => Reader::ip(),
                        'perangkat' => Reader::perangkat(),
                        'catatan' => '-'
                    ));
                    echo "Y";
                } else {
                    if ($user->pertanyaan != "") {
                        Session::pesan('konfirmasi', $user->pertanyaan);
                        Session::pesan('email', $user->email);
                        echo "Password salah";
                    } else {
                        echo "User dan password tidak cocok";
                    }
                }
            } else {
                echo "Token Expire";
            }
        } else {
            echo "User tidak ditemukan";
        }
    }

    public function konfirmasi(string $email, string $jawaban, string $token)
    {
        $user = $this->cariuser($email);
        if ($user) {
            if (Reader::scanner(sha1($token . $user->pin))) {
                if (sha1($jawaban) == $user->jawaban) {
                    DB::terhubung()->perbarui('users', $user->id, array(
                        'kode_reset' => sha1(date('Y-m-d H:i:s'))
                    ));
                    $userdatabaru = $this->cariuser($user->email);
                    Session::pesan('reset', $userdatabaru->kode_reset);
                    Session::pesan('email', $userdatabaru->email);
                    echo "Y";
                } else {
                    echo "Jawaban salah";
                }
            } else {
                echo "Token Expire";
            }
        } else {
            echo "User tidak ditemukan";
        }
    }

    public function ubahpassword(string $email, string $kode, string $passbr, string $token)
    {
        $user = $this->cariuser($email);
        if ($user) {
            if (Reader::scanner(sha1($token . $user->pin))) {
                if ($kode == $user->kode_reset) {
                    $salt = Hash::salt();
                    $password = Hash::make($passbr, $salt);
                    DB::terhubung()->perbarui('users', $user->id, array(
                        'password' => $password,
                        'salt' => $salt
                    ));
                    DB::terhubung()->input('aktifitas', array(
                        'users_id' => $user->id,
                        'model' => 'Mereset Password',
                        'ip' => Reader::ip(),
                        'perangkat' => Reader::perangkat(),
                        'catatan' => '-'
                    ));
                    Session::pesan('passwordbaru', 'Password baru telah dibuah');
                    echo "Y";
                } else {
                    echo "Jawaban salah";
                }
            } else {
                echo "Token Expire";
            }
        } else {
            echo "User tidak ditemukan";
        }
    }

    public function logout()
    {
        if (getPertanyaanUser == "") {
            Session::pesan('logout', 'Anda baru pertama kali masuk di aplikasi ini, sebaiknya atur pertanyaan terlebih dahulu sebelum anda keluar. Pertanyaan ini akan digunakan jika suatu saat nanti anda lupa password loginnya.');
            Lanjut::ke(weburl . 'profile?id=' . getIdUser . '/detail');
        } else {
            session_destroy();
            DB::terhubung()->input('aktifitas', array(
                'users_id' => $this->_isLogin,
                'model' => 'Keluar Aplikasi',
                'ip' => Reader::ip(),
                'perangkat' => Reader::perangkat(),
                'catatan' => '-'
            ));
            Lanjut::ke('/');
        }
    }

    public function data()
    {
        return $this->_data;
    }

    public function isLogin(): bool
    {
        return $this->_isLogin;
    }
}
