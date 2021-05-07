<?php

use AbieSoft\Sistem\Utility\Session;
use AbieSoft\Sistem\Magic\Reader;

Reader::acak();
?>
<section id="content" class="m-t-md wrapper-md animated fadeInUp">
    <div class="container aside-xxl">
        <div class='text-center'>
            <img src="<?php echo weburl; ?>asset/images/logo.png" alt="Logo Polres Tangerang Selatan" style='width: 70px; margin-top: 50px;'>
        </div>
        <span class="navbar-brand block" style='color: #111;'><span class='text-primary'>AbieSoft</span> | Login</span>
        <section class="panel panel-default bg-white m-t-md">
            <form action="" id="loginform" name="loginform" class="panel-body wrapper-md">
                <?php
                if (Session::ada('passwordbaru')) {
                    echo "<div class='bg-success' style='padding: 20px; margin-bottom: 20px;'>" . Session::lihat('passwordbaru') . "</div>";
                    Session::hapus('passwordbaru');
                }
                ?>
                <div class="form-group">
                    <label class="control-label">Email</label>
                    <input type="email" id="email" name="email" placeholder="test@example.com" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" class="form-control" autocomplete="off">
                </div>
                <span id='konfirmasi'></span>
                <?php echo CSRF; ?>
                <button type="submit" class="btn btn-primary"><span id='btnlogin'>Login Aplikasi</span></button>
                <!-- <div class="line line-dashed"></div>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a href="signup.html" class="btn btn-default btn-block">Create an account</a> -->
            </form>
        </section>
    </div>
</section>