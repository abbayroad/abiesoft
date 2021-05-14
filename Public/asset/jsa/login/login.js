$('form#loginform').submit(function(e) {
    e.preventDefault();
    var email = document.forms['loginform']['email'].value;
    var password = document.forms['loginform']['password'].value;
    if (setEmail(email)) {
        gagal('Email ' + setEmail(email));
        document.getElementById('email').focus();
        return false;
    } else if (setText(password)) {
        gagal('Password ' + setText(password));
        document.getElementById('password').focus();
        return false;
    } else {
        document.getElementById('btnlogin').disabled = true;
        document.getElementById('btnlogin').innerHTML = 'Login...';
        var formData = new FormData(this);
        var doAction = 'login';
        $.ajax({
            url: doAction,
            type: 'POST',
            data: formData,
            success: function(msg) {
                if (msg == 'Y') {
                    window.location.href = "/";
                    return false;
                } else if (msg == 'Password salah') {
                    document.getElementById('btnlogin').disabled = false;
                    document.getElementById('btnlogin').innerHTML = 'Login Aplikasi';
                    document.getElementById('password').value = '';
                    gagal(msg);
                    document.getElementById('konfirmasi').innerHTML = '<div style="text-align: center; margin-top: 10px;"><a href="/konfirmasi" class="konfirmasi">Lupa password?</a></div>';
                    return false;
                } else {
                    document.getElementById('btnlogin').disabled = false;
                    document.getElementById('btnlogin').innerHTML = 'Login Aplikasi';
                    document.getElementById('password').value = '';
                    gagal(msg);
                    return false;
                }
                return false;
            },
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
    }
});