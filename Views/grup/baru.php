<?php

use AbieSoft\Sistem\Magic\Form;
?>
<main>
    <div class="page-header">
        <h1>Buat Grup</h1>
        <div class="header-opsi">
            <button onClick=window.location.href="<?php echo weburl; ?>grup">
                <span class="las la-bars"></span>
                <span class="label-opsi">List</span>
            </button>
        </div>
    </div>
    <section class="grid">
        <div class="row">
            <div class="col-12">
                <div class="card">
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
            </div>
        </div>
    </section>
</main>