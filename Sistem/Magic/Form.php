<?php

namespace AbieSoft\Sistem\Magic;

use AbieSoft\Sistem\Magic\Reader;

class Form
{

    public static function create(string $tabel = null, string $method = null, array $form)
    {
        Reader::acak();
        echo "<form method='POST' id='" . $tabel . $method . "' name='" . $tabel . $method . "' action='#' enctype='multipart/form-data'>\n";
        if (is_array($form)) {
            foreach ($form as $f => $v) {
                $label = $f;
                if (isset($v[0])) {
                    $tipe = $v[0];
                }
                if (isset($v[1])) {
                    $name = $v[1];
                }
                if (isset($v[2])) {
                    $placeholder = $v[2];
                }

                if ($tipe == "input") {
                    $input = "<div class='form-group'>\n<label for='" . $name . "'>" . $label . "</label>\n<input type='text' class='form-control'  id='" . $name . "' name='" . $name . "' placeholder='" . $placeholder . "' autocomplete='off'>\n</div>\n";
                }

                if ($tipe == "email") {
                    $input = "<div class='form-group'>\n<label for='" . $name . "'>" . $label . "</label>\n<input type='email' class='form-control'  id='" . $name . "' name='" . $name . "' placeholder='" . $placeholder . "' autocomplete='off'>\n</div>\n";
                }

                if ($tipe == "phone") {
                    $input = "<div class='form-group'>\n<label for='" . $name . "'>" . $label . "</label>\n<input maxlength='13' class='form-control'  id='" . $name . "' name='" . $name . "' placeholder='" . $placeholder . "' autocomplete='off'>\n</div>\n";
                }

                if ($tipe == "password") {
                    $input = "<div class='form-group'>\n<label for='" . $name . "'>" . $label . "</label>\n<input type='password' class='form-control'  id='" . $name . "' name='" . $name . "' placeholder='" . $placeholder . "' autocomplete='off'>\n</div>\n";
                }

                if ($tipe == "hidden") {
                    $input = "<div class='form-group'><input type='hidden' class='form-control'  id='" . $name . "' name='" . $name . "' placeholder='" . $placeholder . "' autocomplete='off'>\n</div>\n";
                }

                if ($tipe == "file") {
                    $input = "<div class='form-group'>\n<label for='" . $name . "'>" . $label . "</label>\n<input type='file' class='form-control'  id='" . $name . "' name='" . $name . "' placeholder='" . $placeholder . "' autocomplete='off'>\n</div>\n";
                }

                if ($tipe == "textarea") {
                    $input = "<div class='form-group'>\n<label for='" . $name . "'>" . $label . "</label>\n<textarea type='text' class='form-control' id='" . $name . "' name='" . $name . "' placeholder='" . $placeholder . "' autocomplete='off'></textarea>\n</div>\n";
                }

                if ($tipe == "select") {
                    if (is_array($name)) {
                        $formname = $name[0];
                        $kolomvalue = $name[1];
                        $input = "<div class='form-group'>\n<label for='" . $formname . "'>" . $label . "</label>\n<select type='text' class='form-control' id='" . $formname . "' name='" . $formname . "'>" . Reader::select($formname, $placeholder, $kolomvalue) . "</select>\n</div>\n";
                    }
                }

                if ($tipe == "radio") {
                    if (is_array($name)) {
                        $formname = $name[0];
                        $kolomvalue = $name[1];
                        $input = "<div class='form-group'>\n<label for='" . $formname . "'>" . $label . "</label>\n" . Reader::radio($formname, $placeholder, $kolomvalue) . "\n</div>\n";
                    }
                }

                if ($tipe == "checkbox") {
                    if (is_array($name)) {
                        $formname = $name[0];
                        $kolomvalue = $name[1];
                        $input = "<div class='form-group'>\n<label for='" . $formname . "'>" . $label . "</label>\n" . Reader::checkbox($formname, $placeholder, $kolomvalue) . "\n</div>\n";
                    }
                }

                if ($tipe == "submit") {
                    $idbutton = $name;
                    $labelbutton = $label;
                    $input = "<div class='form-button'>\n" . CSRF . "<button class='btn btn-primary' type='submit' id='" . $name . "'>" . $label . "</button>\n</div>\n";
                }

                echo $input;
            }
        }


        $formId = "";
        $variable = "";
        $validasi = "";
        $dataFormID = "";
        $dataValidasi = "";

        $x = 1;
        foreach ($form as $el1 => $val1) {
            if (isset($val1[1])) {
                $namaElement = $val1[1];
            }
            if (isset($val1[3])) {
                $element = $val1[3];
            }
            if ($element != null) {
                if ($x != 1) {
                    $else = "else ";
                } else {
                    $else = "";
                }

                if ($element != 'setClean' and $val1[0] != 'submit') {
                    if ($namaElement != '_token') {
                        $dataFormID .= "document.getElementById('" . $namaElement . "').value = ''; ";
                    }
                    $dataValidasi .= $else . " if(" . $element . "(" . $namaElement . ")){ gagal('" . $el1 . " ' + " . $element . "(" . $namaElement . ")); document.getElementById('" . $namaElement . "').focus(); return false;  }";
                    $dataVariable = "var " . $namaElement . " = document.forms['" . $tabel . $method . "']['" . $namaElement . "'].value; ";
                }


                $formId .= $dataFormID;
                $variable .= $dataVariable;
                $validasi .=  $dataValidasi;
                if ($x < count($form)) {
                    $dataFormID = '';
                    $formId .= '';
                    $dataVariable = '';
                    $variable .= '';
                    $dataValidasi = '';
                    $validasi .= '';
                }
            }
            $x++;
        }

        $txt = " $('form#" . $tabel . $method . "').submit(function(e){ e.preventDefault(); " . $variable . " " . $validasi . "else{ document.getElementById('" . $idbutton . "').disabled = true; document.getElementById('" . $idbutton . "').innerHTML = 'Sedang menyimpan..'; var formData = new FormData(this);  var doAction = '" . weburl . $tabel . "/create';  $.ajax({ url: doAction, type: 'POST', data: formData, success: function (msg) { if(msg == 'Y'){ document.getElementById('" . $idbutton . "').disabled = false; document.getElementById('" . $idbutton . "').innerHTML = '" . $labelbutton . "'; " . $formId . " berhasil('Data " . $tabel . " baru telah ditambahkan'); return false;  }else{ document.getElementById('" . $idbutton . "').disabled = false; document.getElementById('" . $idbutton . "').innerHTML = '" . $labelbutton . "'; gagal(msg);  return false; }  return false;  },  cache: false, contentType: false, processData: false }); return false;  } }); ";

        Reader::validasi($method, $tabel, $txt);

        echo "</form>";
    }


    public static function update(string $tabel = null, string $method = null,  array $form, int $id)
    {
        Reader::acak();
        echo "<form method='POST' id='" . $tabel . $method . "' name='" . $tabel . $method . "' action='#' enctype='multipart/form-data'>\n";
        if (is_array($form)) {
            foreach ($form as $f => $v) {
                $label = $f;
                if (isset($v[0])) {
                    $tipe = $v[0];
                }
                if (isset($v[1])) {
                    $name = $v[1];
                }
                if (isset($v[2])) {
                    $placeholder = $v[2];
                }

                if (isset($v[4])) {
                    $dbvalue = $v[4];
                }

                if ($tipe == "input") {
                    $input = "<div class='form-group'>\n<label for='" . $name . "'>" . $label . "</label>\n<input type='text' class='form-control'  id='" . $name . "' name='" . $name . "' placeholder='" . $placeholder . "' value='" . $dbvalue . "' autocomplete='off'>\n</div>\n";
                }

                if ($tipe == "email") {
                    $input = "<div class='form-group'>\n<label for='" . $name . "'>" . $label . "</label>\n<input type='email' class='form-control'  id='" . $name . "' name='" . $name . "' placeholder='" . $placeholder . "' value='" . $dbvalue . "' autocomplete='off'>\n</div>\n";
                }

                if ($tipe == "phone") {
                    $input = "<div class='form-group'>\n<label for='" . $name . "'>" . $label . "</label>\n<input maxlength='13' class='form-control'  id='" . $name . "' name='" . $name . "' placeholder='" . $placeholder . "' value='" . $dbvalue . "' autocomplete='off'>\n</div>\n";
                }

                if ($tipe == "password") {
                    $input = "<div class='form-group'>\n<label for='" . $name . "'>" . $label . "</label>\n<input type='password' class='form-control'  id='" . $name . "' name='" . $name . "' placeholder='" . $placeholder . "'>\n</div>\n";
                }

                if ($tipe == "hidden") {
                    $input = "<div class='form-group'><input type='hidden' class='form-control'  id='" . $name . "' name='" . $name . "' placeholder='" . $placeholder . "' value='" . $dbvalue . "' autocomplete='off'>\n</div>\n";
                }

                if ($tipe == "file") {
                    $input = "<div class='form-group'>\n<label for='" . $name . "'>" . $label . "</label>\n<input type='file' class='form-control'  id='" . $name . "' name='" . $name . "' placeholder='" . $placeholder . "'>\n</div>\n";
                }

                if ($tipe == "textarea") {
                    $input = "<div class='form-group'>\n<label for='" . $name . "'>" . $label . "</label>\n<textarea type='text' class='form-control' id='" . $name . "' name='" . $name . "' placeholder='" . $placeholder . "'>" . $dbvalue . "</textarea>\n</div>\n";
                }

                if ($tipe == "select") {
                    if (is_array($name)) {
                        $formname = $name[0];
                        $kolomvalue = $name[1];
                        $input = "<div class='form-group'>\n<label for='" . $formname . "'>" . $label . "</label>\n<select type='text' class='form-control' id='" . $formname . "' name='" . $formname . "'>" . Reader::select($formname, $placeholder, $kolomvalue) . "</select>\n</div>\n";
                    }
                }

                if ($tipe == "radio") {
                    if (is_array($name)) {
                        $formname = $name[0];
                        $kolomvalue = $name[1];
                        $input = "<div class='form-group'>\n<label for='" . $formname . "'>" . $label . "</label>\n" . Reader::radio($formname, $placeholder, $kolomvalue) . "\n</div>\n";
                    }
                }

                if ($tipe == "checkbox") {
                    if (is_array($name)) {
                        $formname = $name[0];
                        $kolomvalue = $name[1];
                        $input = "<div class='form-group'>\n<label for='" . $formname . "'>" . $label . "</label>\n" . Reader::checkbox($formname, $placeholder, $kolomvalue) . "\n</div>\n";
                    }
                }

                if ($tipe == "submit") {
                    $idbutton = $name;
                    $labelbutton = $label;
                    $input = "<div class='form-button'>\n<input type='hidden' id='id' name='id' value='" . $id . "'>" . CSRF . "<button class='btn btn-primary' type='submit' id='" . $name . "'>" . $label . "</button>\n</div>\n";
                }

                echo $input;
            }
        }

        $variable = "";
        $validasi = "";
        $dataValidasi = "";
        $setload = "";

        if ($tabel == "profile") {
            $setload = "setnama(); setemail(); setphone(); setphoto();";
        }

        $x = 1;
        foreach ($form as $el1 => $val1) {
            if (isset($val1[1])) {
                $namaElement = $val1[1];
            }
            if (isset($val1[3])) {
                $element = $val1[3];
            }
            if ($element != null) {
                if ($x != 1) {
                    $else = "else ";
                } else {
                    $else = "";
                }

                if ($element != 'setClean' and $val1[0] != 'submit') {
                    $dataValidasi .= $else . " if(" . $element . "(" . $namaElement . ")){ gagal('" . $el1 . " ' + " . $element . "(" . $namaElement . ")); document.getElementById('" . $namaElement . "').focus(); return false;  }";
                    $dataVariable = "var " . $namaElement . " = document.forms['" . $tabel . $method . "']['" . $namaElement . "'].value; ";
                }

                $variable .= $dataVariable;
                $validasi .=  $dataValidasi;
                if ($x < count($form)) {
                    $dataVariable = '';
                    $variable .= '';
                    $dataValidasi = '';
                    $validasi .= '';
                }
            }
            $x++;
        }

        $txt = " $('form#" . $tabel . $method . "').submit(function(e){ e.preventDefault(); " . $variable . " " . $validasi . "else{ document.getElementById('" . $idbutton . "').disabled = true; document.getElementById('" . $idbutton . "').innerHTML = 'Sedang menyimpan..'; var formData = new FormData(this);  var doAction = '" . weburl . $tabel . "/update';  $.ajax({ url: doAction, type: 'POST', data: formData, success: function (msg) { if(msg == 'Y'){ document.getElementById('" . $idbutton . "').disabled = false; document.getElementById('" . $idbutton . "').innerHTML = '" . $labelbutton . "'; " . $setload . " berhasil('Data " . $tabel . " baru telah diperbarui'); return false;  }else{ document.getElementById('" . $idbutton . "').disabled = false; document.getElementById('" . $idbutton . "').innerHTML = '" . $labelbutton . "'; gagal(msg);  return false; }  return false;  },  cache: false, contentType: false, processData: false }); return false;  } }); ";

        Reader::validasi($method, $tabel, $txt);

        echo "</form>";
    }

    public static function delete($page)
    {
        //Reader::acak();
        return '
        <form id="formhapus" name="formhapus" method="POST" action="' . weburl . $page . '/delete" style="float: left;" onClick="return hapus({{ID}})">
            <input type="hidden" value="' . weburl . $page . '" id="url" name="url">
            <input type="hidden" value="' . Reader::token() . '" id="_token" name="_token">
            <input type="hidden" value="{{ID}}" id="id" name="id">
            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
        </form>';
    }
}
