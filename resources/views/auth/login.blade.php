<!-- Login Modal - Start -->
<div aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="loginModalDiv" class="modal fade in" style="display: none;">
  <div role="document" class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
		<h4 id="myModalLabel" class="modal-title">Log In</h4>
	  </div>
	  <div class="modal-body">
		<div class="mforminner">


		  {{ Form::open(array('route' => array('login'), 'method' => 'post', 'id' => 'frm-do-login', 'role' => 'form', 'class' => "form-horizontal"   )) }}


			<div class="form-group">
			  <div class="input-group">
				<div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
				<input id="email" type="text" placeholder="Email" name="email" class="form-control" 
				data-validation-error-msg-container = "#email_error" data-validation="required email"
				/>
				<small class="help-block"></small>
			  </div>

			  <div id="email_error"></div>

			</div>

			<div class="form-group">
			  <div class="input-group">
				<div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
				<input type="password" placeholder="Password" id="password" class="form-control" name="password"


				autocomplete="off" data-validation-error-msg-container = "#password_error"
				data-validation="required length"  data-validation-length="6-20"

				/>
				<small class="help-block"></small>
			  </div>

			  <div id="password_error"></div>

			</div>


			<button class="btn btn-primary btn-lg btn-block" type="submit">LOG IN</button>


		  {{ Form::close() }}

		  <a href="#" data-toggle="modal" data-target="#signUpModalDiv" data-dismiss="modal">Don't have a Clarity account yet? Sign Up</a>
		  <div class="linkpart">
			You can log in using <a href="{{url('/auth/linkedin')}}">Linkedin</a> or <a href="{{url('/auth/facebook')}}">Facebook.</a><br>
			<a href="{{url('/password/reset')}}">Forgot password?</a>
		  </div>
		  By signing up, you agree to our <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>, and you confirm that you're 18 years old or over.
		</div>
	  </div>
	</div>
  </div>
</div>
<!-- Login Modal - End -->
