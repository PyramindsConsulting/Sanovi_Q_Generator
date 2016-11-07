//FUNCTION TO VALIDATE FORM FIELDS WHEN SUBMITTED
function validate_fields(){
    var userid = document.getElementById("userid").value;
    var password = document.getElementById("password").value;
    if (userid=="" || password==""){
        document.getElementById("error_code").innerHTML="Please enter User id & Password";
        return false;
    } else if {
        document.getElementById("error_code").innerHTML="";
        return true;
    }
    
}
