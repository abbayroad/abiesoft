var baseurl = "http://127.0.0.1:8000/";
$('form#registrasi').submit(function(e) {
    e.preventDefault();
    var nama = document.forms['registrasi']['nama'].value;
    var username = document.forms['registrasi']['username'].value;
    var email = document.forms['registrasi']['email'].value;
    var password = document.forms['registrasi']['password'].value;
    var btnregistrasi = document.getElementById('btnregistrasi');
    if (setText(nama)) {
        gagal('Nama ' + setText(nama));
        document.getElementById('nama').focus();
        return false;
    }else if (setText(username)) {
        gagal('Username ' + setText(username));
        document.getElementById('username').focus();
        return false;
    } else if (setEmail(email)) {
        gagal('Email ' + setEmail(email));
        document.getElementById('email').focus();
        return false;
    } else if (setText(password)) {
        gagal('Password ' + setText(password));
        document.getElementById('password').focus();
        return false;
    } else {
        btnregistrasi.innerHTML = "Menyimpan..";
        var formData = new FormData(this);
        var doAction = baseurl +'registrasi';
        $.ajax({
            url: doAction,
            type: 'POST',
            data: formData,
            success: function(msg) {
                if(msg == "Y"){
                    berhasil('Registrasi berhasil');
                    btnregistrasi.innerHTML = "Registrasi";
                    document.getElementById('nama').value = "";
                    document.getElementById('username').value = "";
                    document.getElementById('email').value = "";
                    document.getElementById('password').value = "";
                    return false;
                }else{
                    gagal(msg);
                    btnregistrasi.innerHTML = "Registrasi";
                    document.getElementById('password').value = "";
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
