<?php

use AbieSoft\Sistem\Magic\Form;
?>
<section id='content'>
    <section class='vbox'>
        <section class='scrollable padder'>
            <ul class='breadcrumb no-border no-radius b-b b-light pull-in'>
                <li><a href=''><i class='fa fa-home'></i> Home</a></li>
                <li><a href='<?php echo weburl; ?>grup'>Grup</a></li>
                <li class='active'>edit</li>
            </ul>
            <div class='m-b-md'>
                <h3 class='m-b-none'>Edit Grup</h3>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <section class="panel panel-default">
                        <div class="panel-body">
                            <?php
                            foreach ($data['grup'] as $grup) {
                                Form::update('grup', 'update', array(
                                    'Nama' => ['input', 'nama', 'Nama Grup', 'setText', $grup->nama],
                                    'Akses' => ['textarea', 'akses', 'Akses page users,profile ....', 'setText', $grup->akses],
                                    'Action' => ['textarea', 'act', 'Action: users_index, users_baru ...', 'setText', $grup->act],
                                    'Menu' => ['textarea', 'menu', 'Menu: home, grup, users ...', 'setText', $grup->menu],
                                    'Simpan Perubahan' => ['submit', 'btnupdategrup']
                                ), $grup->id);
                            }
                            ?>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </section>
    <a href='#' class='hide nav-off-screen-block' data-toggle='class:nav-off-screen' data-target='#nav'></a>
</section>