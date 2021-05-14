<?php

use AbieSoft\Sistem\Utility\Session;
use AbieSoft\Sistem\Http\Lanjut;
use AbieSoft\Sistem\Magic\Reader;

Reader::acak();

if (Session::ada('konfirmasi')) {
?>
    <div class="main-login">
        <div class="card-login">
            <div class="card-login-header">
                <div class="logo-login">
                    <img src="<?php echo weburl; ?>asset/properti/logo_biru.png" alt="">
                </div>
                <div class="center">
                    AbieSoft Konfirmasi Akun
                </div>
            </div>
            <form action="" method="POST" id="konfirmasiform" name="konfirmasiform">
                <div class="form-group">
                    <label for="email">Pertanyaan</label>
                    <div><?php echo Session::lihat('konfirmasi'); ?></div>
                    <input type="hidden" id="email" name="email" value="<?php echo Session::lihat('email'); ?>">
                </div>
                <div class="form-group">
                    <label for="jawaban">Jawaban</label>
                    <input type="password" id="jawaban" name="jawaban" placeholder="Jawaban anda?" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <?php echo CSRF; ?>
                    <button type="submit" class="button full"><span id='btnkonfirmasi'>Kirim Jawaban</span></button>
                </div>
            </form>
        </div>
    </div>
<?php
    Session::hapus('konfirmasi');
    Session::hapus('email');
} else {
    Lanjut::ke('/login');
}
?>