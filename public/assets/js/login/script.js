$(document).ready(function() {


		function validate_confirm_password()
		{
			//alert($("#frm-user-create #password").val());
			//alert($("#password_confirmation").val());

			if($("#frm-user-create #password_reg").val() != '' || $("#password_confirmation").val() != '' ) {

					if($("#frm-user-create #password_reg").val() != $("#password_confirmation").val() ) {

						$("#password_confirmation").addClass('error-border-color');
						$("#password_confirmation_error").addClass('has-error form-error');
						$("#password_confirmation_error").html('<span class="help-block form-error">Password and Confirm Password do not match.</span>');

						return false;
					}

			}

			$("#password_confirmation").removeClass('error-border-color');
			$("#password_confirmation_error").removeClass('has-error form-error');
			$("#password_confirmation_error").html('');

			return true;
		}

		$('#password_confirmation').blur(function() {

			validate_confirm_password();

		});


		$.validate({


			form : '#frm-user-create',

			validateOnBlur : true,
			/*errorMessagePosition : 'top',*/
			scrollToTopOnError : false,

			onError : function() {
			  //alert('Validation failed.\nThere are error(s) in the form.');
			  validate_confirm_password();
			},


			onSuccess : function() {

				if(validate_confirm_password() == false)
					return false;


				var formData 	= 	$("#frm-user-create").serializeArray();

				// AJAX Form Submit

				var formActionUrl 	= $("#frm-user-create").attr('action');
				var formMethod		= $("#frm-user-create").attr('method');

				//======================
				$.ajax({

					type: formMethod,

					url: formActionUrl,
					dataType: "json",

					data: formData,

					beforeSend:function(){
						//$(".modal").show();
					},

					success: function(data) {

						if(data.status == 1) {

							swal({
							     title: "Success!",
							     text: data.text,
							     type: "success"
						     	},
						     function () {
						        $('.modal-header > .close').click();
						    });
							
						} else {
							console.log(JSON.stringify(data));
							swal("Error!", data.text, "error");
						}

					},

					error: function(xhr, status, error) {
						swal("Error!", "Something went wrong . Please contact site administrator.", "error");
						console.error(error);

					}

				}); // Ajax End
				//======================

				return false; // Will stop the submission of the form
			},


		}); //END validate




		$.validate({


			form : '#frm-do-login',

			validateOnBlur : true,
			scrollToTopOnError : false,

			onError : function() {
			  //alert('Validation failed.\nThere are error(s) in the form.');
			},


			onSuccess : function() {


				var formData 	= 	$("#frm-do-login").serializeArray();

				// AJAX Form Submit

				var formActionUrl 	= $("#frm-do-login").attr('action');
				var formMethod		= $("#frm-do-login").attr('method');

				//======================
				$.ajax({

					type: formMethod,

					url: formActionUrl,
					dataType: "json",

					data: formData,

					beforeSend:function(){
						//$(".modal").show();
					},

					success: function(data) {

						//alert(data.toSource());

						if(data.status == 1) {
							//alert(data.text);
							location.href = '/dashboard';

						} else {

							console.log(JSON.stringify(data));
							alert(data.text);
						}

					},

					error: function(xhr, status, error) {
							if (xhr.statusText === "Bad Request") {
									var responseText	=	JSON.parse(xhr.responseText);
									swal("Error!", responseText.text, "error");
									return false;
							}
							swal("Error!", "Invalid Login Attempt...!", "error");
							return false;
					}

				}); // Ajax End
				//======================

				return false; // Will stop the submission of the form
			},


		}); //END validate

});
