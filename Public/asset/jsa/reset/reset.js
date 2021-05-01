$('form#resetform').submit(function(e) {
    e.preventDefault();
    var passwordbaru = document.forms['resetform']['passwordbaru'].value;
    var konfirmasipassword = document.forms['resetform']['konfirmasipassword'].value;
    if (setText(passwordbaru)) {
        gagal('Password baru ' + setText(passwordbaru));
        document.getElementById('passwordbaru').focus();
        return false;
    }else if (konfirmasipassword != passwordbaru) {
        gagal('Konfirmasi password harus sama dengan password baru');
        document.getElementById('konfirmasipassword').focus();
        return false;
    } else {
        document.getElementById('btnreset').disabled = true;
        document.getElementById('btnreset').innerHTML = 'Menyimpan perubahan...';
        var formData = new FormData(this);
        var doAction = 'reset';
        $.ajax({
            url: doAction,
            type: 'POST',
            data: formData,
            success: function(msg) {
                if (msg == 'Y') {
                    window.location.href = "/login";
                    return false;
                } else {
                    document.getElementById('btnreset').disabled = false;
                    document.getElementById('btnreset').innerHTML = 'Simpan Perubahan';
                    document.getElementById('jawaban').value = '';
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