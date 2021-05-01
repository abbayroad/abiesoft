$('#jltampil').on('change',function(){
    $('.pagination').html();
    var trNum = -1;
    var maxTampil = parseInt($(this).val());
    $('table tr:not(#notfound):gt(0)').each(function(){
        trNum++;
        if(trNum > maxTampil){
            $(this).hide();
        }
        if(trNum <= maxTampil){
            $(this).show();
        }
    });
});

$('#search').keyup(function(){
    var search = $(this).val();
    $('table tbody tr').hide();
    var len = $('table tbody tr:not(#notfound) td:contains("'+search+'")').length;
    if(len > 0){
        $('table tbody tr:not(#notfound) td:contains("'+search+'")').each(function(){
            $(this).closest('tr').show();
        });
    }else{
        $('#notfound').show();
    }
});

function pagination(data,page,row){

}

function loadtabel(){

    var tabel = document.querySelector('tbody');
    var total = document.getElementById('total');
    var loading = document.getElementById('loading');
    var trNum = -1;
    var maxTampil = 10;
    loading.innerHTML = "<tr><td colspan='4'>Loading..</td></tr>";
    total.innerHTML = 0;
    var serverdata = "/users/data";
    $.ajax({
        url: serverdata,
        success: function(msg) {

            var data = JSON.parse(msg);
            var jumlahrow = data.length / maxTampil;
            var datapage = pagination(data,maxTampil,jumlahrow); 
            var no = 1;
            for(var i = 0; i < data.length; i++){
                var tr = `<tr>
                    <td>${no}</td>
                    <td>${data[i].nama}</td>
                    <td>${data[i].email}</td>
                    <td>${data[i].phone}</td>
                    <td>${data[i].opsi}</td>
                </tr>`;
                no++;
                loading.innerHTML = "";
                tabel.innerHTML += tr;
                total.innerHTML = "Total Grup " + data.length;
            } 

            $('table tr:not(#notfound):gt(0)').each(function(){
                trNum++;
                if(trNum > maxTampil){
                    $(this).hide();
                }
                if(trNum <= maxTampil){
                    $(this).show();
                }
            });

        }
    });
}

loadtabel();




