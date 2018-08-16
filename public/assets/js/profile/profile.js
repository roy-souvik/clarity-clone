/* PROFILE JS STARTS HERE */
$(document).ready(function(){

  addSelect2InToElement( $('#hourly_rate') );
  addSelect2InToElement( $('#time_zone') );
  addSelect2InToElement( $('#charity') );

  //Hide session flash message from UI
  setTimeout(hideFlashMessage, 4000);
}); //END DOCUMENT READY

/*
  function sendApplicationToAdmin(){
    var baseUrl   = $('#baseUrl').val();
    $.ajax({
      type: "GET",
      url : baseUrl + "/apply_to_be_an_expert",
      beforeSend: function( ) {
      },
      success : function(data){
        if (data == 1) {
          $('#applyToBeAnExpert').hide();
          alert('You have successfully applied to be an expert.\nAdministrator will verify your request shortly.');
        } else {
          alert('There was some error.');
        }
      }
    });
  } // END FUNCTION
*/

  function addSelect2InToElement(elementSelector) {
    elementSelector.select2();
  }

  function hideFlashMessage(elementSelector){
    elementSelector = (typeof elementSelector == 'undefined') ? $('#flash_message') : elementSelector;
    elementSelector.slideUp('normal');
  }

/* PROFILE JS ENDS HERE */
