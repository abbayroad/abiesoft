<?php

use AbieSoft\Sistem\Utility\Session;
use AbieSoft\Sistem\Http\Lanjut;

if (Session::ada('reset')) {
?>
    <section id="content" class="m-t-md wrapper-md animated fadeInUp">
        <div class="container aside-xxl">
            <div class='text-center'>
                <img src="<?php echo weburl; ?>asset/images/logo.png" alt="Logo Polres Tangerang Selatan" style='width: 70px; margin-top: 50px;'>
            </div>
            <span class="navbar-brand block" style='color: #111;'><span class='text-primary'>AbieSoft</span> | Reset Password</span>
            <section class="panel panel-default bg-white m-t-md">
                <form action="" id="resetform" name="resetform" class="panel-body wrapper-md">
                    <div class="form-group">
                        <label class="control-label">Password Baru</label>
                        <input type="password" id="passwordbaru" name="passwordbaru" placeholder="Password baru" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Konfirmasi Password</label>
                        <input type="password" id="konfirmasipassword" name="konfirmasipassword" placeholder="Konfirmasi Password" class="form-control" autocomplete="off">
                    </div>
                    <?php
                    echo "<input type='hidden' id='kode_reset' name='kode_reset' value='" . Session::lihat('reset') . "'>";
                    echo "<input type='hidden' id='email' name='email' value='" . Session::lihat('email') . "'>";
                    echo CSRF;
                    ?>
                    <button type="submit" class="btn btn-primary"><span id='btnreset'>Simpan perubahan</span></button>
                    <!-- <div class="line line-dashed"></div>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a href="signup.html" class="btn btn-default btn-block">Create an account</a> -->
                </form>
            </section>
        </div>
    </section>
<?php
    Session::hapus('reset');
    Session::hapus('email');
} else {
    Lanjut::ke('/login');
}
?>