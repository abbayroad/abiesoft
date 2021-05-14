//Toggle Menu
$('.menu-toggle').click(function (){
    if(document.getElementById('sidebar-toggle').checked) {
        document.getElementById('sidebar-toggle').checked = false;
    }else{
        document.getElementById('sidebar-toggle').checked = true;
    }
});


//Drop Down Menu
function showmenudropdown() {
    document.getElementById("menudropdown").classList.toggle("show");
}

window.onclick = function(event) {
    if (!event.target.matches('#dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
        }
        }
    }
}