$(document).ready(function () {
       $('[data-toggle="tooltip"]').tooltip();
//    var value=$("#annexure1").is(":checked");
//            alert(value);
           document.getElementById('annexure_1').value="No";
           
//       if ($("#annexure1").is(":checked")) {
//           $("#billQuantity").show();
//           $("#billQuantity1").hide();
//           document.getElementById('annexure_1').value="Yes";
//       }
//       else {
//           $("#billQuantity1").show();
//            $("#billQuantity").hide();
//           document.getElementById('annexure_1').value="No";
//       }
//   $('#annexure1').change(function () {
//       $("#billQuantity").slideToggle();
//       if ($("#annexure1").is(":checked")) {
//           document.getElementById('annexure_1').value="Yes";
//       }
//       else {
//           document.getElementById('annexure_1').value="No";
//       }
//   });
});
function maskValues(){
   if ($("#annexure1").is(":checked")) {
           $("#billQuantity").show();
           $("#billQuantity1").hide();
           document.getElementById('annexure_1').value="Yes";
       }
       else {
           $("#billQuantity1").show();
           $("#billQuantity").hide();
           document.getElementById('annexure_1').value="No";
       } 
}