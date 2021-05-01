<?php

use AbieSoft\Sistem\Utility\Session;
use AbieSoft\Sistem\Http\Lanjut;

if (Session::ada('konfirmasi')) {
?>
    <section id="content" class="m-t-md wrapper-md animated fadeInUp">
        <div class="container aside-xxl">
            <div class='text-center'>
                <img src="<?php echo weburl; ?>asset/images/logo.png" alt="Logo Polres Tangerang Selatan" style='width: 70px; margin-top: 50px;'>
            </div>
            <span class="navbar-brand block" style='color: #111;'><span class='text-primary'>AbieSoft</span> | Konfirmasi Password</span>
            <section class="panel panel-default bg-white m-t-md">
                <form action="" id="konfirmasiform" name="konfirmasiform" class="panel-body wrapper-md">
                    <div class="form-group">
                        <label class="control-label">Pertanyaan</label>
                        <div class='display-4'><?php echo Session::lihat('konfirmasi'); ?></div>
                        <input type="hidden" id="email" name="email" value="<?php echo Session::lihat('email'); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Konfirmasi jawaban</label>
                        <input type="password" id="jawaban" name="jawaban" placeholder="Jawaban anda?" class="form-control" autocomplete="off">
                    </div>
                    <?php echo CSRF; ?>
                    <button type="submit" class="btn btn-primary"><span id='btnkonfirmasi'>Kirim Jawaban</span></button>
                    <!-- <div class="line line-dashed"></div>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a href="signup.html" class="btn btn-default btn-block">Create an account</a> -->
                </form>
            </section>
        </div>
    </section>
<?php
    Session::hapus('konfirmasi');
    Session::hapus('email');
} else {
    Lanjut::ke('/login');
}
?>