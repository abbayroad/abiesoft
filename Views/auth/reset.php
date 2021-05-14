<?php

use AbieSoft\Sistem\Utility\Session;
use AbieSoft\Sistem\Http\Lanjut;
use AbieSoft\Sistem\Magic\Reader;

Reader::acak();

if (Session::ada('reset')) {
?>
    <div class="main-login">
        <div class="card-login">
            <div class="card-login-header">
                <div class="logo-login">
                    <img src="<?php echo weburl; ?>asset/properti/logo_biru.png" alt="">
                </div>
                <div class="center">
                    AbieSoft Reset Password
                </div>
            </div>
            <form action="index.php" method="POST" id="resetform" name="resetform">
                <div class="form-group">
                    <label for="passwordbaru">Password Baru</label>
                    <input type="password" id="passwordbaru" name="passwordbaru" placeholder="Password baru" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="konfirmasipassword">Konfirmasi Password</label>
                    <input type="password" id="konfirmasipassword" name="konfirmasipassword" placeholder="Konfirmasi Password" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <?php
                    echo "<input type='hidden' id='kode_reset' name='kode_reset' value='" . Session::lihat('reset') . "'>";
                    echo "<input type='hidden' id='email' name='email' value='" . Session::lihat('email') . "'>";
                    echo CSRF;
                    ?>
                    <button type="submit" class="button full"><span id='btnreset'>Simpan perubahan</span></button>
                </div>
            </form>
        </div>
    </div>
<?php
    Session::hapus('reset');
    Session::hapus('email');
} else {
    Lanjut::ke('/login');
}
?>