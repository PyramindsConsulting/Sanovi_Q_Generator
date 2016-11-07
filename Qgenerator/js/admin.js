function ModifyUserEditable(){
    document.getElementById("modify_user_edit_btn").disabled = true;
    document.getElementById("modify_user_submit_btn").disabled = false;
    
    document.getElementById("modify_user_emp_name").readOnly = false;
    document.getElementById("modify_user_emailid").readOnly = false;

    document.getElementById("modify_user_role").disabled = false;
    document.getElementById("modify_user_status").disabled = false;
    document.getElementById("modify_user_dept").readOnly = false;
    document.getElementById("modify_exp_days").disabled = false;
    
    document.getElementById("modify_repArea_india").disabled = false;
    document.getElementById("modify_repArea_me").disabled = false;
    document.getElementById("modify_repArea_usa_europe").disabled = false;
    document.getElementById("modify_repArea_apac").disabled = false;
    document.getElementById("modify_repArea_r_of_w").disabled = false;
    
    document.getElementById("modify_repManager").disabled = false;
    document.getElementById("modify_sp_disc").disabled = false;
    
    
    
}