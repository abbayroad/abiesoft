<?php

namespace AbieSoft\Controllers;

use AbieSoft\Sistem\Http\Route;
use AbieSoft\Sistem\Auth\AuthUser;
use AbieSoft\Sistem\Utility\Input;

class AuthController extends Route
{

    public function login()
    {
        $auth = new AuthUser();
        return $auth->login(Input::get('email'), Input::get('password'), Input::get('_token'));
    }

    public function logout()
    {
        $auth = new AuthUser();
        return $auth->logout();
    }

    public function index()
    {
        return parent::view(view: 'auth.login');
    }

    public function konfirmasi()
    {
        return parent::view(view: 'auth.konfirmasi');
    }

    public function kirimjawaban()
    {
        $auth = new AuthUser();
        return $auth->konfirmasi(Input::get('email'), Input::get('jawaban'), Input::get('_token'));
    }

    public function reset()
    {
        return parent::view(view: 'auth.reset');
    }

    public function ubahpassword()
    {
        $auth = new AuthUser();
        return $auth->ubahpassword(Input::get('email'), Input::get('kode_reset'), Input::get('passwordbaru'), Input::get('_token'));
    }
}
