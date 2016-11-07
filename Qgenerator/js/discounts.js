$(document).ready(function () {
    calculate_license_cost();
    calculate_product_support_cost();
    calculate_professional_service_cost();
    calculate_product_training_cost();
});
function checkdiscounts(){
    calculate_license_cost();
    calculate_product_support_cost();
    calculate_professional_service_cost();
    calculate_product_training_cost();
}
function calculate_license_cost(){
    var cost=document.getElementById('license_cost').value;
    var discount_percentage=document.getElementById('discount_license').value;
    var discount_value="";
    var final_cost="";
    discount_value=Math.round(Number(cost)*Number(discount_percentage/100));
    final_cost=Math.round(Number(cost)-Number(discount_value));
    document.getElementById('discount_value').value=discount_value;
    document.getElementById('discount_value').innerHTML=discount_value;
    document.getElementById('final_license_value').value=final_cost;
    document.getElementById('final_license_value').innerHTML=final_cost;
    final_cost_after_discount_value();
    checking_max_discount();
}
function calculate_product_support_cost(){
    var cost=document.getElementById('product_support').value;
    var discount_percentage=document.getElementById('discount_product_support').value;
    var discount_value="";
    var final_cost="";
    discount_value=Math.round(Number(cost)*Number(discount_percentage/100));
    final_cost=Math.round(Number(cost)-Number(discount_value));
    document.getElementById('discount_product_support_value').value=discount_value;
    document.getElementById('discount_product_support_value').innerHTML=discount_value;
    document.getElementById('final_product_support_value').value=final_cost;
    document.getElementById('final_product_support_value').innerHTML=final_cost;
    final_cost_after_discount_value();
    checking_max_discount();
}
function calculate_professional_service_cost(){
    var cost=document.getElementById('professional_service_cost').value;
    var discount_percentage=document.getElementById('discount_prof_serv').value;
    var discount_value="";
    var final_cost="";
    discount_value=Math.round(Number(cost)*Number(discount_percentage/100));
    final_cost=Math.round(Number(cost)-Number(discount_value));
    document.getElementById('discount_value_ps').value=discount_value;
    document.getElementById('discount_value_ps').innerHTML=discount_value;
    document.getElementById('final_professional_value').value=final_cost;
    document.getElementById('final_professional_value').innerHTML=final_cost;
    final_cost_after_discount_value();
    checking_max_discount();
}
function calculate_product_training_cost(){
    var cost=document.getElementById('product_training').value;
    var discount_percentage=document.getElementById('discount_product_training').value;
    var discount_value="";
    var final_cost="";
    discount_value=Math.round(Number(cost)*Number(discount_percentage/100));
    final_cost=Math.round(Number(cost)-Number(discount_value));
    document.getElementById('product_training_discount_value').value=discount_value;
    document.getElementById('product_training_discount_value').innerHTML=discount_value;
    document.getElementById('final_product_training_cost').value=final_cost;
    document.getElementById('final_product_training_cost').innerHTML=final_cost;
    final_cost_after_discount_value();
    checking_max_discount();
}
function checking_max_discount(){
    var max_discount=document.getElementById('max_discount').value;
    var license_discount=document.getElementById('discount_license').value;
    var product_discount=document.getElementById('discount_product_support').value;
    var professional_discount=document.getElementById('discount_prof_serv').value;
    var training_discount=document.getElementById('discount_product_training').value;
    var discount=document.getElementById('finalize');
    if (license_discount>max_discount||product_discount>max_discount|| professional_discount>max_discount || training_discount > max_discount){
        document.getElementById('finalize').value="Save";
        discount.setAttribute("name", "save"); 
        document.getElementById('approve').value="approve";
    }else{
        discount.setAttribute("name", "finalize"); 
        document.getElementById('finalize').value="Finalize"; 
    }
}
function final_cost_after_discount_value(){
    var license=document.getElementById('final_license_value').value;
    var product_service=document.getElementById('final_product_support_value').value;
    var professional_service=document.getElementById('final_professional_value').value;
    var product_training=document.getElementById('final_product_training_cost').value; 
    
    var final_value_after_discount="";
    var final_discount_cost=""
    var license_discount_value=document.getElementById('discount_value').value;
    var product_discount_value=document.getElementById('discount_product_support_value').value;
    var professional_discount_value=document.getElementById('discount_value_ps').value;
    var training_discount_value=document.getElementById('product_training_discount_value').value;
    
    final_discount_cost=Number(license_discount_value)+Number(product_discount_value)+Number(professional_discount_value)+Number(training_discount_value);
    final_value_after_discount=Number(license)+Number(product_service)+Number(professional_service)+Number(product_training);
    
//    document.getElementById('final_discount_cost').value=final_discount_cost;
//    document.getElementById('final_discount_cost').innerHTML=final_discount_cost;
    document.getElementById('final_cost_with_discount').value=final_value_after_discount;
    document.getElementById('final_cost_with_discount').innerHTML=final_value_after_discount;
    
}