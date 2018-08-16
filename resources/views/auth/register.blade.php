<!-- Sign Up Modal - Start -->
<div aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="signUpModalDiv" class="modal fade" style="display: none;">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
            <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
            <h4 id="myModalLabel" class="modal-title">Sign Up for Monster call</h4>
          </div>


				<div class="modal-body">


				<div class="mforminner">

				{{ Form::open(array('route' => array('register'), 'method' => 'post', 'id' => 'frm-user-create', 'role' => 'form', 'class' => "form-horizontal"   )) }}

						<div class="form-group">
						  <div class="input-group">
							<div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
							<input id="first_name" placeholder="First Name" type="text" class="form-control" name="first_name"

							data-validation-error-msg-container = "#first_name_error" data-validation-length="3-50"
							data-validation="required alphanumeric length"  data-validation-allowing=" "

							/>
							<small class="help-block"></small>
						  </div>

						  <div id="first_name_error"></div>

						</div>


						<div class="form-group">
						  <div class="input-group">
							<div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
							<input id="last_name" placeholder="Last Name" type="text" class="form-control" name="last_name"

							data-validation-error-msg-container = "#last_name_error" data-validation-length="3-50"
							data-validation="required alphanumeric length"  data-validation-allowing=" "

							/>
							<small class="help-block"></small>
						  </div>

						  <div id="last_name_error"></div>

						</div>


						<div class="form-group">
						  <div class="input-group">
							<div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
							<input id="email_reg" placeholder="Email" type="text" class="form-control" name="email" 

							data-validation-error-msg-container = "#email_reg_error" data-validation="required email"

							/>
							<small class="help-block"></small>
						  </div>

						   <div id="email_reg_error"></div>

						</div>
						<div class="form-group">
						  <div class="input-group">
							<div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
							<input id="password_reg" placeholder="Password" type="password" class="form-control" name="password"

							autocomplete="off" data-validation-error-msg-container = "#password_reg_error"
							data-validation="required length"  data-validation-length="6-20"

							/>
							<small class="help-block"></small>
						  </div>
						  <div id="password_reg_error"></div>

						</div>


						<div class="form-group">
						  <div class="input-group">
							<div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
							<input type="password" placeholder="Confirm Password" id="password_confirmation" class="form-control" name="password_confirmation"

							autocomplete="off" data-validation-error-msg-container = "#password_confirmation_error"
							data-validation="required length"  data-validation-length="6-20"

							/>
							<small class="help-block"></small>
						  </div>

						  <div id="password_confirmation_error"></div>

						</div>


						<button class="btn btn-primary btn-lg btn-block" type="submit">Continue</button>



				{{ Form::close() }}

				  <a href="#" data-toggle="modal" data-target="#loginModalDiv" data-dismiss="modal">Already a Clarity member? Log In</a>
				  <div class="linkpart">
					You can sign up using <a href="{{url('/auth/linkedin')}}">Linkedin</a> or <a href="{{url('/auth/facebook')}}">Facebook.</a>
				  </div>
				  By signing up, you agree to our <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>, and you confirm that you're 18 years old or over.

			</div>



			</div>
        </div>
    </div>
</div>

<!-- Sign Up Modal - End -->
