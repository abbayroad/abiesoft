function setnama(){
    var url = 'http://127.0.0.1:8000/setprofilenama';
    $.ajax({
        url: url,
        success: function(msg) {
            document.getElementById('setnama1').innerHTML = msg;
            document.getElementById('setnama2').innerHTML = "Profile  " + msg;
            document.getElementById('setnama3').innerHTML = msg;
        }
    });
}

function setemail(){
    var url = 'http://127.0.0.1:8000/setprofileemail';
    $.ajax({
        url: url,
        success: function(msg) {
            document.getElementById('setemail').innerHTML = msg;
        }
    });
}

function setphone(){
    var url = 'http://127.0.0.1:8000/setprofilephone';
    $.ajax({
        url: url,
        success: function(msg) {
            document.getElementById('setphone').innerHTML = msg;
        }
    });
}

function setphoto(){
    var url = 'http://127.0.0.1:8000/setprofilephoto';
    $.ajax({
        url: url,
        success: function(msg) {
            document.getElementById('setphoto1').innerHTML = '<img src="'+msg+'">';
            document.getElementById('setphoto2').innerHTML = '<img src="'+msg+'" class="img-circle">';
        }
    });
}