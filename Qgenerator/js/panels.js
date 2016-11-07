$(document).ready(function () {
    
    var site_2_normal1=document.getElementById('share_server_2s').value;
    var site_2_normal2=document.getElementById('virtual_sharepoint_server_2s').value;
    var site_2_normal3=document.getElementById('prod_ms_2s').value;
    var site_2_normal4=document.getElementById('prod_v_ms_2s').value;
    var site_2_normal5=document.getElementById('servers_2s').value;
    
    if((site_2_normal1=="")||(site_2_normal2=="")||(site_2_normal3=="")||(site_2_normal4=="")||(site_2_normal5=="")){
        $("#2_site_panel").hide(1000);
        document.getElementById('less1').style.display = "none";
        document.getElementById('button1').style.display = "inline";    
    }else if((site_2_normal1!=0)||(site_2_normal2!=0)||(site_2_normal3!=0)||(site_2_normal4!=0)||(site_2_normal5!=0)){
        $("#2_site_panel").show(1000);
        document.getElementById('less1').style.display = "inline";
        document.getElementById('button1').style.display = "none";
    }else{  
        $("#2_site_panel").hide(1000);
        document.getElementById('less1').style.display = "none";
        document.getElementById('button1').style.display = "inline";   
    }
        var site_3_normal1=document.getElementById('share_server_3s').value;
        var site_3_normal2=document.getElementById('virtual_server_3s').value;
        var site_3_normal3=document.getElementById('prod_ms_3s').value;
        var site_3_normal4=document.getElementById('prod_v_ms_3s').value;
        var site_3_normal5=document.getElementById('servers_3s').value;

        if((site_3_normal1=="")||(site_3_normal2=="")||(site_3_normal3=="")||(site_3_normal4=="")||(site_3_normal5=="")){
            $("#3_site_panel").hide(1000);
            document.getElementById('less2').style.display = "none";
            document.getElementById('button2').style.display = "inline";    
        }else if((site_3_normal1!=0)||(site_3_normal2!=0)||(site_3_normal3!=0)||(site_3_normal4!=0)||(site_3_normal5!=0)){
            $("#3_site_panel").show(1000);
            document.getElementById('less2').style.display = "inline";
            document.getElementById('button2').style.display = "none";
        }else{  
            $("#3_site_panel").hide(1000);
            document.getElementById('less2').style.display = "none";
            document.getElementById('button2').style.display = "inline";   
        }
});