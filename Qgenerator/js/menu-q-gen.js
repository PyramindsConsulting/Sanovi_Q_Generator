$(document).ready(function () {
    var screen_width = screen.width;
//    alert(screen_width);
    if(screen_width<=767){
        document.getElementById("mainmenu_mobile_div").style.display="block";
        document.getElementById("mainmenu_div").style.display="none";
        
    }else if(screen_width > 767){
        document.getElementById("mainmenu_mobile_div").style.display="none";
        document.getElementById("mainmenu_div").style.display="block";
    }
});
function change_menus(){
    var screen_width = screen.width;
//    alert(screen_width);
    if(screen_width<=767){
        document.getElementById("mainmenu_mobile_div").style.display="block";
        document.getElementById("mainmenu_div").style.display="none";
    }else if(screen_width > 767){
        document.getElementById("mainmenu_mobile_div").style.display="none";
        document.getElementById("mainmenu_div").style.display="block";
    }
}