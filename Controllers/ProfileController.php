<?php

namespace AbieSoft\Controllers;

use AbieSoft\Sistem\Http\Route;
use AbieSoft\Sistem\Http\Lanjut;
use AbieSoft\Models\Profile;
use AbieSoft\Sistem\Mysql\DB;
use AbieSoft\Sistem\Magic\Reader;

class ProfileController extends Route
{

    public function index()
    {
        // menampilkan file index.php yang ada di folder view/profile 
        $data1 = '';
        $data2 = '';
        // dan seterusnya isi data bisa berupa string atau berupa array 
        // dan untuk memanggil datanya di file view bisa menggunakan variabel $data  
        return parent::view(view: 'profile.index', data: ['data1' => $data1, 'data2' => $data2]);
    }

    public function baru()
    {
        return parent::view(view: 'profile.baru');
    }

    public function edit(int $id)
    {
        Lanjut::ke('profile?id=' . $id . '/detail');
    }

    public function detail(int $id)
    {
        $detailprofile = Profile::only($id);
        $aktifitas = DB::terhubung()->query("SELECT * FROM aktifitas WHERE users_id = '" . getIdUser . "' ORDER BY id DESC ")->hasil();
        return parent::view(view: 'profile.detail', data: ['profile' => $detailprofile, 'aktifitas' => $aktifitas]);
    }

    public function setnama()
    {
        echo Reader::data('users', 'nama', getIdUser);
    }

    public function setemail()
    {
        echo Reader::data('users', 'email', getIdUser);
    }

    public function setphone()
    {
        echo Reader::data('users', 'phone', getIdUser);
    }

    public function setphoto()
    {
        echo Reader::data('users', 'photo', getIdUser);
    }

    public function create()
    {
        echo "do create";
        // return Profile::post(); 
    }

    public function update(int $id)
    {
        return Profile::postUpdate($id);
    }

    public function delete(int $id)
    {
        // return Profile::postDrop($id); 
    }
}
