<?php

use AbieSoft\Sistem\Utility\Session;
use AbieSoft\Sistem\Magic\Reader;

Reader::acak();
?>
<div class="main-login">
    <div class="card-login">
        <div class="card-login-header">
            <div class="logo-login">
                <img src="<?php echo weburl; ?>asset/properti/logo_biru.png" alt="">
            </div>
            <div class="center">
                AbieSoft Login
            </div>
        </div>
        <form method="" action="" id="loginform" name="loginform">
            <?php
            if (Session::ada('passwordbaru')) {
                echo "<div>" . Session::lihat('passwordbaru') . "</div>";
                Session::hapus('passwordbaru');
            }
            ?>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="test@example.com" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" class="form-control" autocomplete="off">
            </div>
            <div class="form-group">
                <?php echo CSRF; ?>
                <button type="submit" class="button full"><span id='btnlogin'>Login Aplikasi</span></button>
                <span id='konfirmasi'></span>
            </div>
        </form>
    </div>
</div>