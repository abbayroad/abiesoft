<?php

namespace AbieSoft\Sistem\Auth\Controller;

use AbieSoft\Sistem\Http\Route;
use AbieSoft\Sistem\Utility\Input;
use AbieSoft\Sistem\Magic\Reader;
use AbieSoft\Sistem\Mysql\DB;
use AbieSoft\Sistem\Utility\Hash;
use AbieSoft\Sistem\Utility\Session;
use AbieSoft\Sistem\Utility\Config;
use AbieSoft\Sistem\Http\Lanjut;

class AuthController extends Route
{

    private $_user,
        $_data,
        $_isLogin = false;

    public function __construct($user = null)
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
            self::cariuser($user);
        }
    }

    protected static function cariuser($user = null)
    {
        if ($user) {
            $kolom = (is_numeric($user)) ? 'id' : 'username';
            $data = DB::terhubung()->tampilkan('users', array($kolom, '=', $user));
            if ($data->hitung()) {
                return $data->awal();
            }
        }
        return false;
    }

    public function index()
    {
        return parent::view(view: 'auth.wellcome');
    }

    public function login()
    {
        return parent::view(view: 'auth.login');
    }

    public function lupa()
    {
        return parent::view(view: 'auth.lupa');
    }

    public function reset()
    {
        return parent::view(view: 'auth.reset');
    }

    public function registrasi()
    {
        return parent::view(view: 'auth.registrasi');
    }

    public function setlogin()
    {
        $token = Input::get('_token');
        $username = Input::get('username');
        $password = Input::get('password');
        if ($token == Reader::token()) {
            $user = $this->cariuser($username);
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
                        echo "Y";
                    } else {
                        echo "Password salah";
                    }
                } else {
                    echo "Token Expire";
                }
            } else {
                echo "Username " . $username . " tidak ditemukan";
            }
        } else {
            echo "Token Expire";
        }
    }

    public function setlupa()
    {
        echo "Set Lupa";
    }

    public function setreset()
    {
        echo "Set Reset";
    }

    public function setregistrasi()
    {
        $token = Input::get('_token');
        $salt = Hash::salt();
        $karakter = '0123456789';
        $pinacak  = substr(str_shuffle($karakter), 0, 4);
        $password = Hash::make(Input::get('password'), $salt);
        $username = Input::get('username');
        $email = Input::get('email');
        if ($token == Reader::token()) {
            $cekusername = DB::terhubung()->query("SELECT * FROM users WHERE username = '" . $username . "' ");
            if (!$cekusername->hitung()) {
                $cekemail = DB::terhubung()->query("SELECT * FROM users WHERE email = '" . $email . "' ");
                if (!$cekemail->hitung()) {
                    $input = DB::terhubung()->input("users", array(
                        'nama' => Input::get('nama'),
                        'username' => $username,
                        'email' => $email,
                        'password' => $password,
                        'salt' => $salt,
                        'photo' => 'default.png',
                        'pin' => $pinacak,
                        'grup_id' => Config::envReader('DEFAULT_GRUP')
                    ));
                    if ($input) {
                        echo "Y";
                    } else {
                        echo "Registrasi Gagal";
                    }
                } else {
                    echo "Email " . $email . " sudah digunakan";
                }
            } else {
                echo "Username " . $username . " sudah digunakan";
            }
        } else {
            echo "Token Expire";
        }
    }

    public function logout()
    {
        // if (getPertanyaanUser == "") {
        //     Session::pesan('logout', 'Anda baru pertama kali masuk di aplikasi ini, sebaiknya atur pertanyaan terlebih dahulu sebelum anda keluar. Pertanyaan ini akan digunakan jika suatu saat nanti anda lupa password loginnya.');
        //     Lanjut::ke(weburl . 'profile?id=' . getIdUser . '/detail');
        // } else {
        session_destroy();
        Lanjut::ke('/');
        // }
    }
}
