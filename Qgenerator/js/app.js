$(document).ready(function () {
    $('form input').on('keypress', function (e) {
        return e.which !== 13;
    });
    $('[data-toggle="tooltip"]').tooltip();
    $("#requirements").hide();
    $('#button1').click(function () {
        $("#2_site_panel").show(1000);
        document.getElementById('less1').style.display = "inline";
        document.getElementById('button1').style.display = "none";
    });
    $('#less1').click(function () {
        $("#2_site_panel").hide(1000);
        document.getElementById('button1').style.display = "inline";
        document.getElementById('less1').style.display = "none";
    });
    $('#button2').click(function () {
        $("#3_site_panel").show(1000);
        document.getElementById('less2').style.display = "inline";
        document.getElementById('button2').style.display = "none";
    });
    $('#less2').click(function () {
        $("#3_site_panel").hide(1000);
        document.getElementById('button2').style.display = "inline";
        document.getElementById('less2').style.display = "none";
    });
    $('#button3').click(function () {
        $("#prof_panel").show(1000);
        document.getElementById('less3').style.display = "inline";
        document.getElementById('button3').style.display = "none";
    });
    $('#less3').click(function () {
        $("#prof_panel").hide(1000);
        document.getElementById('button3').style.display = "inline";
        document.getElementById('less3').style.display = "none";
    });
    $('#userRequirements').click(function () {
        $("#crumbs ul li #quote_request").addClass("active");
        $("#crumbs ul li #config_review").addClass("active");
        $("#crumbs ul li #review_and_discount").removeClass("active");
        $("#crumbs ul li #quote_finalize").removeClass("active");
    });
    $('#partial').click(function () {
        $("#panel3").show(1000);
        document.getElementById('personalpanel1').style.display = "inline";
        document.getElementById('button3').style.display = "inline";
        document.getElementById('less3').style.display = "none";
    });
    $('#full').click(function () {
        $("#panel3").hide(1000);
        $("#prof_panel").hide(1000);
        document.getElementById('personalpanel1').style.display = "none";
        document.getElementById('button3').style.display = "none";
        document.getElementById('less3').style.display = "none";
    });
    $('#backbutton').click(function () {
        $("#requirements").hide(1000);
        $("#professionalsection").show(1000);
        //        document.getElementById('personalpanel1').style.display = "none";
        //        document.getElementById('button3').style.display = "none";
        //        document.getElementById('less3').style.display = "none";
    });
    $('#userRequirements').click(function () {
        $('#product').text($('#productname').val());
        $('#LicenseName').text($('#license').val());
        $('#countryName').text($('#country').val());
        $('#currencyName').text($('#currency').val());
        $('#organizationName').text($('#name').val());
        $('#customer').text($('#customer_name').val());
        $('#Partner_Name').text($('#partner').val());
        $('#modeOfSale').text($('#mode_of_sale').val());
        $('#module').text($('#product_module').val());
        if ($('#vm_images_2s').val() == "") {
            $('#vm_image_2').hide();
        }
        else {
            $('#Vm_image_2').text($('#vm_images_2s').val());
        }
        if ($('#db_2s').val() == "") {
            $('#vm_db_2').hide();
        }
        else {
            $('#Vm_db_2').text($('#db_2s').val());
        }
        if ($('#b_windows_datas_2s').val() == "") {
            $('#bm_w_2').hide();
        }
        else {
            $('#Bm_w_2').text($('#b_windows_datas_2s').val());
        }
        if ($('#b_windows_db_2s').val() == "") {
            $('#bm_wd_2').hide();
        }
        else {
            $('#Bm_wd_2').text($('#b_windows_db_2s').val());
        }
        if ($('#b_unix_datas_2s').val() == "") {
            $('#bm_u_2').hide();
        }
        else {
            $('#Bm_u_2').text($('#b_unix_datas_2s').val());
        }
        if ($('#b_unix_db_2s').val() == "") {
            $('#bm_ud_2').hide();
        }
        else {
            $('#Bm_ud_2').text($('#b_unix_db_2s').val());
        }
        if ($('#prod_servers_2s').val() == "") {
            $('#bm_sar_2').hide();
        }
        else {
            $('#Bm_sar_2').text($('#prod_servers_2s').val());
        }
        if ($('#virtual_prod_2s').val() == "") {
            $('#vm_sar_2').hide();
        }
        else {
            $('#Vm_sar_2').text($('#virtual_prod_2s').val());
        }
        if ($('#share_server_2s').val() == "") {
            $('#s_s_2').hide();
        }
        else {
            $('#S_s_2').text($('#share_server_2s').val());
        }
        if ($('#virtual_sharepoint_server_2s').val() == "") {
            $('#v_s_s_2').hide();
        }
        else {
            $('#V_s_s_2').text($('#virtual_sharepoint_server_2s').val());
        }
        if ($('#prod_ms_2s').val() == "") {
            $('#prod_ms_2').hide();
        }
        else {
            $('#Prod_ms_2').text($('#prod_ms_2s').val());
        }
        if ($('#prod_v_ms_2s').val() == "") {
            $('#prod_v_ms_2').hide();
        }
        else {
            $('#Prod_v_ms_2').text($('#prod_v_ms_2s').val());
        }
        if ($('#servers_2s').val() == "") {
            $('#server_2').hide();
        }
        else {
            $('#Server_2').text($('#servers_2s').val());
        }
        if ($('#sap_hana_data_2s').val() == "") {
            $('#sap_hana_databases_2site').hide();
        }
        else {
            $('#Sap_hana_databases_2site').text($('#sap_hana_data_2s').val());
        }
        if ($('#sap_hana_nodes_2s').val() == "") {
            $('#sap_hana_nodes_2site').hide();
        }
        else {
            $('#Sap_hana_nodes_2site').text($('#sap_hana_nodes_2s').val());
        }
        $('#bunker_3').text($('#bunker_3s').val());
        if ($('#vm_images_3s').val() == "") {
            $('#vm_image_3').hide();
        }
        else {
            $('#Vm_image_3').text($('#vm_images_3s').val());
        }
        if ($('#database_3s').val() == "") {
            $('#vm_db_3').hide();
        }
        else {
            $('#Vm_db_3').text($('#database_3s').val());
        }
        if ($('#b_windows_datas_3s').val() == "") {
            $('#bm_w_3').hide();
        }
        else {
            $('#Bm_w_3').text($('#b_windows_datas_3s').val());
        }
        if ($('#b_windows_db_3s').val() == "") {
            $('#bm_wd_3').hide();
        }
        else {
            $('#Bm_wd_3').text($('#b_windows_db_3s').val());
        }
        if ($('#b_unix_datas_3s').val() == "") {
            $('#bm_u_3').hide();
        }
        else {
            $('#Bm_u_3').text($('#b_unix_datas_3s').val());
        }
        if ($('#b_unix_db_3s').val() == "") {
            $('#bm_ud_3').hide();
        }
        else {
            $('#Bm_ud_3').text($('#b_unix_db_3s').val());
        }
        if ($('#prod_servers_3s').val() == "") {
            $('#bm_sar_3').hide();
        }
        else {
            $('#Bm_sar_3').text($('#prod_servers_3s').val());
        }
        if ($('#virtual_prod_3s').val() == "") {
            $('#vm_sar_3').hide();
        }
        else {
            $('#Vm_sar_3').text($('#virtual_prod_3s').val());
        }
        if ($('#share_server_3s').val() == "") {
            $('#s_s_3').hide();
        }
        else {
            $('#S_s_3').text($('#share_server_3s').val());
        }
        if ($('#virtual_server_3s').val() == "") {
            $('#v_s_s_3').hide();
        }
        else {
            $('#V_s_s_3').text($('#virtual_server_3s').val());
        }
        if ($('#prod_ms_3s').val() == "") {
            $('#prod_ms_3').hide();
        }
        else {
            $('#Prod_ms_3').text($('#prod_ms_3s').val());
        }
        if ($('#prod_v_ms_3s').val() == "") {
            $('#prod_v_ms_3').hide();
        }
        else {
            $('#Prod_v_ms_3').text($('#prod_v_ms_3s').val());
        }
        if ($('#servers_3s').val() == "") { 
            $('#server_3').hide(); 
        }
        else {
            $('#Server_3').text($('#servers_3s').val());
        }
        if ($('#sap_hana_data_3s').val() == "") {
            $('#sap_hana_databases_3site').hide();
        }
        else {
            $('#Sap_hana_databases_3site').text($('#sap_hana_data_3s').val());
        }
        if ($('#sap_hana_nodes_3s').val() == "") {
            $('#sap_hana_nodes_3site').hide();
        }
        else {
            $('#Sap_hana_nodes_3site').text($('#sap_hana_nodes_3s').val());
        }
        $('#prof_services').text($('input:radio[name=Prof_Services_all]:checked').val());
        $('#type_of_service').text($('input:radio[name=Prof_Services_type]:checked').val());
        if ($('input:radio[name=Prof_Services_all]:checked').val() == "yes") {
            $('#prof_vm_image').hide();
            $('#prof_database').hide();
            $('#prof_b_windows_datas').hide();
            $('#prof_b_windows_db').hide();
            $('#prof_b_unix_datas').hide();
            $('#prof_b_unix_db').hide();
            $('#prof_prod_servers').hide();
            $('#prof_virtual_prod').hide();
            $('#prof_share_server').hide();
            $('#prof_share_db').hide();
            $('#prof_v_share_server').hide();
            $('#prof_v_share_db').hide();
            $('#prof_prod_ms').hide();
            $('#prof_prod_v_ms').hide();
        }
        if ($('#prof_services_vm_image').val() == "") {
            $('#prof_vm_image').hide();
        }
        else {
            $('#Prof_vm_image').text($('#prof_services_vm_image').val());
        }
        if ($('#prof_services_database').val() == "") {
            $('#prof_database').hide();
        }
        else {
            $('#Prof_database').text($('#prof_services_database').val());
        }
        if ($('#prof_services_b_windows_datas').val() == "") {
            $('#prof_b_windows_datas').hide();
        }
        else {
            $('#Prof_b_windows_datas').text($('#prof_services_b_windows_datas').val());
        }
        if ($('#prof_services_b_windows_db').val() == "") {
            $('#prof_b_windows_db').hide();
        }
        else {
            $('#Prof_b_windows_db').text($('#prof_services_b_windows_db').val());
        }
        if ($('#prof_services_b_unix_datas').val() == "") {
            $('#prof_b_unix_datas').hide();
        }
        else {
            $('#Prof_b_unix_datas').text($('#prof_services_b_unix_datas').val());
        }
        if ($('#prof_services_b_unix_db').val() == "") {
            $('#prof_b_unix_db').hide();
        }
        else {
            $('#Prof_b_unix_db').text($('#prof_services_b_unix_db').val());
        }
        if ($('#prof_services_prod_servers').val() == "") {
            $('#prof_prod_servers').hide();
        }
        else {
            $('#Prof_prod_servers').text($('#prof_services_prod_servers').val());
            document.getElementById('Prof_prod_servers').innerHTML=$('#prof_services_prod_servers').val();
        }
        if ($('#prof_services_virtual_prod').val() == "") {
            $('#prof_virtual_prod').hide();
        }
        else {
            $('#Prof_virtual_prod').text($('#prof_services_virtual_prod').val());
            document.getElementById('Prof_virtual_prod').innerHTML=$('#prof_services_virtual_prod').val();
        }
        if ($('#prof_services_share_server').val() == "") {
            $('#prof_share_server').hide();
        }
        else {
            $('#Prof_share_server').text($('#prof_services_share_server').val());
        }
        if ($('#prof_services_share_db').val() == "") {
            $('#prof_share_db').hide();
        }
        else {
            $('#Prof_share_db').text($('#prof_services_share_db').val());
        }
        if ($('#prof_services_v_share_server').val() == "") {
            $('#prof_v_share_server').hide();
        }
        else {
            $('#Prof_v_share_server').text($('#prof_services_v_share_server').val());
        }
        if ($('#prof_services_v_share_db').val() == "") {
            $('#prof_v_share_db').hide();
        }
        else {
            $('#Prof_v_share_db').text($('#prof_services_v_share_db').val());
        }
        if ($('#prof_services_prod_ms').val() == "") {
            $('#prof_prod_ms').hide();
        }
        else {
            $('#Prof_prod_ms').text($('#prof_services_prod_ms').val());
        }
        if ($('#prof_services_prod_v_ms').val() == "") {
            $('#prof_prod_v_ms').hide();
        }
        else {
            $('#Prof_prod_v_ms').text($('#prof_services_prod_v_ms').val());
        }
        if ($('#prof_services_sap_hana_data').val() == "") {
            $('#prof_sap_hana_databases').hide();
        }
        else {
            $('#Prof_sap_hana_databases').text($('#prof_services_sap_hana_data').val());
        }
        if ($('#prof_services_sap_hana_node').val() == "") {
//            alert($('#prof_services_sap_hana_node').val());
            $('#prof_sap_hana_nodes').hide();
        }
        else {
            $('#Prof_sap_hana_nodes').text($('#prof_services_sap_hana_node').val());
        }
        $('#Prof_premise').text($('#premise_product_training').val());
        $('#productSupport').text($('#product_support').val());
    });

    function checkPanels() {
        if ($("#2-site").is(":checked")) {
            $("#table").show();
            document.getElementById('vm_images_2S').style.display = "inline";
            document.getElementById('db_2S').style.display = "inline";
            document.getElementById('b_windows_datas_2S').style.display = "inline";
            document.getElementById('b_windows_db_2S').style.display = "inline";
            document.getElementById('b_unix_datas_2S').style.display = "inline";
            document.getElementById('b_unix_db_2S').style.display = "inline";
            document.getElementById('2_site_panel').style.display = "none";
            document.getElementById('share_server_2S').style.display = "inline";
            document.getElementById('virtual_sharepoint_server_2S').style.display = "inline";
            document.getElementById('prod_ms_2S').style.display = "inline";
            document.getElementById('prod_v_ms_2S').style.display = "inline";
            document.getElementById('servers_2S').style.display = "inline";
            document.getElementById('sap_hana_data_2S').style.display = "inline";
            document.getElementById('sap_hana_nodes_2S').style.display = "inline";
            document.getElementById('button1').style.display = "inline";
            document.getElementById('less1').style.display = "none";
        }
        else {
            $("#table").hide();
        }
        if (document.getElementById('advanced_replication_3s').checked) {
            $("#3-site").prop("checked", true);
        }
        if ($("#3-site").is(":checked")){
            $("#table1").show();
            document.getElementById('servers_3S').style.display = "inline";
            document.getElementById('vm_images_3S').style.display = "inline";
            document.getElementById('database_3S').style.display = "inline";
            document.getElementById('b_windows_datas_3S').style.display = "inline";
            document.getElementById('b_windows_db_3S').style.display = "inline";
            document.getElementById('b_unix_datas_3S').style.display = "inline";
            document.getElementById('b_unix_db_3S').style.display = "inline";
            document.getElementById('3_site_panel').style.display = "none";
            document.getElementById('prod_servers_3S').style.display = "inline";
            document.getElementById('virtual_prod_3S').style.display = "inline";
            document.getElementById('share_server_3S').style.display = "inline";
            document.getElementById('virtual_server_3S').style.display = "inline";
            document.getElementById('prod_ms_3S').style.display = "inline";
            document.getElementById('prod_v_ms_3S').style.display = "inline";
            document.getElementById('sap_hana_data_3S').style.display = "inline";
            document.getElementById('sap_hana_nodes_3S').style.display = "inline";
            document.getElementById('button2').style.display = "inline";
            document.getElementById('less2').style.display = "none";
        }
        else {
            $("#table1").hide();
        }
        if ($("#advanced_replication").is(":checked")) {
            $("#inline_table").show();
            document.getElementById('prod_servers_2S').style.display = "inline";
            document.getElementById('virtual_prod_2S').style.display = "inline";
        }
        else {
            $("#inline_table").hide();
        }
        if ($("#advanced_replication_3s").is(":checked")) {
            $("#inline_table1").show();
            document.getElementById('prod_servers_3S').style.display = "inline";
            document.getElementById('virtual_prod_3S').style.display = "inline";
        }
        else {
            $("#inline_table1").hide();
        }
        if ($("#advanced_replication_prof").is(":checked")) {
            $("#inline_table2").show();
            document.getElementById('Prof_Services_prod_servers').style.display = "inline";
            document.getElementById('Prof_Services_virtual_prod').style.display = "inline";
        }
        else {
            $("#inline_table2").hide();
        }
        if ($("#product").is(":checked")) {
            $("#table3").show();
        }
        else {
            $("#table3").hide();
        }
        if ($("#discount").is(":checked")) {
            $("#table4").show();
        }
        else {
            $("#table2").hide();
        }
    }
    checkPanels();
    //Toggle program panels
    $('#2-site').change(function () {
        $("#table").slideToggle();
        document.getElementById('vm_images_2S').style.display = "inline";
        document.getElementById('db_2S').style.display = "inline";
        document.getElementById('b_windows_datas_2S').style.display = "inline";
        document.getElementById('b_windows_db_2S').style.display = "inline";
        document.getElementById('b_unix_datas_2S').style.display = "inline";
        document.getElementById('b_unix_db_2S').style.display = "inline";
        document.getElementById('2_site_panel').style.display = "none";
        document.getElementById('share_server_2S').style.display = "inline";
        document.getElementById('virtual_sharepoint_server_2S').style.display = "inline";
        document.getElementById('prod_ms_2S').style.display = "inline";
        document.getElementById('prod_v_ms_2S').style.display = "inline";
        document.getElementById('servers_2S').style.display = "inline";
        document.getElementById('sap_hana_data_2S').style.display = "inline";
        document.getElementById('sap_hana_nodes_2S').style.display = "inline";
        document.getElementById('button1').style.display = "inline";
        document.getElementById('less1').style.display = "none";
    });
    $('#3-site').change(function () {
        $("#table1").slideToggle();
        document.getElementById('servers_3S').style.display = "inline";
        document.getElementById('vm_images_3S').style.display = "inline";
        document.getElementById('database_3S').style.display = "inline";
        document.getElementById('b_windows_datas_3S').style.display = "inline";
        document.getElementById('b_windows_db_3S').style.display = "inline";
        document.getElementById('b_unix_datas_3S').style.display = "inline";
        document.getElementById('b_unix_db_3S').style.display = "inline";
        document.getElementById('3_site_panel').style.display = "none";
        document.getElementById('prod_servers_3S').style.display = "inline";
        document.getElementById('virtual_prod_3S').style.display = "inline";
        document.getElementById('share_server_3S').style.display = "inline";
        document.getElementById('virtual_server_3S').style.display = "inline";
        document.getElementById('prod_ms_3S').style.display = "inline";
        document.getElementById('prod_v_ms_3S').style.display = "inline";
        document.getElementById('sap_hana_data_3S').style.display = "inline";
        document.getElementById('sap_hana_nodes_3S').style.display = "inline";
        document.getElementById('less2').style.display = "none";
        document.getElementById('button2').style.display = "inline";
    });
    $('#product').change(function () {
        $("#table3").slideToggle();
    });
    $('#advanced_replication').change(function () {
        $("#inline_table").slideToggle();
    });
    $('#advanced_replication_3s').change(function () {
        $("#inline_table1").slideToggle();
    });
    $('#advanced_replication_prof').change(function () {
        $("#inline_table2").slideToggle();
    });
    $('#discount').change(function () {
        $("#table4").slideToggle();
    });
});
$(document).ready(function () {
    if ($("#prof").is(":checked")) {
        $("#table2").show();
        document.getElementById('panel3').style.display = "none";
        document.getElementById('personalpanel1').style.display = "none";
        document.getElementById('prof_panel').style.display = "none";
        document.getElementById('button3').style.display = "inline";
        document.getElementById('less3').style.display = "none";
    }
    else {
        $("#table2").hide();
    }
    $('#prof').change(function () {
        document.getElementById('panel3').style.display = "none";
        document.getElementById('personalpanel1').style.display = "none";
        document.getElementById('prof_panel').style.display = "none";
        document.getElementById('button3').style.display = "none";
        document.getElementById('less3').style.display = "none";
        $("#table2").slideToggle();
    });
});
$(document).ready(function () {
    var prof_normal1 = document.getElementById('prof_services_share_server').value;
    var prof_normal2 = document.getElementById('prof_services_share_db').value;
    var prof_normal3 = document.getElementById('prof_services_v_share_server').value;
    var prof_normal4 = document.getElementById('prof_services_v_share_db').value;
    var prof_normal5 = document.getElementById('prof_services_prod_ms').value;
    var prof_normal6 = document.getElementById('prof_services_prod_v_ms').value;
    if ((prof_normal1 == "") || (prof_normal2 == "") || (prof_normal3 == "") || (prof_normal4 == "") || (prof_normal5 == "") || (prof_normal6 == "")) {
        $("#prof_panel").hide(1000);
        document.getElementById('less3').style.display = "none";
        document.getElementById('button3').style.display = "none";
    }
    else if ((prof_normal1 != 0) || (prof_normal2 != 0) || (prof_normal3 != 0) || (prof_normal4 != 0) || (prof_normal5 != 0) || (prof_normal6 != 0)) {
//        alert('prof_panel');
        $("#prof_panel").show(1000);
        document.getElementById('less3').style.display = "inline";
        document.getElementById('button3').style.display = "none";
    }
    else {
        $("#prof_panel").hide(1000);
        document.getElementById('less3').style.display = "none";
        document.getElementById('button3').style.display = "none";
    }
    if ($('[id="partial"]').is(':checked')) {
        $("#panel3").show(1000);
        document.getElementById('personalpanel1').style.display = "inline";
        document.getElementById('button3').style.display = "inline";
        document.getElementById('less3').style.display = "none";
    }else if($('[id="full"]').is(':checked')){
        $("#panel3").hide(1000);
        $("#prof_panel").hide(1000);
        document.getElementById('personalpanel1').style.display = "none";
        document.getElementById('button3').style.display = "none";
        document.getElementById('less3').style.display = "none";
    }
    $("#button1").click(function () {
        $('html, body').animate({
            scrollTop: $("#b_unix_db_2S").offset().top
        }, 1500);
    });
    $("#less1").click(function () {
        $('html, body').animate({
            scrollTop: $("#top").offset().top
        }, 500);
    });
    $("#button2").click(function () {
        $('html, body').animate({
            scrollTop: $("#b_unix_db_3S").offset().top
        }, 1000);
    });
    $("#button3").click(function () {
        $('html, body').animate({
            scrollTop: $("#Prof_Services_b_unix_db").offset().top
        }, 1000);
    });
});
window.onload = function () {
    document.getElementById("first").style.display = "block";
    document.getElementById("second").style.display = "none";
    document.getElementById("third").style.display = "none";
};
//var vm_advanced_3s=document.getElementById('virtual_prod_3s').value;
//var bm_advanced_3s=document.getElementById('prod_servers_3s').value;
//validation for 2-site advanced values
function correctValuesEnteredIn2s_vm() {
    var vm_advanced_2s = document.getElementById('virtual_prod_2s').value;
    var vm_images_2s = document.getElementById('vm_images_2s').value;
    var bm_win_2s = document.getElementById('b_windows_datas_2s').value;
    var bm_unix_2s = document.getElementById('b_unix_datas_2s').value;
    var bm_advanced_2s = document.getElementById('prod_servers_2s').value;
    var bm_advanced_2s_addon = Number(bm_win_2s) + Number(bm_unix_2s);
//    alert(vm_advanced_2s);
    if (checkNumbers(vm_advanced_2s, vm_images_2s) || checkNumbers(bm_advanced_2s, bm_advanced_2s_addon)) {
        if (checkNumbers(vm_advanced_2s, vm_images_2s) && !checkNumbers(bm_advanced_2s, bm_advanced_2s_addon)) {
            document.getElementById('virtual_prod_2s').focus();
            $("#virtual_prod_2S").addClass("has-error has-feedback");
            $("#prod_servers_2S").removeClass("has-error");
            return false;
        }
        else if (checkNumbers(bm_advanced_2s, bm_advanced_2s_addon) && !checkNumbers(vm_advanced_2s, vm_images_2s)) {
            document.getElementById('prod_servers_2s').focus();
            $("#prod_servers_2S").addClass("has-error has-feedback");
            $("#virtual_prod_2S").removeClass("has-error");
            return false;
        }
        else {
            document.getElementById('prod_servers_2s').focus();
            $("#prod_servers_2S").addClass("has-error has-feedback");
            return false;
        }
    }
    else if (checkNumbers(vm_advanced_2s, vm_images_2s) && checkNumbers(bm_advanced_2s, bm_advanced_2s_addon)) {
        document.getElementById('prod_servers_2s').focus();
        $("#prod_servers_2S").addClass("has-error has-feedback");
        return false;
    }
    else if(!properNumber(bm_advanced_2s)){
        document.getElementById('prod_servers_2s').focus();
        $("#prod_servers_2S").addClass("has-error has-feedback");  
        return false;
    }else if(!properNumber(vm_advanced_2s)){
        document.getElementById('virtual_prod_2s').focus();
        $("#virtual_prod_2S").addClass("has-error has-feedback");  
        return false;
    }
    else {
        $("#virtual_prod_2S").removeClass("has-error");
        $("#prod_servers_2S").removeClass("has-error");
        return true;
    }
    
}

//validation for 3-site advanced values
function correctValuesEnteredIn3s_vm() {
    var vm_advanced_3s = document.getElementById('virtual_prod_3s').value;
    var vm_images_3s = document.getElementById('vm_images_3s').value;
    var bm_win_3s = document.getElementById('b_windows_datas_3s').value;
    var bm_unix_3s = document.getElementById('b_unix_datas_3s').value;
    var bm_advanced_3s = document.getElementById('prod_servers_3s').value;
    var bm_advanced_3s_addon = Number(bm_win_3s) + Number(bm_unix_3s);
    if (checkNumbers(vm_advanced_3s, vm_images_3s) || checkNumbers(bm_advanced_3s, bm_advanced_3s_addon)) {
        if (checkNumbers(vm_advanced_3s, vm_images_3s) && !checkNumbers(bm_advanced_3s, bm_advanced_3s_addon)) {
            document.getElementById('virtual_prod_3s').focus();
            $("#virtual_prod_3S").addClass("has-error has-feedback");
            $("#prod_servers_3S").removeClass("has-error");
            return false;
        }
        else if (checkNumbers(bm_advanced_3s, bm_advanced_3s_addon) && !checkNumbers(vm_advanced_3s, vm_images_3s)) {
            document.getElementById('prod_servers_3s').focus();
            $("#prod_servers_3S").addClass("has-error has-feedback");
            $("#virtual_prod_3S").removeClass("has-error");
            return false;
        }
        else {
            document.getElementById('prod_servers_3s').focus();
            $("#prod_servers_3S").addClass("has-error has-feedback");
            return false;
        }
    }
    else if (checkNumbers(vm_advanced_3s, vm_images_3s) && checkNumbers(bm_advanced_3s, bm_advanced_3s_addon)) {
        document.getElementById('prod_servers_3s').focus();
        $("#prod_servers_3S").addClass("has-error has-feedback");
        return false;
    }
    else if(!properNumber(bm_advanced_3s)){
        document.getElementById('prod_servers_3s').focus();
        $("#prod_servers_3S").addClass("has-error has-feedback");  
        return false;
    }else if(!properNumber(vm_advanced_3s)){
        document.getElementById('virtual_prod_3s').focus();
        $("#virtual_prod_3S").addClass("has-error has-feedback");  
        return false;
    }
    else {
        $("#virtual_prod_3S").removeClass("has-error");
        $("#prod_servers_3S").removeClass("has-error");
        return true;
    }
}

//validation for prof-services advanced values
function correctValuesEnteredInprof() {
    var prof_prod_vm=document.getElementById("prof_services_vm_image").value;
//    alert(prof_prod_vm);
    var prof_prod_vm_addon=document.getElementById("prof_services_virtual_prod").value;
    var prof_prod_bm_win=document.getElementById("prof_services_b_windows_datas").value;
    var prof_prod_bm_lin=document.getElementById("prof_services_b_unix_datas").value;
    var prof_prod_bm_addon=document.getElementById("prof_services_prod_servers").value;
    var advanced_add_on_limit=Number(prof_prod_bm_win)+Number(prof_prod_bm_lin);
    
    if (checkNumbers(prof_prod_vm_addon,prof_prod_vm) || checkNumbers(prof_prod_bm_addon, advanced_add_on_limit)) {
        if (checkNumbers(prof_prod_vm_addon,prof_prod_vm) && !checkNumbers(prof_prod_bm_addon, advanced_add_on_limit)) {
            document.getElementById('prof_services_virtual_prod').focus();
            $("#Prof_Services_virtual_prod").addClass("has-error has-feedback");
            $("#Prof_Services_prod_servers").removeClass("has-error");
            return false;
        }
        else if (checkNumbers(prof_prod_bm_addon, advanced_add_on_limit) && !checkNumbers(prof_prod_vm_addon,prof_prod_vm)) {
            document.getElementById('prof_services_prod_servers').focus();
            $("#Prof_Services_prod_servers").addClass("has-error has-feedback");
            $("#Prof_Services_virtual_prod").removeClass("has-error");
            return false;
        }
        else {
            document.getElementById('prof_services_prod_servers').focus();
            $("#Prof_Services_prod_servers").addClass("has-error has-feedback");
            return false;
        }
    }
    else if (checkNumbers(prof_prod_vm_addon,prof_prod_vm) && checkNumbers(prof_prod_bm_addon, advanced_add_on_limit)) {
        document.getElementById('prof_services_prod_servers').focus();
        $("#Prof_Services_prod_servers").addClass("has-error has-feedback");
        return false;
    }else if(!properNumber(prof_prod_bm_addon)){
        document.getElementById('prof_services_prod_servers').focus();
        $("#Prof_Services_prod_servers").addClass("has-error has-feedback");  
        return false;
    }else if(!properNumber(prof_prod_vm_addon)){
        document.getElementById('prof_services_virtual_prod').focus();
        $("#Prof_Services_virtual_prod").addClass("has-error has-feedback");  
        return false;
    }
    else {
        $("#Prof_Services_virtual_prod").removeClass("has-error");
        $("#Prof_Services_prod_servers").removeClass("has-error");
        return true;
    }
}

function checkNumbers(num1, num2) {
    if (Number(num1) > Number(num2)) {
        return true;
    }
    else {
        return false;
    }
}
// Function that executes on click of first next button.
function next_page1() {
    var elem = document.getElementById("name").value;
    var elem4 = document.getElementById("customer_name").value;
    var partner = document.getElementById("partner").value;
    var elem2 = document.getElementById("productname").value;
    var elem3 = document.getElementById("product_module").value;
    if ((elem == "") && (elem4 == "") && (partner == "")) {
        //        if (partner == "") {
        document.getElementById('namelen').style.display = "inline";
        document.getElementById('namecheck').style.display = "none";
        document.getElementById('customername').style.display = "inline";
        document.getElementById('customernamecheck').style.display = "none";
        document.getElementById('partnerlen').style.display = "inline";
        document.getElementById('partnernamecheck').style.display = "none";
        document.getElementById("first").style.display = "block";
        document.getElementById("second").style.display = "none";
        document.getElementById("third").style.display = "none";
        //        }
    }
    else if ((elem == "") || (elem4 == "") || (partner == "")) {
        if (elem != "") {
            if ((elem4 == "") && (partner == "")) {
                document.getElementById('namelen').style.display = "none";
                document.getElementById('namecheck').style.display = "none";
                document.getElementById('customername').style.display = "inline";
                document.getElementById('customernamecheck').style.display = "none";
                document.getElementById('partnerlen').style.display = "inline";
                document.getElementById('partnernamecheck').style.display = "none";
                document.getElementById("first").style.display = "block";
                document.getElementById("second").style.display = "none";
                document.getElementById("third").style.display = "none";
            }
            else if ((elem4 == "") || (partner == "")) {
                if (elem4 != "") {
                    document.getElementById('namelen').style.display = "none";
                    document.getElementById('namecheck').style.display = "none";
                    document.getElementById('customername').style.display = "none";
                    document.getElementById('customernamecheck').style.display = "none";
                    document.getElementById('partnerlen').style.display = "inline";
                    document.getElementById('partnernamecheck').style.display = "none";
                    document.getElementById("first").style.display = "block";
                    document.getElementById("second").style.display = "none";
                    document.getElementById("third").style.display = "none";
                }
                else {
                    document.getElementById('namelen').style.display = "none";
                    document.getElementById('namecheck').style.display = "none";
                    document.getElementById('customername').style.display = "inline";
                    document.getElementById('customernamecheck').style.display = "none";
                    document.getElementById('partnerlen').style.display = "none";
                    document.getElementById('partnernamecheck').style.display = "none";
                    document.getElementById("first").style.display = "block";
                    document.getElementById("second").style.display = "none";
                    document.getElementById("third").style.display = "none";
                }
            }
        }
        else if (elem4 != "") {
            if ((elem == "") && (partner == "")) {
                document.getElementById('namelen').style.display = "inline";
                document.getElementById('namecheck').style.display = "none";
                document.getElementById('customername').style.display = "none";
                document.getElementById('customernamecheck').style.display = "none";
                document.getElementById('partnerlen').style.display = "inline";
                document.getElementById('partnernamecheck').style.display = "none";
                document.getElementById("first").style.display = "block";
                document.getElementById("second").style.display = "none";
                document.getElementById("third").style.display = "none";
            }
            else if ((elem == "") || (partner == "")) {
                if (elem != "") {
                    document.getElementById('namelen').style.display = "none";
                    document.getElementById('namecheck').style.display = "none";
                    document.getElementById('customername').style.display = "none";
                    document.getElementById('customernamecheck').style.display = "none";
                    document.getElementById('partnerlen').style.display = "inline";
                    document.getElementById('partnernamecheck').style.display = "none";
                    document.getElementById("first").style.display = "block";
                    document.getElementById("second").style.display = "none";
                    document.getElementById("third").style.display = "none";
                }
                else {
                    document.getElementById('namelen').style.display = "inline";
                    document.getElementById('namecheck').style.display = "none";
                    document.getElementById('customername').style.display = "none";
                    document.getElementById('customernamecheck').style.display = "none";
                    document.getElementById('partnerlen').style.display = "none";
                    document.getElementById('partnernamecheck').style.display = "none";
                    document.getElementById("first").style.display = "block";
                    document.getElementById("second").style.display = "none";
                    document.getElementById("third").style.display = "none";
                }
            }
        }
        else if (partner != "") {
            if ((elem == "") && (elem4 == "")) {
                document.getElementById('namelen').style.display = "inline";
                document.getElementById('namecheck').style.display = "none";
                document.getElementById('customername').style.display = "inline";
                document.getElementById('customernamecheck').style.display = "none";
                document.getElementById('partnerlen').style.display = "none";
                document.getElementById('partnernamecheck').style.display = "none";
                document.getElementById("first").style.display = "block";
                document.getElementById("second").style.display = "none";
                document.getElementById("third").style.display = "none";
            }
            else if ((elem == "") || (elem4 == "")) {
                if (elem != "") {
                    document.getElementById('namelen').style.display = "none";
                    document.getElementById('namecheck').style.display = "none";
                    document.getElementById('customername').style.display = "inline";
                    document.getElementById('customernamecheck').style.display = "none";
                    document.getElementById('partnerlen').style.display = "none";
                    document.getElementById('partnernamecheck').style.display = "none";
                    document.getElementById("first").style.display = "block";
                    document.getElementById("second").style.display = "none";
                    document.getElementById("third").style.display = "none";
                }
                else {
                    document.getElementById('namelen').style.display = "inline";
                    document.getElementById('namecheck').style.display = "none";
                    document.getElementById('customername').style.display = "none";
                    document.getElementById('customernamecheck').style.display = "none";
                    document.getElementById('partnerlen').style.display = "none";
                    document.getElementById('partnernamecheck').style.display = "none";
                    document.getElementById("first").style.display = "block";
                    document.getElementById("second").style.display = "none";
                    document.getElementById("third").style.display = "none";
                }
            }
        }
    }
    else if ((elem != "") && (elem4 != "") && (partner != "")) {
        var Exp1 = /((^[a-z.,/&\s]+)|(^[a-z.,/&\s]+))+[a-z.,/&\s]+$|((^[0-9.]+[a-z.]+)|(^[a-z.]+[0-9.]+))+[0-9a-z_@./#&+-\s]+$/i;
        var Exp2 = /((^[a-z\s]+)|(^[a-z./&\s]+))+[a-z\s]+$/i;
        if (!elem.match(Exp1) || !isNaN(elem)) {
            document.getElementById('namelen').style.display = "none";
            document.getElementById('namecheck').style.display = "inline";
            document.getElementById('customername').style.display = "none";
            document.getElementById('customernamecheck').style.display = "none";
            document.getElementById('partnerlen').style.display = "none";
            document.getElementById('partnernamecheck').style.display = "none";
            document.getElementById("first").style.display = "block";
            document.getElementById("second").style.display = "none";
            document.getElementById("third").style.display = "none";
        }
        else if (!elem4.match(Exp1) || !isNaN(elem4)) {
            document.getElementById('customernamecheck').style.display = "inline";
            document.getElementById('namelen').style.display = "none";
            document.getElementById('namecheck').style.display = "none";
            document.getElementById('customername').style.display = "none";
            document.getElementById('partnerlen').style.display = "none";
            document.getElementById('partnernamecheck').style.display = "none";
            document.getElementById("first").style.display = "block";
            document.getElementById("second").style.display = "none";
            document.getElementById("third").style.display = "none";
        }
        else if (!partner.match(Exp1) || !isNaN(partner)) {
            document.getElementById('partnerlen').style.display = "none";
            document.getElementById('partnernamecheck').style.display = "inline";
            document.getElementById('customernamecheck').style.display = "none";
            document.getElementById('namelen').style.display = "none";
            document.getElementById('namecheck').style.display = "none";
            document.getElementById('customername').style.display = "none";
            document.getElementById("first").style.display = "block";
            document.getElementById("second").style.display = "none";
            document.getElementById("third").style.display = "none";
        }
        else {
            document.getElementById('namelen').style.display = "none";
            document.getElementById('customername').style.display = "none";
            document.getElementById('partnerlen').style.display = "none";
            document.getElementById("second").style.display = "block";
            document.getElementById("first").style.display = "none";
            document.getElementById("third").style.display = "none";
            document.getElementById("customerName").innerHTML = elem;
            document.getElementById("customerName2").innerHTML = elem;
            document.getElementById("productName").innerHTML = elem2;
            document.getElementById("productName2").innerHTML = elem2;
            document.getElementById("productModule").innerHTML = elem3;
            document.getElementById("productModule2").innerHTML = elem3;
        }
    }
    if(checkLengthOfNotes()){
        document.getElementById("first").style.display = "none";
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return true;
    }else{
        document.getElementById("first").style.display = "block";
        document.getElementById("second").style.display = "none";
        document.getElementById("third").style.display = "none";
        return false;
    }
}

function properNumber(numb) {
    var exp = /^(?:[0-9]{5}|[0-9]{10}|[0-9]\d*|)$/;
    if (numb.match(exp)) {
        return true;
    }
    else {
        return false;
    }
}
// Function that executes on click of second next button.
function next_page2() {
    var vm_images_2s = document.getElementById('vm_images_2s').value;
    var db_2s = document.getElementById('db_2s').value;
    var b_windows_datas_2s = document.getElementById('b_windows_datas_2s').value;
    var b_windows_db_2s = document.getElementById('b_windows_db_2s').value;
    var b_unix_datas_2s = document.getElementById('b_unix_datas_2s').value;
    var b_unix_db_2s = document.getElementById('b_unix_db_2s').value;
    var prod_servers_2s = document.getElementById('prod_servers_2s').value;
    var virtual_prod_2s = document.getElementById('virtual_prod_2s').value;
    var share_server_2s = document.getElementById('share_server_2s').value;
    var virtual_sharepoint_server_2s = document.getElementById('virtual_sharepoint_server_2s').value;
    var prod_ms_2s = document.getElementById('prod_ms_2s').value;
    var prod_v_ms_2s = document.getElementById('prod_v_ms_2s').value;
    var servers_2s = document.getElementById('servers_2s').value;
    var sap_hana_data_2s = document.getElementById('sap_hana_data_2s').value;
    var sap_hana_nodes_2s = document.getElementById('sap_hana_nodes_2s').value;
    var vm_images_3s = document.getElementById('vm_images_3s').value;
    var database_3s = document.getElementById('database_3s').value;
    var b_windows_datas_3s = document.getElementById('b_windows_datas_3s').value;
    var b_windows_db_3s = document.getElementById('b_windows_db_3s').value;
    var b_unix_datas_3s = document.getElementById('b_unix_datas_3s').value;
    var b_unix_db_3s = document.getElementById('b_unix_db_3s').value;
    var prod_servers_3s = document.getElementById('prod_servers_3s').value;
    var virtual_prod_3s = document.getElementById('virtual_prod_3s').value;
    var share_server_3s = document.getElementById('share_server_3s').value;
    var virtual_server_3s = document.getElementById('virtual_server_3s').value;
    var prod_ms_3s = document.getElementById('prod_ms_3s').value;
    var prod_v_ms_3s = document.getElementById('prod_v_ms_3s').value;
    var servers_3s = document.getElementById('servers_3s').value;
    var sap_hana_data_3s = document.getElementById('sap_hana_data_3s').value;
    var sap_hana_nodes_3s = document.getElementById('sap_hana_nodes_3s').value;
    if (!properNumber(vm_images_2s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('vm_images_2s').focus();
            $("#vm_images_2S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#vm_images_2S").removeClass("has-error");
    if (!properNumber(db_2s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('db_2s').focus();
            $("#db_2S").addClass("has-error");
            document.getElementById("second").style.display = "block";
            document.getElementById("third").style.display = "none";
            return false;
    }
    $("#db_2S").removeClass("has-error");
    if (!properNumber(b_windows_datas_2s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('b_windows_datas_2s').focus();
            $("#b_windows_datas_2S").addClass("has-error");
            document.getElementById("second").style.display = "block";
            document.getElementById("third").style.display = "none";
            return false;
    }
    $("#b_windows_datas_2S").removeClass("has-error");
    if (!properNumber(b_windows_db_2s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('b_windows_db_2s').focus();
            $("#b_windows_db_2S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#b_windows_db_2S").removeClass("has-error");
    if (!properNumber(b_unix_datas_2s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('b_unix_datas_2s').focus();
            $("#b_unix_datas_2S").addClass("has-error");
            document.getElementById("second").style.display = "block";
            document.getElementById("third").style.display = "none";
            return false;
    }
    $("#b_unix_datas_2S").removeClass("has-error");
    if (!properNumber(b_unix_db_2s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('b_unix_db_2s').focus();
            $("#b_unix_db_2S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#b_unix_db_2S").removeClass("has-error");
    if (!properNumber(share_server_2s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('share_server_2s').focus();
        $("#share_server_2S").addClass("has-error");
        document.getElementById("second").style.display = "inline";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#share_server_2S").removeClass("has-error");
    if (!properNumber(virtual_sharepoint_server_2s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('virtual_sharepoint_server_2s').focus();
         $("#virtual_sharepoint_server_2S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#virtual_sharepoint_server_2S").removeClass("has-error");
    if (!properNumber(prod_ms_2s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prod_ms_2s').focus();
        $("#prod_ms_2S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#prod_ms_2S").removeClass("has-error");
    if (!properNumber(prod_v_ms_2s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prod_v_ms_2s').focus();
        $("#prod_v_ms_2S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#prod_v_ms_2S").removeClass("has-error");
    if (!properNumber(servers_2s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('servers_2s').focus();
            $("#servers_2S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#servers_2S").removeClass("has-error");
    
    if (!properNumber(sap_hana_data_2s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('sap_hana_data_2s').focus();
            $("#sap_hana_data_2S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#sap_hana_data_2S").removeClass("has-error");
    
    if (!properNumber(sap_hana_nodes_2s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('sap_hana_nodes_2s').focus();
            $("#sap_hana_nodes_2S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#sap_hana_nodes_2S").removeClass("has-error");
    
    if (!properNumber(prod_servers_2s)) {
            document.getElementById('prod_servers_2s').focus();
        $("#prod_servers_2S").addClass("has-error");
//        alert("Please Enter Proper Value PROD");
//        alert(document.getElementById('prod_servers_2S').value);
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#prod_servers_2S").removeClass("has-error");
    
    if (!properNumber(virtual_prod_2s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('virtual_prod_2s').focus();
//        document.getElementById('virtual_prod_2s').focus();
//            $("#virtual_prod_2S").addClass("has-error has-feedback");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#virtual_prod_2S").removeClass("has-error");
    if (!properNumber(vm_images_3s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('vm_images_3s').focus();
         $("#vm_images_3S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#vm_images_3S").removeClass("has-error");
    if (!properNumber(database_3s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('database_3s').focus();
            $("#database_3S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#database_3S").removeClass("has-error");
    
    if (!properNumber(b_windows_datas_3s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('b_windows_datas_3s').focus();
            $("#b_windows_datas_3S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#b_windows_datas_3S").removeClass("has-error");
    
    if (!properNumber(b_windows_db_3s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('b_windows_db_3s').focus();
            $("#b_windows_db_3S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#b_windows_db_3S").removeClass("has-error");
    
    if (!properNumber(b_unix_datas_3s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('b_unix_datas_3s').focus();
            $("#b_unix_datas_3S").addClass("has-error");    
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#b_unix_datas_3S").removeClass("has-error");
    
    if (!properNumber(b_unix_db_3s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('b_unix_db_3s').focus();
            $("#b_unix_db_3S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#b_unix_db_3S").removeClass("has-error");
    if (!properNumber(share_server_3s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('share_server_3s').focus();
            $("#share_server_3S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#share_server_3S").removeClass("has-error");
    if (!properNumber(virtual_server_3s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('virtual_server_3s').focus();
            $("#virtual_server_3S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#virtual_server_3S").removeClass("has-error");
    if (!properNumber(prod_ms_3s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prod_ms_3s').focus();
            $("#prod_ms_3S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#prod_ms_3S").removeClass("has-error");
    if (!properNumber(prod_v_ms_3s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prod_v_ms_3s').focus();
            $("#prod_v_ms_3S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#prod_v_ms_3S").removeClass("has-error");
    
    if (!properNumber(servers_3s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('servers_3s').focus();
            $("#servers_3s").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#servers_3s").removeClass("has-error");
    
    if (!properNumber(sap_hana_data_3s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('sap_hana_data_3s').focus();
            $("#sap_hana_data_3S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#sap_hana_data_3S").removeClass("has-error");
    
    if (!properNumber(sap_hana_nodes_3s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('sap_hana_nodes_3s').focus();
            $("#sap_hana_nodes_3S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#sap_hana_nodes_3S").removeClass("has-error");
    
    
    if (!properNumber(prod_servers_3s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prod_servers_3s').focus();
            $("#prod_servers_3S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#prod_servers_3S").removeClass("has-error");
    if (!properNumber(virtual_prod_3s)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('virtual_prod_3s').focus();
            $("#virtual_prod_3S").addClass("has-error");
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    $("#virtual_prod_3S").removeClass("has-error");
    
//    else {
//        document.getElementById("second").style.display = "none";
//        document.getElementById("third").style.display = "block";
//    }
    var site_2s_vm_images_2s = document.getElementById("vm_images_2s").value;
    var site_2s_db_2s = document.getElementById("db_2s").value;
    var site_2s_b_windows_datas_2s = document.getElementById("b_windows_datas_2s").value;
    var site_2s_b_windows_db_2s = document.getElementById("b_windows_db_2s").value;
    var site_2s_b_unix_datas_2s = document.getElementById("b_unix_datas_2s").value;
    var site_2s_b_unix_db_2s = document.getElementById("b_unix_db_2s").value;
    var site_2s_prod_servers_2s = document.getElementById("prod_servers_2s").value;
    var site_2s_virtual_prod_2s = document.getElementById("virtual_prod_2s").value;
    var site_2s_share_server_2s = document.getElementById("share_server_2s").value;
    var site_2s_virtual_sharepoint_server_2s = document.getElementById("virtual_sharepoint_server_2s").value;
    var site_2s_prod_ms_2s = document.getElementById("prod_ms_2s").value;
    var site_2s_prod_v_ms_2s = document.getElementById("prod_v_ms_2s").value;
    var site_3s_vm_images_3s = document.getElementById("vm_images_3s").value;
    var site_3s_database_3s = document.getElementById("database_3s").value;
    var site_3s_b_windows_datas_3s = document.getElementById("b_windows_datas_3s").value;
    var site_3s_b_windows_db_3s = document.getElementById("b_windows_db_3s").value;
    var site_3s_b_unix_datas_3s = document.getElementById("b_unix_datas_3s").value;
    var site_3s_b_unix_db_3s = document.getElementById("b_unix_db_3s").value;
    var site_3s_prod_servers_3s = document.getElementById("prod_servers_3s").value;
    var site_3s_virtual_prod_3s = document.getElementById("virtual_prod_3s").value;
    var site_3s_share_server_3s = document.getElementById("share_server_3s").value;
    var site_3s_virtual_server_3s = document.getElementById("virtual_server_3s").value;
    var site_3s_prod_ms_3s = document.getElementById("prod_ms_3s").value;
    var site_3s_prod_v_ms_3s = document.getElementById("prod_v_ms_3s").value;
    document.getElementById("prof_services_vm_image_addon").innerHTML = Number(site_2s_vm_images_2s) + Number(site_3s_vm_images_3s);
    document.getElementById("prof_services_database_addon").innerHTML = Number(site_2s_db_2s) + Number(site_3s_database_3s);
    document.getElementById("prof_services_b_windows_datas_addon").innerHTML = Number(site_2s_b_windows_datas_2s) + Number(site_3s_b_windows_datas_3s);
    document.getElementById("prof_services_b_windows_db_addon").innerHTML = Number(site_2s_b_windows_db_2s) + Number(site_3s_b_windows_db_3s);
    document.getElementById("prof_services_b_unix_datas_addon").innerHTML = Number(site_2s_b_unix_datas_2s) + Number(site_3s_b_unix_datas_3s);
    document.getElementById("prof_services_b_unix_db_addon").innerHTML = Number(site_2s_b_unix_db_2s) + Number(site_3s_b_unix_db_3s);
    document.getElementById("prof_services_prod_servers_addon").innerHTML = Number(site_2s_prod_servers_2s) + Number(site_3s_prod_servers_3s);
    document.getElementById("prof_services_virtual_prod_addon").value = Number(site_2s_prod_servers_2s) + Number(site_3s_prod_servers_3s);
    document.getElementById("prof_services_virtual_prod_addon").innerHTML = Number(site_2s_virtual_prod_2s) + Number(site_3s_virtual_prod_3s);
    document.getElementById("prof_services_prod_servers_addon").value  = Number(site_2s_virtual_prod_2s) + Number(site_3s_virtual_prod_3s);
    document.getElementById("prof_services_share_server_addon").innerHTML = Number(site_2s_share_server_2s) + Number(site_3s_share_server_3s);
    document.getElementById("prof_services_share_db_addon").innerHTML = Number(site_2s_share_server_2s) + Number(site_3s_share_server_3s);
    document.getElementById("prof_services_v_share_server_addon").innerHTML = Number(site_2s_virtual_sharepoint_server_2s) + Number(site_3s_virtual_server_3s);
    document.getElementById("prof_services_v_share_db_addon").innerHTML = Number(site_2s_virtual_sharepoint_server_2s) + Number(site_3s_virtual_server_3s);
    document.getElementById("prof_services_prod_ms_addon").innerHTML = Number(site_2s_prod_ms_2s) + Number(site_3s_prod_ms_3s);
    document.getElementById("prof_services_prod_v_ms_addon").innerHTML = Number(site_2s_prod_v_ms_2s) + Number(site_3s_prod_v_ms_3s);
    document.getElementById("prof_services_sap_hana_data_addon").innerHTML = Number(sap_hana_data_2s) + Number(sap_hana_data_3s);
    document.getElementById("prof_services_sap_hana_node_addon").innerHTML = Number(sap_hana_nodes_2s) + Number(sap_hana_nodes_3s);
    $("#vm_images_2S").removeClass("has-error");
    $("#db_2S").removeClass("has-error");
    $("#b_windows_datas_2S").removeClass("has-error");
    $("#b_windows_db_2S").removeClass("has-error");
    $("#b_unix_datas_2S").removeClass("has-error");
    $("#b_unix_db_2S").removeClass("has-error");
     $("#share_server_2S").removeClass("has-error");
    $("#virtual_sharepoint_server_2S").removeClass("has-error");
    $("#prod_ms_2S").removeClass("has-error");
    $("#prod_v_ms_2S").removeClass("has-error");
    $("#servers_2S").removeClass("has-error");
    $("#sap_hana_data_2S").removeClass("has-error");
    $("#sap_hana_nodes_2S").removeClass("has-error");
    $("#prod_servers_2S").removeClass("has-error");
     $("#virtual_prod_2S").removeClass("has-error");
    $("#vm_images_3S").removeClass("has-error");
    $("#database_3S").removeClass("has-error");
    $("#b_windows_datas_3S").removeClass("has-error");
    $("#b_windows_db_3S").removeClass("has-error");
    $("#b_unix_datas_3S").removeClass("has-error");
    $("#b_unix_db_3S").removeClass("has-error");
    $("#share_server_3S").removeClass("has-error");
    $("#virtual_server_3S").removeClass("has-error");
    $("#prod_ms_3S").removeClass("has-error");
    $("#prod_v_ms_3S").removeClass("has-error");
    $("#servers_3s").removeClass("has-error");
    $("#sap_hana_data_3S").removeClass("has-error");
    $("#sap_hana_nodes_3S").removeClass("has-error");
    $("#prod_servers_3S").removeClass("has-error");
    $("#virtual_prod_3S").removeClass("has-error");
    $("#requirements").hide();
    if (correctValuesEnteredIn2s_vm() && correctValuesEnteredIn3s_vm()) {
        document.getElementById("second").style.display = "none";
        document.getElementById("third").style.display = "block";
        return true;
    }
    else {
        document.getElementById("second").style.display = "block";
        document.getElementById("third").style.display = "none";
        return false;
    }
    
}

function valid_product() {
    var x = document.getElementById("product_support").value;
    if (x < 1) {
        document.getElementById("product_support").value = '1';
    }
    if (x > 10) {
        document.getElementById("product_support").value = '10';
    }
}

function prev_page1() {
    document.getElementById("first").style.display = "block";
    document.getElementById('namelen').style.display = "none";
    document.getElementById("second").style.display = "none";
    document.getElementById("third").style.display = "none";
}

function prev_page2() {
    document.getElementById("first").style.display = "none";
    document.getElementById("second").style.display = "block";
    document.getElementById("third").style.display = "none";
}

function displayAdvanced() {
    document.getElementById('advancedCheck').style.display = "none";
    var elem = document.getElementById('vm_images_2s').value;
    var elem1 = document.getElementById('b_windows_datas_2s').value;
    var elem2 = document.getElementById('b_unix_datas_2s').value;
    if ((elem == "") && (elem1 == "") && (elem2 == "")) {
        document.getElementById('prod_servers_2S').style.display = "none";
        document.getElementById('virtual_prod_2S').style.display = "none";
        document.getElementById('advancedCheck').style.display = "inline";
    }
    else if ((elem != "") && ((elem1 == "") && (elem2 == ""))) {
        document.getElementById('prod_servers_2S').style.display = "none";
        document.getElementById('virtual_prod_2S').style.display = "inline";
        document.getElementById('virtual_prod_2s_addon').innerHTML = elem;
        document.getElementById('advancedCheck').style.display = "none";
    }
    else if ((elem == "") && ((elem1 != "") || (elem2 != ""))) {
        document.getElementById('advancedCheck').style.display = "none";
        document.getElementById('prod_servers_2S').style.display = "inline";
        document.getElementById('prod_servers_2s_addon').innerHTML = Number(elem1) + Number(elem2);
        document.getElementById('virtual_prod_2S').style.display = "none";
    }
    else {
        document.getElementById('advancedCheck').style.display = "none";
        document.getElementById('prod_servers_2S').style.display = "inline";
        document.getElementById('virtual_prod_2S').style.display = "inline";
        document.getElementById('virtual_prod_2s_addon').innerHTML = elem;
        document.getElementById('prod_servers_2s_addon').innerHTML = Number(elem1) + Number(elem2);
    }
}

function displayAdvance_3s() {
    document.getElementById('advancedCheck_3s').style.display = "none";
    var elem = document.getElementById('vm_images_3s').value;
    var elem1 = document.getElementById('b_windows_datas_3s').value;
    var elem2 = document.getElementById('b_unix_datas_3s').value;
    if ((elem == "") && (elem1 == "") && (elem2 == "")) {
        document.getElementById('prod_servers_3S').style.display = "none";
        document.getElementById('virtual_prod_3S').style.display = "none";
        document.getElementById('advancedCheck_3s').style.display = "inline";
    }
    else if ((elem != "") && ((elem1 == "") && (elem2 == ""))) {
        document.getElementById('prod_servers_3S').style.display = "none";
        document.getElementById('virtual_prod_3S').style.display = "inline";
        document.getElementById('virtual_prod_3s_addon').innerHTML = elem;
        document.getElementById('advancedCheck_3s').style.display = "none";
    }
    else if ((elem == "") && ((elem1 != "") || (elem2 != ""))) {
        document.getElementById('advancedCheck_3s').style.display = "none";
        document.getElementById('prod_servers_3S').style.display = "inline";
        document.getElementById('prod_servers_3s_addon').innerHTML = Number(elem1) + Number(elem2);
        document.getElementById('virtual_prod_3S').style.display = "none";
    }
    else {
        document.getElementById('advancedCheck_3s').style.display = "none";
        document.getElementById('prod_servers_3S').style.display = "inline";
        document.getElementById('virtual_prod_3S').style.display = "inline";
        document.getElementById('virtual_prod_3s_addon').innerHTML = elem;
        document.getElementById('prod_servers_3s_addon').innerHTML = Number(elem1) + Number(elem2);
    }
}

function dispalyAdvance_prof() {
    document.getElementById('advancedCheck_Prof').style.display = "none";
    var elem = document.getElementById('prof_services_vm_image').value;
    var elem1 = document.getElementById('prof_services_b_windows_datas').value;
    var elem2 = document.getElementById('prof_services_b_unix_datas').value;
    
    
    if ((elem == "") && (elem1 == "") && (elem2 == "")) {
        document.getElementById('advancedCheck_Prof').style.display = "inline";
        document.getElementById('Prof_Services_prod_servers').style.display = "none";
        document.getElementById('Prof_Services_virtual_prod').style.display = "none";
    }
    else if ((elem != "") && ((elem1 == "") && (elem2 == ""))) {
        document.getElementById('advancedCheck_Prof').style.display = "none";
        document.getElementById('Prof_Services_prod_servers').style.display = "none";
        document.getElementById('Prof_Services_virtual_prod').style.display = "inline";
        document.getElementById('prof_services_virtual_prod_addon').innerHTML = elem;
        document.getElementById('prof_services_virtual_prod_addon').value = elem;
    }
    else if ((elem == "") && ((elem1 != "") || (elem2 != ""))) {
        document.getElementById('advancedCheck_Prof').style.display = "none";
        document.getElementById('Prof_Services_prod_servers').style.display = "inline";
        document.getElementById('prof_services_prod_servers_addon').innerHTML = Number(elem1) + Number(elem2);
        document.getElementById('prof_services_prod_servers_addon').value = Number(elem1) + Number(elem2);
        document.getElementById('Prof_Services_virtual_prod').style.display = "none";
    }
    else {
        document.getElementById('advancedCheck_Prof').style.display = "none";
        document.getElementById('Prof_Services_prod_servers').style.display = "inline";
        document.getElementById('Prof_Services_virtual_prod').style.display = "inline";
        document.getElementById('prof_services_virtual_prod_addon').innerHTML = elem;
        document.getElementById('prof_services_virtual_prod_addon').value = elem;
        document.getElementById('prof_services_prod_servers_addon').value = Number(elem1) + Number(elem2);
        document.getElementById('prof_services_prod_servers_addon').innerHTML = Number(elem1) + Number(elem2);
    }
}

function enableSaveButton() {
    document.getElementById("product_support").readOnly = true;
    document.getElementById("prof").checked = false;
    $("#table2").hide();
    document.getElementById("prof").disabled = true;
    document.getElementById("discount").checked = false;
    $("#table4").hide();
    document.getElementById("discount").disabled = true;
    document.getElementById('userRequirements').style.display = "none";
    document.getElementById('prevbtn').style.display = "none";
    document.getElementById('savebutton').style.display = "inline";
}

function roleBasedDiscount() {
    var Role = userRole();
    //    var license_discount = document.getElementById("discount_license").value;
    //    var prof_discount = document.getElementById("discount_prof_serv").value;
    //    var support_discount = document.getElementById("discount_product_support").value;
    //    var training_discount = document.getElementById("discount_product_training").value;
    var prof_services_vm_image = document.getElementById('prof_services_vm_image').value;
    var prof_services_database = document.getElementById('prof_services_database').value;
    var prof_services_b_windows_datas = document.getElementById('prof_services_b_windows_datas').value;
    var prof_services_b_windows_db = document.getElementById('prof_services_b_windows_db').value;
    var prof_services_b_unix_datas = document.getElementById('prof_services_b_unix_datas').value;
    var prof_services_b_unix_db = document.getElementById('prof_services_b_unix_db').value;
    var prof_services_prod_servers = document.getElementById('prof_services_prod_servers').value;
    var prof_services_virtual_prod = document.getElementById('prof_services_virtual_prod').value;
    var prof_services_share_server = document.getElementById('prof_services_share_server').value;
    var prof_services_share_db = document.getElementById('prof_services_share_db').value;
    var prof_services_v_share_server = document.getElementById('prof_services_v_share_server').value;
    var prof_services_v_share_db = document.getElementById('prof_services_v_share_db').value;
    var prof_services_prod_ms = document.getElementById('prof_services_prod_ms').value;
    var prof_services_prod_v_ms = document.getElementById('prof_services_prod_v_ms').value;
    var prof_services_sap_hana_data = document.getElementById('prof_services_sap_hana_data').value;
    var prof_services_sap_hana_node = document.getElementById('prof_services_sap_hana_node').value;
    
    if (!properNumber(prof_services_vm_image)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prof_services_vm_image').focus();
            $("#Prof_Services_vm_image").addClass("has-error");
        document.getElementById("third").style.display = "block";
        return false;
    }
    $("#Prof_Services_vm_image").removeClass("has-error");
    if (!properNumber(prof_services_database)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prof_services_database').focus();
            $("#Prof_Services_database").addClass("has-error");
        document.getElementById("third").style.display = "block";
        return false;
    }
    $("#Prof_Services_database").removeClass("has-error");
    if (!properNumber(prof_services_b_windows_datas)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prof_services_b_windows_datas').focus();
            $("#Prof_Services_b_windows_datas").addClass("has-error");
        document.getElementById("third").style.display = "block";
        return false;
    }
    $("#Prof_Services_b_windows_datas").removeClass("has-error");
    if (!properNumber(prof_services_b_windows_db)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prof_services_b_windows_db').focus();
            $("#Prof_Services_b_windows_db").addClass("has-error");
        document.getElementById("third").style.display = "block";
        return false;
    }
    $("#Prof_Services_b_windows_db").removeClass("has-error");
    if (!properNumber(prof_services_b_unix_datas)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prof_services_b_unix_datas').focus();
            $("#Prof_Services_b_unix_datas").addClass("has-error");
            document.getElementById("third").style.display = "block";
        return false;
    }
    $("#Prof_Services_b_unix_datas").removeClass("has-error");
    if (!properNumber(prof_services_b_unix_db)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prof_services_b_unix_db').focus();
            $("#Prof_Services_b_unix_db").addClass("has-error");
        document.getElementById("third").style.display = "block";
        return false;
    }
    $("#Prof_Services_b_unix_db").removeClass("has-error");
    if (!properNumber(prof_services_share_server)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prof_services_share_server').focus();
            $("#Prof_Services_share_server").addClass("has-error");
        document.getElementById("third").style.display = "block";
        return false;
    }
    $("#Prof_Services_share_server").removeClass("has-error");
    if (!properNumber(prof_services_share_db)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prof_services_share_db').focus();
            $("#Prof_Services_share_db").addClass("has-error");
        document.getElementById("third").style.display = "block";
        return false;
    }
    $("#Prof_Services_share_db").removeClass("has-error");
    if (!properNumber(prof_services_v_share_server)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prof_services_v_share_server').focus();
            $("#Prof_Services_v_share_server").addClass("has-error");
        document.getElementById("third").style.display = "block";
        return false;
    }
    $("#Prof_Services_v_share_server").removeClass("has-error");
    if (!properNumber(prof_services_v_share_db)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prof_services_v_share_db').focus();
            $("#Prof_Services_v_share_db").addClass("has-error");
        document.getElementById("third").style.display = "block";
        return false;
    }
    $("#Prof_Services_v_share_db").removeClass("has-error");
    if (!properNumber(prof_services_prod_ms)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prof_services_prod_ms').focus();
            $("#Prof_Services_prod_ms").addClass("has-error");
        document.getElementById("third").style.display = "block";
        return false;
    }
    $("#Prof_Services_prod_ms").removeClass("has-error");
    if (!properNumber(prof_services_prod_v_ms)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prof_services_prod_v_ms').focus();
            $("#Prof_Services_prod_v_ms").addClass("has-error");
        document.getElementById("third").style.display = "block";
        return false;
    }
    $("#Prof_Services_prod_v_ms").removeClass("has-error");
    if (!properNumber(prof_services_sap_hana_data)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prof_services_sap_hana_data').focus();
            $("#Prof_services_sap_hana_data").addClass("has-error");
        document.getElementById("third").style.display = "block";
        return false;
    }
    $("#Prof_services_sap_hana_data").removeClass("has-error");
    if (!properNumber(prof_services_sap_hana_node)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prof_services_sap_hana_node').focus();
            $("#Prof_services_sap_hana_node").addClass("has-error");
        document.getElementById("third").style.display = "block";
        return false;
    }
    $("#Prof_services_sap_hana_node").removeClass("has-error");
    if (!properNumber(prof_services_virtual_prod)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prof_services_virtual_prod').focus();
            $("#Prof_Services_virtual_prod").addClass("has-error");
        document.getElementById("third").style.display = "block";
        return false;
    }
    $("#Prof_Services_virtual_prod").removeClass("has-error");
    if (!properNumber(prof_services_prod_servers)) {
        var r = confirm("Please Enter Proper Value");
            document.getElementById('prof_services_prod_servers').focus();
            $("#Prof_Services_prod_servers").addClass("has-error");
        document.getElementById("third").style.display = "block";
        return false;
    }
    $("#Prof_Services_prod_servers").removeClass("has-error");
    //professsional services validation
    var site_2s_vm_images_2s = document.getElementById("vm_images_2s").value;
    var site_2s_db_2s = document.getElementById("db_2s").value;
    var site_2s_b_windows_datas_2s = document.getElementById("b_windows_datas_2s").value;
    var site_2s_b_windows_db_2s = document.getElementById("b_windows_db_2s").value;
    var site_2s_b_unix_datas_2s = document.getElementById("b_unix_datas_2s").value;
    var site_2s_b_unix_db_2s = document.getElementById("b_unix_db_2s").value;
    var site_2s_prod_servers_2s = document.getElementById("prod_servers_2s").value;
    var site_2s_virtual_prod_2s = document.getElementById("virtual_prod_2s").value;
    var site_2s_share_server_2s = document.getElementById("share_server_2s").value;
    var site_2s_virtual_sharepoint_server_2s = document.getElementById("virtual_sharepoint_server_2s").value;
    var site_2s_prod_ms_2s = document.getElementById("prod_ms_2s").value;
    var site_2s_prod_v_ms_2s = document.getElementById("prod_v_ms_2s").value;
    var sap_hana_data_2s = document.getElementById("sap_hana_data_2s").value;
    var sap_hana_nodes_2s = document.getElementById("sap_hana_nodes_2s").value;
    var site_3s_vm_images_3s = document.getElementById("vm_images_3s").value;
    var site_3s_database_3s = document.getElementById("database_3s").value;
    var site_3s_b_windows_datas_3s = document.getElementById("b_windows_datas_3s").value;
    var site_3s_b_windows_db_3s = document.getElementById("b_windows_db_3s").value;
    var site_3s_b_unix_datas_3s = document.getElementById("b_unix_datas_3s").value;
    var site_3s_b_unix_db_3s = document.getElementById("b_unix_db_3s").value;
    var site_3s_prod_servers_3s = document.getElementById("prod_servers_3s").value;
    var site_3s_virtual_prod_3s = document.getElementById("virtual_prod_3s").value;
    var site_3s_share_server_3s = document.getElementById("share_server_3s").value;
    var site_3s_virtual_server_3s = document.getElementById("virtual_server_3s").value;
    var site_3s_prod_ms_3s = document.getElementById("prod_ms_3s").value;
    var site_3s_prod_v_ms_3s = document.getElementById("prod_v_ms_3s").value;
    var sap_hana_data_3s = document.getElementById("sap_hana_data_3s").value;
    var sap_hana_nodes_3s = document.getElementById("sap_hana_nodes_3s").value;
    var prof_services_vm_image = document.getElementById('prof_services_vm_image').value;
    var prof_services_database = document.getElementById('prof_services_database').value;
    var prof_services_b_windows_datas = document.getElementById('prof_services_b_windows_datas').value;
    var prof_services_b_windows_db = document.getElementById('prof_services_b_windows_db').value;
    var prof_services_b_unix_datas = document.getElementById('prof_services_b_unix_datas').value;
    var prof_services_b_unix_db = document.getElementById('prof_services_b_unix_db').value;
    var prof_services_prod_servers = document.getElementById('prof_services_prod_servers').value;
    var prof_services_virtual_prod = document.getElementById('prof_services_virtual_prod').value;
    var prof_services_share_server = document.getElementById('prof_services_share_server').value;
    var prof_services_share_db = document.getElementById('prof_services_share_db').value;
    var prof_services_v_share_server = document.getElementById('prof_services_v_share_server').value;
    var prof_services_v_share_db = document.getElementById('prof_services_v_share_db').value;
    var prof_services_prod_ms = document.getElementById('prof_services_prod_ms').value;
    var prof_services_prod_v_ms = document.getElementById('prof_services_prod_v_ms').value;
    var prof_services_sap_hana_data = document.getElementById('prof_services_sap_hana_data').value;
    var prof_services_sap_hana_node = document.getElementById('prof_services_sap_hana_node').value;
    
    
    if (prof_services_vm_image > (Number(site_2s_vm_images_2s) + Number(site_3s_vm_images_3s))) {
        document.getElementById('prof_services_vm_image').focus();
        $("#Prof_Services_vm_image").addClass("has-error");
        return false;
    }
    $("#Prof_Services_vm_image").removeClass("has-error");
    if (prof_services_database > (Number(site_2s_db_2s) + Number(site_3s_database_3s))) {
        document.getElementById('prof_services_database').focus();
        $("#prof_Services_database").addClass("has-error");
        return false;
    }
    $("#Prof_Services_database").removeClass("has-error"); 
    if (prof_services_b_windows_datas > (Number(site_2s_b_windows_datas_2s) + Number(site_3s_b_windows_datas_3s))) {
        document.getElementById('prof_services_b_windows_datas').focus();
        $("#Prof_Services_b_windows_datas").addClass("has-error");
        return false;
    }
    $("#Prof_Services_b_windows_datas").removeClass("has-error"); 
    if (prof_services_b_windows_db > (Number(site_2s_b_windows_db_2s) + Number(site_3s_b_windows_db_3s))) {
        document.getElementById('prof_services_b_windows_db').focus();
        $("#Prof_Services_b_windows_db").addClass("has-error");
        return false;
    }
    $("#Prof_Services_b_windows_db").removeClass("has-error"); 
    if (prof_services_b_unix_datas > (Number(site_2s_b_unix_datas_2s) + Number(site_3s_b_unix_datas_3s))) {
        document.getElementById('prof_services_b_unix_datas').focus();
        $("#Prof_Services_b_unix_datas").addClass("has-error");
        return false;
    }
    $("#Prof_Services_b_unix_datas").removeClass("has-error"); 
    if (prof_services_b_unix_db > (Number(site_2s_b_unix_db_2s) + Number(site_3s_b_unix_db_3s))) {
        document.getElementById('prof_services_b_unix_db').focus();
        $("#Prof_Services_b_unix_db").addClass("has-error");
        return false;
    }
    $("#Prof_Services_b_unix_db").removeClass("has-error"); 
//    if (!correctValuesEnteredInprof()) {
//        $("#inline_table2").show();
//        $("#Prof_Services_virtual_prod").removeClass("has-error has-feedback");
//        $("#Prof_Services_prod_servers").addClass("has-error has-feedback");
//        document.getElementById('prof_services_prod_servers').focus();
//        return false;
//    }
//    if (prof_services_virtual_prod > (Number(prof_services_b_windows_datas) + Number(prof_services_b_unix_datas))) {
//        $("#inline_table2").show();
//        $("#Prof_Services_prod_servers").removeClass("has-error has-feedback");
//        $("#Prof_Services_virtual_prod").addClass("has-error has-feedback");
//        document.getElementById('prof_services_virtual_prod').focus();
//        return false;
//    }
    var prof_prod_vm=document.getElementById("prof_services_vm_image").value;
//    alert(prof_prod_vm);
    var prof_prod_vm_addon=document.getElementById("prof_services_virtual_prod").value;
    var prof_prod_bm_win=document.getElementById("prof_services_b_windows_datas").value;
    var prof_prod_bm_lin=document.getElementById("prof_services_b_unix_datas").value;
    var prof_prod_bm_addon=document.getElementById("prof_services_prod_servers").value;
    var advanced_add_on_limit=Number(prof_prod_bm_win)+Number(prof_prod_bm_lin);
    if (checkNumbers(prof_prod_vm_addon,prof_prod_vm) || checkNumbers(prof_prod_bm_addon, advanced_add_on_limit)) {
        if (checkNumbers(prof_prod_vm_addon,prof_prod_vm) && !checkNumbers(prof_prod_bm_addon, advanced_add_on_limit)) {
            $("#inline_table2").show();
            document.getElementById('prof_services_virtual_prod').focus();
            $("#Prof_Services_virtual_prod").addClass("has-error has-feedback");
            $("#Prof_Services_prod_servers").removeClass("has-error");
            return false;
        }
        else if (checkNumbers(prof_prod_bm_addon, advanced_add_on_limit) && !checkNumbers(prof_prod_vm_addon,prof_prod_vm)) {
            $("#inline_table2").show();
            document.getElementById('prof_services_prod_servers').focus();
            $("#Prof_Services_prod_servers").addClass("has-error has-feedback");
            $("#Prof_Services_virtual_prod").removeClass("has-error");
            return false;
        }
        else {
            $("#inline_table2").show();
            document.getElementById('prof_services_prod_servers').focus();
            $("#Prof_Services_prod_servers").addClass("has-error has-feedback");
            return false;
        }
    }
    else if (checkNumbers(prof_prod_vm_addon,prof_prod_vm) && checkNumbers(prof_prod_bm_addon, advanced_add_on_limit)) {
        $("#inline_table2").show();
        document.getElementById('prof_services_prod_servers').focus();
        $("#Prof_Services_prod_servers").addClass("has-error has-feedback");
        return false;
    }
    $("#Prof_Services_prod_servers").removeClass("has-error"); 
    if (prof_services_share_server > (Number(site_2s_share_server_2s) + Number(site_3s_share_server_3s))) {
        $("#prof_panel").show();
        document.getElementById('prof_services_share_server').focus();
        $("#Prof_Services_share_server").addClass("has-error");
        return false;
    }
    $("#Prof_Services_share_server").removeClass("has-error"); 
    if (prof_services_share_db > (Number(site_2s_share_server_2s) + Number(site_3s_share_server_3s))) {
        $("#prof_panel").show();
        document.getElementById('prof_services_share_db').focus();
        $("#Prof_Services_share_db").addClass("has-error");
        return false;
    }
    $("#Prof_Services_share_db").removeClass("has-error"); 
    if (prof_services_v_share_server > (Number(site_2s_virtual_sharepoint_server_2s) + Number(site_3s_virtual_server_3s))) {
        $("#prof_panel").show();
        document.getElementById('prof_services_v_share_server').focus();
        $("#Prof_Services_v_share_server").addClass("has-error");
        return false;
    }
    $("#Prof_Services_v_share_server").removeClass("has-error"); 
    if (prof_services_v_share_db > (Number(site_2s_virtual_sharepoint_server_2s) + Number(site_3s_virtual_server_3s))) {
        $("#prof_panel").show();
        document.getElementById('prof_services_v_share_db').focus();
        $("#Prof_Services_v_share_db").addClass("has-error");
        return false;
    }
    $("#Prof_Services_v_share_db").removeClass("has-error"); 
    if (prof_services_prod_ms > (Number(site_2s_prod_ms_2s) + Number(site_3s_prod_ms_3s))) {
        $("#prof_panel").show();
        document.getElementById('prof_services_prod_ms').focus();
        $("#Prof_Services_prod_ms").addClass("has-error");
        return false;
    }
    $("#Prof_Services_prod_ms").removeClass("has-error"); 
    if (prof_services_prod_ms > (Number(site_2s_prod_v_ms_2s) + Number(site_3s_prod_v_ms_3s))) {
        $("#prof_panel").show();
        document.getElementById('prof_services_prod_v_ms').focus();
        $("#Prof_Services_prod_v_ms").addClass("has-error");
        return false;
    }
    $("#Prof_Services_prod_v_ms").removeClass("has-error");
    if (prof_services_sap_hana_data > (Number(sap_hana_data_2s) + Number(sap_hana_data_3s))) {
        document.getElementById('prof_services_sap_hana_data').focus();
        $("#Prof_services_sap_hana_data").addClass("has-error");
        return false;
    }
    $("#Prof_services_sap_hana_data").removeClass("has-error");
    if (prof_services_sap_hana_node > (Number(sap_hana_nodes_2s) + Number(sap_hana_nodes_3s))) {
        document.getElementById('prof_services_sap_hana_node').focus();
        $("#Prof_services_sap_hana_node").addClass("has-error");
        return false;
    }
    $("#Prof_services_sap_hana_node").removeClass("has-error");
    document.getElementById("product_support").readOnly = true;
    document.getElementById("prof").checked = false;
    $("#table2").hide();
    document.getElementById("prof").disabled = true;
    //    document.getElementById("discount").checked = false;
    $("#table4").hide();
    //    document.getElementById("discount").disabled = true;
    document.getElementById('userRequirements').style.display = "none";
    document.getElementById('prevbtn').style.display = "none";
    document.getElementById('backbutton').style.display = "inline";
    document.getElementById('savebutton').style.display = "inline";
    $("#professionalsection").hide();
    $("#requirements").show(1000);
}
function goBackToPreviousPage(){
    $("#crumbs ul li #config_review").removeClass("active");
    document.getElementById("product_support").readOnly = false;
    document.getElementById("prof").checked = true;
    $("#table2").show();
    document.getElementById("prof").disabled = false;
    //    document.getElementById("discount").checked = false;
    $("#table4").show();
    document.getElementById('userRequirements').style.display = "inline";
    document.getElementById('prevbtn').style.display = "inline";
    document.getElementById('backbutton').style.display = "none";
    document.getElementById('savebutton').style.display = "none";
    $("#professionalsection").show();
    $("#requirements").hide(1000);
}

function checkLengthOfNotes(){
    var elem=document.getElementById('option_tag').value;
    elem=elem.trim();
    document.getElementById('option_tag').value=elem;
//    alert(elem.length);
    if(elem.length>=256){
        document.getElementById('optionlen').style.display="inline";
         $("#optionDiv").addClass("has-error");
        document.getElementById('option_tag').focus();
        return false;
    }else{
        document.getElementById('optionlen').style.display="none";
        $("#optionDiv").removeClass("has-error");
        document.getElementById('optionlen').style.display="false";
        return true;
    }
}