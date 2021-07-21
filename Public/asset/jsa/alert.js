function gagal(txtStatus) { 
    document.getElementById('msg_error').innerHTML = "<span class='msg_danger'>"+txtStatus+"</span>";
    return false;
}

function informasi(txtStatus) {
    document.getElementById('msg_error').innerHTML = "<span class='msg_warning'>"+txtStatus+"</span>";
    return false;
}

function berhasil(txtStatus) {
    document.getElementById('msg_error').innerHTML = "<span class='msg_success'>"+txtStatus+"</span>";
    return false;
}

function hapus(ID){
    var urlhapus = document.forms['formhapus']['url'].value;

    var returndetailkonfirmasi = function () {
        var detailhapus = "";
        $.ajax({
            async: false,
            global: false,
            url:urlhapus+"?id="+ID+"/konfirmasi",
            type: "GET",
            success:function(msgkonfirmasi) {
                detailhapus = msgkonfirmasi;
            }
        });
        return detailhapus;
    }();

    konfirmasi = confirm("Ingin hapus data " + returndetailkonfirmasi + "?");
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
