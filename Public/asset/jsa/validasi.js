function setPilihan(txt){
    if(txt == "" || txt == null){
        var status = "belum dipilih";
        return status;
    }
}

function setClean(txt){
    if(txt == "" || txt == null){
        var status = "jangan dikosongkan";
        return status;
    }
}

function setSimpel(txt){
    if(txt == "" || txt == null){
        var status = "jangan dikosongkan";
        return status;
    }else if(txt.length <= 1){
        var status = "minimal 2 huruf";
        return status;
    }
}

function setText(txt){
    if(txt == "" || txt == null){
        var status = "jangan dikosongkan";
        return status;
    }else if(txt.length <= 3){
        var status = "minimal 4 huruf";
        return status;
    }
}

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function setEmail(txt){
    if(txt == "" || txt == null){
        var status = "jangan dikosongkan";
        return status;
    }else if(txt.length <= 3){
        var status = "minimal 4 huruf";
        return status;
    }else if(!validateEmail(txt)){
        var status = "format email salah";
        return status;
    }
}

function setAngka(txt){
    if(txt == "" || txt == null){
        var status = "jangan dikosongkan";
        return status;
    }else if(txt.length <= 3){
        var status = "minimal 4 angka";
        return status;
    }else if(isNaN(txt)){
        var status = "harus angka";
        return status;
    }
}

function setAngkaOnly(txt){
    if(txt == "" || txt == null){
        var status = "jangan dikosongkan";
        return status;
    }else if(isNaN(txt)){
        var status = "harus angka";
        return status;
    }
}

function setNoHp(txt){
    if(txt == "" || txt == null){
        var status = "jangan dikosongkan";
        return status;
    }else if(txt.length <= 9){
        var status = "minimal 10 angka";
        return status;
    }else if(isNaN(txt)){
        var status = "harus angka";
        return status;
    }
}