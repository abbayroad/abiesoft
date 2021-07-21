<?php

use AbieSoft\Sistem\Magic\Reader;
?>
<div class='container-auth'>
    <div class='auth-box br10'>
        <div class='w50 ilustrasi'>
            <img src="/asset/properti/ilustrasi/il_login.png">
        </div>
        <div class='w50'>
            <form method='post' action='' id='registrasi' name='registrasi'>
                <h1>Registrasi</h1>
                <span>Form Registrasi User Baru</span>
                <div id='msg_error'></div>
                <div class='form-control'>
                    <input type='text' id='nama' name='nama' placeholder="Nama">
                </div>
                <div class='form-control'>
                    <input type='text' id='username' name='username' placeholder="Username">
                </div>
                <div class='form-control'>
                    <input type='text' id='email' name='email' placeholder="Email">
                </div>
                <div class='form-control'>
                    <input type='password' id='password' name='password' placeholder="Password">
                    <i class="fa fa-eye"></i>
                </div>
                <div class='form-bottom'>
                    <input type='hidden' value='<?php echo Reader::token(); ?>' id='_token' name='_token'>
                    <button class='clear' type='button' onclick="window.location.href='/login'">&#8592; Login</button>
                    <button id='btnregistrasi' type='submit'>Registrasi</button>
                </div>
            </form>
        </div>
    </div>
</div>