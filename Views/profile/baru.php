<?php

use AbieSoft\Sistem\Utility\Config;
use AbieSoft\Sistem\Magic\Form;
?>
<section id='content'>
    <section class='vbox'>
        <section class='scrollable padder'>
            <ul class='breadcrumb no-border no-radius b-b b-light pull-in'>
                <li><a href=''><i class='fa fa-home'></i> Home</a></li>
                <li><a href='<?php echo weburl; ?>profile'>Profile</a></li>
                <li class='active'>baru</li>
            </ul>
            <div class='m-b-md'>
                <h3 class='m-b-none'>Buat Profile Baru</h3>
                <p>
                    <?php
                    Form::create('profile', 'create', array(
                        'Nama' => ['input', 'nama', 'Nama anda', 'setText'],
                        'Email' => ['email', 'email', 'Email Anda', 'setEmail'],
                        'No. Hp' => ['phone', 'phone', 'No Telepon', 'setNoHp'],
                        'Simpan' => ['submit', 'simpanuserbaru']
                    ));
                    ?>
                </p>
            </div>
        </section>
    </section>
    <a href='#' class='hide nav-off-screen-block' data-toggle='class:nav-off-screen' data-target='#nav'></a>
</section>