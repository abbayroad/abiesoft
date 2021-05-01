$('form#konfirmasiform').submit(function(e) {
    e.preventDefault();
    var jawaban = document.forms['konfirmasiform']['jawaban'].value;
    if (setText(jawaban)) {
        gagal('Jawaban ' + setText(jawaban));
        document.getElementById('jawaban').focus();
        return false;
    } else {
        document.getElementById('btnkonfirmasi').disabled = true;
        document.getElementById('btnkonfirmasi').innerHTML = 'Mengirim...';
        var formData = new FormData(this);
        var doAction = 'konfirmasi';
        $.ajax({
            url: doAction,
            type: 'POST',
            data: formData,
            success: function(msg) {
                if (msg == 'Y') {
                    window.location.href = "/reset";
                    return false;
                } else {
                    document.getElementById('btnkonfirmasi').disabled = false;
                    document.getElementById('btnkonfirmasi').innerHTML = 'Kirim Jawaban';
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