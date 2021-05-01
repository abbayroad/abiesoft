function gagal(txtStatus) { 
    alert(txtStatus);
    return false;
}

function informasi(txtStatus) {
    alert(txtStatus);
    return false;
}

function berhasil(txtStatus) {
    alert(txtStatus);
    return false;
}

function hapus(ID){
    var konfirmasi = confirm("Ingin harus data? " + ID);
    if (konfirmasi == true) {
        var formData = new FormData(this);
        $.ajax({
            url:$(this).attr("action"),
            data:formData,
            type: "POST",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            success:function(msg) {
                alert(msg);
                return false;
            },
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
    }
    return false;
}