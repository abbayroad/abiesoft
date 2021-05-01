<?php

use AbieSoft\Sistem\Magic\Form; ?>
<section id='content'>
    <section class='vbox'>
        <section class='scrollable padder'>
            <ul class='breadcrumb no-border no-radius b-b b-light pull-in'>
                <li><a href=''><i class='fa fa-home'></i> Home</a></li>
                <li><a href='<?php echo weburl; ?>users'>Users</a></li>
                <li class='active'>Edit</li>
            </ul>
            <div class='m-b-md'>
                <h3 class='m-b-none'>Edit Users</h3>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <section class="panel panel-default">
                        <div class="panel-body">
                            <?php
                            foreach ($data['users'] as $ud) {
                                Form::update('users', 'update', array(
                                    'Nama' => ['input', 'nama', 'Nama User', 'setText', $ud->nama],
                                    'Email' => ['email', 'email', 'Email', 'setEmail', $ud->email],
                                    'Phone' => ['phone', 'phone', 'No. Hp', 'setNoHp', $ud->phone],
                                    'Simpan' => ['submit', 'btnsimpanperubahan']
                                ), $ud->id);
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