@extends('layouts.admin')


@section('admin_content')

<h1 class="thin">Expert Applications</h1>
<!--  Tables Section-->
<div id="messages" class="mailbox section">
  <div class="row">
    <div class="col s12">
  <div class="z-depth-1">
    <ul class="tabs account" style="width: 100%;">
      <li class="col s4 tab">
        <a class="" href="#personal">Profile</a>
      </li>
      <li class="col s4 tab">
        <a href="#password" class="">Password</a>
      </li>
      <li class="col s4 tab">
        <a href="#privacy" class="active">Privacy</a>
      </li>
      <div class="indicator" style="right: 1px; left: 580px;"></div>
    </ul>
  </div>
    </div>
    <div class="col s12">
      <div class="card-panel no-padding">
  <!-- Personal tab START -->
   <div id="personal" style="display: none;">
       <form>
       <div class="form-pad">
        <div class="row">
        <div class="col s12 m8 push-m4">
        <!-- Personal info FIELDS -->
          <div class="input-field">
            <input id="first_name" type="text" class="validate" value="Caroline">
            <label for="first_name" class="active">First Name</label>
          </div>
          <div class="input-field">
            <input id="last_name" type="text" class="validate" value="Doe">
            <label for="last_name" class="active">Last Name</label>
          </div>
          <div class="input-field">
            <input id="phone" type="tel" class="validate" value="+1 22 333 444 555">
            <label for="phone" class="active">Phone</label>
          </div>
          <div class="input-field">
            <input id="email" type="email" class="validate" value="info(at)monstercall.com">
            <label for="email" data-error="wrong" data-success="right" class="active">Email</label>
          </div>
          <div class="input-field with-note">
            <input id="skills" type="text" class="validate" value="html, css, sass, js, php">
            <label for="skills" class="active">Skills</label>
            <span class="note">Please, provide comma separated list.</span>
          </div>
          <div class="input-field">
            <textarea id="about" class="materialize-textarea" style="height: 66px;">Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. </textarea>
            <label for="about" class="active">About</label>
          </div>
          <div class="input-field">
            <input placeholder="http://www.monstercall.com" id="weburl" type="text" class="validate">
            <label for="weburl" class="active">Website Url</label>
          </div>
        </div>
        <div class="col s12 m4 pull-m8">
          <!-- Personal info PROFILE PHOTO -->
          <div class="form-pad center-align">
          <img class="responsive-img circle" src="{{url('assets/admin/assets/operator-female-smile_sml01.jpg')}}">
          <div class="file-field input-field">
            <div class="btn no-float primary-color">
              <i class="material-icons large">file_upload</i>
              <input type="file">
            </div>
            <div class="file-path-wrapper hide">
              <input class="file-path validate center-align" type="text">
            </div>
          </div>
          </div>
        </div>
      </div>
      <!-- Save Cancel -->
      <div class="row">
        <div class="col s12 m8 push-m4 buttons">
           <button class="waves-effect waves-light btn" type="submit" name="action1"><i class="material-icons right">done</i>Save changes</button>
           <button class="waves-effect waves-light btn blue-grey lighten-2" type="submit" name="action2"><i class="material-icons right">clear</i>Cancel</button>
          </div>
      </div>
      </div>
       </form>
   </div>
   <!-- Personal tab END -->
   <!-- Password tab START -->
   <div id="password" style="display: none;">
     <form>
     <div class="form-pad">
      <div class="row">
      <div class="col s12">
        <div class="input-field">
          <input id="current" type="password" class="validate">
          <label for="current">Current Password</label>
        </div>
        <div class="input-field">
          <input id="new" type="password" class="validate">
          <label for="new">New Password</label>
        </div>
        <div class="input-field">
          <input id="re-type-new" type="password" class="validate">
          <label for="re-type-new">Re-type New Password</label>
        </div>
        <div class="buttons">
          <button class="waves-effect waves-light btn" type="submit" name="action1"><i class="material-icons right">done</i>Save changes</button>
          <button class="waves-effect waves-light btn blue-grey lighten-2" type="submit" name="action2"><i class="material-icons right">clear</i>Cancel</button>
        </div>
      </div>
    </div>
     </div>
     </form>
   </div>
   <!-- Password tab END -->
   <!-- Privacy tab START -->
   <div id="privacy" style="display: block;">
       <form>
       <div class="form-pad">
        <div class="row">
        <div class="col s12">

            <div class="row" style="margin-top: 20px;">
              <!-- Switch Title -->
              <div class="col s12 m8">
                <span>Cras vitae lobortis lectus</span>
              </div>
              <!-- Switch -->
              <div class="col s12 m4">
                <div class="switch right">
                <label>
                  Off
                  <input type="checkbox" checked="checked">
                  <span class="lever"></span>
                  On
                </label>
                </div>
                </div>
            </div>

            <div class="divider"></div>

            <div class="row" style="margin-top: 20px;">
              <!-- Switch Title -->
              <div class="col s12 m8">
                <span>Cras laoreet dui</span>
              </div>
              <!-- Switch -->
              <div class="col s12 m4">
                <div class="switch right">
                <label>
                  Off
                  <input type="checkbox">
                  <span class="lever"></span>
                  On
                </label>
                </div>
                </div>
            </div>

            <div class="divider"></div>
          <div class="buttons" style="margin-top: 20px;">
            <button class="waves-effect waves-light btn" type="submit" name="action1"><i class="material-icons right">done</i>Save changes</button>
            <button class="waves-effect waves-light btn blue-grey lighten-2" type="submit" name="action2"><i class="material-icons right">clear</i>Cancel</button>
          </div>
        </div>
      </div>
       </div>
       </form>
   </div>
   <!-- Privacy tab END -->
  </div>
    </div>

    <div class="section col s12">
      <div class="row">

        <!--SOCIAL card dark START -->
        <div class="col s12 m4">
          <div class="card">
            <div class="card-content center-align">
              <div class="card-title truncate">Caroline Doe</div>
              <div class="air-box-6"> <img class="responsive-img circle" src="{{url('assets/admin/assets/operator-female-smile_sml01.jpg')}}"> </div>
              <p>support</p>
              <br>
              <div class="center-align social">
                <a href="#" class="circle">
                  <img class="responsive-img" src="{{url('assets/admin/assets/facebook.svg')}}">
                </a>
                <a href="#" class="circle">
                  <img class="responsive-img" src="{{url('assets/admin/assets/twitter.svg')}}">
                </a>
                <a href="#" class="circle">
                  <img class="responsive-img" src="{{url('assets/admin/assets/gplus.svg')}}">
                </a>
              </div>
            </div>
            <div class="card-action center-align truncate">
              <a href="#">San Jose, California</a>
            </div>
          </div>
        </div>
        <!--SOCIAL card END -->

      </div>
    </div>
  </div>
</div>


@endsection
