<?php

use AbieSoft\Sistem\Utility\Config;
use AbieSoft\Sistem\Magic\Form;
?>
<section id='content'>
    <section class='vbox'>
        <section class='scrollable padder'>
            <ul class='breadcrumb no-border no-radius b-b b-light pull-in'>
                <li><a href=''><i class='fa fa-home'></i> Home</a></li>
                <li><a href='<?php echo weburl; ?>grup'>Grup</a></li>
                <li class='active'>baru</li>
            </ul>
            <div class='m-b-md'>
                <h3 class='m-b-none'>Buat Grup Baru</h3>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <section class="panel panel-default">
                        <div class="panel-body">
                            <?php
                            Form::create('grup', 'create', array(
                                'Nama' => ['input', 'nama', 'Nama Grup', 'setText'],
                                'Akses' => ['textarea', 'akses', 'Akses page users,profile ....', 'setText'],
                                'Action' => ['textarea', 'act', 'Action: users_index, users_baru ...', 'setText'],
                                'Menu' => ['textarea', 'menu', 'Menu: home, grup, users ...', 'setText'],
                                'Simpan' => ['submit', 'btnsimpangrup']
                            ));
                            ?>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </section>
    <a href='#' class='hide nav-off-screen-block' data-toggle='class:nav-off-screen' data-target='#nav'></a>
</section>