var baseurl = "http://127.0.0.1:8000/";
$('form#login').submit(function(e) {
    e.preventDefault();
    var username = document.forms['login']['username'].value;
    var password = document.forms['login']['password'].value;
    var btnlogin = document.getElementById('btnlogin');
    if (setText(username)) {
        gagal('Username ' + setText(username));
        document.getElementById('username').focus();
        return false;
    } else if (setText(password)) {
        gagal('Password ' + setText(password));
        document.getElementById('password').focus();
        return false;
    } else {
        var formData = new FormData(this);
        var doAction = baseurl + 'login';
        $.ajax({
            url: doAction,
            type: 'POST',
            data: formData,
            success: function(msg) {
                if(msg == "Y"){
                    window.location.href= baseurl +'wellcome';
                }else{
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

function showPass(){
    document.getElementById('btnShowHidePass').innerHTML="<i class='fa fa-eye-slash'></i>";
    $('#btnShowHidePass').attr('onClick', 'hidePass()');
    $('#password').attr('type', 'text');
    return false;
}

function hidePass(){
    document.getElementById('btnShowHidePass').innerHTML="<i class='fa fa-eye'></i>";
    $('#btnShowHidePass').attr('onClick', 'showPass()');
    $('#password').attr('type', 'password');
    return false;
}