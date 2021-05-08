<?php

namespace AbieSoft\Controllers;

use AbieSoft\Sistem\Http\Route;
use AbieSoft\Sistem\Mysql\DB;
use AbieSoft\Models\Grup;
use AbieSoft\Sistem\Utility\Input;
use AbieSoft\Sistem\Utility\Define;

class GrupController extends Route
{

    public string $nama;
    public string $akses;
    public string $opsi;

    public function index()
    {
        return parent::view(view: 'grup.index');
    }

    public function loaddata()
    {
        $datagrup = DB::terhubung()->query("SELECT * FROM grup");
        $datalist = array();
        foreach ($datagrup->hasil() as $grup) {
            $trid = $grup->id;
            $itemgrup = new GrupController();
            $itemgrup->nama = $grup->nama;
            $itemgrup->akses = "Lihat detail";
            $itemgrup->opsi = str_replace('{{ID}}', $trid, btnopsi);
            $datalist[] = $itemgrup;
            $datajson = json_encode($datalist);
        }

        echo $datajson;
    }

    public function konfirmasi($id)
    {
        $cekdata = Grup::only($id);
        foreach ($cekdata as $cd) {
            echo $cd->nama;
        }
    }

    public function baru()
    {
        return parent::view(view: 'grup.baru');
    }

    public function edit(int $id)
    {
        $grup = Grup::only($id);
        return parent::view(view: 'grup.edit', data: ['grup' => $grup]);
    }

    public function detail(int $id)
    {
        $grup = Grup::only($id);
        return parent::view(view: 'grup.detail', data: ['grup' => $grup]);
    }

    public function create()
    {
        return Grup::post();
    }

    public function update()
    {
        $id = Input::get('id');
        return Grup::postUpdate($id);
    }

    public function delete()
    {
        $id = Input::get('id');
        return Grup::postDrop($id);
    }
}
