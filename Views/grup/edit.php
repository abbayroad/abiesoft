<?php

use AbieSoft\Sistem\Magic\Form;
?>
<main>
    <div class="page-header">
        <h1>Edit Grup</h1>
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
            </div>
        </div>
    </section>
</main>