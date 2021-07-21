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
            $kolom = (is_int($user)) ? 'id' : 'username';
            $data = DB::terhubung()->tampilkan('users', array($kolom, '=', $user));
            if ($data->hitung()) {
                return $data->awal();
            }
        }
        return false;
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
