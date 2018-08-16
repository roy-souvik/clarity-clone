$(document).ready(function(){
 $('#datepicker1, #datepicker2, #datepicker3').datepicker({
   minDate: 0,
   dateFormat: "yy-mm-dd"
   });

addSelect2InToElement( $('#expertise_id') );

}); //end of document ready

function addSelect2InToElement(elementSelector) {
    elementSelector.select2();
  }