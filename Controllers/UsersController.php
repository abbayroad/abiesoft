<?php

namespace AbieSoft\Controllers;

use AbieSoft\Sistem\Http\Route;
use AbieSoft\Sistem\Mysql\DB;
use AbieSoft\Sistem\Utility\Hash;
use AbieSoft\Sistem\Utility\Input;
use AbieSoft\Models\Users;

class UsersController extends Route
{

    public string $nama;
    public string $email;
    public string $users;
    public string $opsi;

    public function index()
    {
        return parent::view(view: 'users.index');
    }

    public function loaddata()
    {
        $datausers = DB::terhubung()->query("SELECT * FROM users");
        $datalist = array();
        foreach ($datausers->hasil() as $user) {
            $trid = $user->id;
            $itemusers = new UsersController();
            $itemusers->nama = $user->nama;
            $itemusers->email = $user->email;
            $itemusers->phone = $user->phone;
            $itemusers->opsi = str_replace('{{ID}}', $trid, btnopsi);
            $datalist[] = $itemusers;
            $datajson = json_encode($datalist);
        }

        echo $datajson;
    }

    public function baru()
    {
        return parent::view(view: 'users.baru');
    }

    public function edit(int $id)
    {
        $userdata = Users::only($id);
        return parent::view(view: 'users.edit', data: ['users' => $userdata]);
    }

    public function detail(int $id)
    {
        $userdata = Users::only($id);
        return parent::view(view: 'users.detail', data: ['users' => $userdata]);
    }

    public function create()
    {
        $nama = Input::get('nama');
        $email = Input::get('email');
        $phone = Input::get('phone');
        $grupid = 2;
        $pass = Input::get('password');
        $salt = Hash::salt();
        $password = Hash::make($pass, $salt);
        $input = DB::terhubung()->input('users', array(
            'nama' => $nama,
            'email' => $email,
            'phone' => $phone,
            'salt' => $salt,
            'password' => $password,
            'grup_id' => $grupid,
            'photo' => 'asset/storage/default.jpg'
        ));
        if ($input) {
            echo "Y";
        } else {
            echo "Gagal membuat users";
        }
    }

    public function update()
    {
        $id = Input::get('id');
        $nama = Input::get('nama');
        $email = Input::get('email');
        $phone = Input::get('phone');
        $grupid = Input::get('grup_id');;
        $input = DB::terhubung()->perbarui('users', $id, array(
            'nama' => $nama,
            'email' => $email,
            'phone' => $phone,
            'grup_id' => $grupid
        ));
        if ($input) {
            echo "Y";
        } else {
            echo "Gagal membuat users";
        }
    }

    public function delete()
    {
        $id = Input::get('id');
        return Users::postDrop($id);
    }
}
