<?php

use AbieSoft\Sistem\Magic\Reader;
?>
<div class='container-auth'>
    <div class='auth-box br10'>
        <div class='w50 ilustrasi'>
            <img src="/asset/properti/icon/logo_abiesoft.png">
        </div>
        <div class='w50'>
            <form method='post' id='login' name='login'>
                <h1>Login</h1>
                <span>Halo, selamat datang kembali di <?php echo namaweb . " " . infoweb; ?></span>
                <div id='msg_error'></div>
                <div class='form-control'>
                    <input type='text' id='username' name='username' placeholder="Username">
                </div>
                <div class='form-control'>
                    <input type='password' id='password' name='password' placeholder="Password">
                    <span id='btnShowHidePass' onclick="showPass()"><i class="fa fa-eye"></i></span>
                </div>
                <div class='form-bottom'>
                    <input type='hidden' value='<?php echo Reader::token(); ?>' id='_token' name='_token'>
                    <button id='btnlogin' type='submit'>Login</button>
                    <button class='clear' type='button' onclick="window.location.href='/registrasi'">Registrasi &#8594;</button>
                </div>
            </form>
        </div>
    </div>
</div>