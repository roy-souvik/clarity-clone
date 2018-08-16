<!DOCTYPE html>
<html lang="en">

@include('admin.includes.head')

<body class="">
<!-- Preloader START -->
<div class="stage-wrapper">
    <div class="stage" style="opacity: 0;">
      <div class="preloader-wrapper big active" style="display: none;">
        <div class="spinner-layer">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div><div class="gap-patch">
            <div class="circle"></div>
          </div><div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
    </div>
</div>
<!-- Preloader END -->

<!-- Header START -->
@include('admin.includes.header')
<!-- Header END -->

<!-- Main START -->
<main>
  <div class="container">

    @yield('admin_content')

  </div> <!-- container END -->
  <input type="hidden" name="baseUrl" id="baseUrl" value="{{ url('/') }}">
</main>
<!-- Main END -->
{{ HTML::script('assets/admin/assets/jquery-2.1.4.min.js') }}
{{ HTML::script('assets/admin/assets/prism.js') }}
{{ HTML::script('assets/admin/assets/simplebar.min.js') }}
<!-- {{ HTML::script('assets/admin/assets/materialize.min.js') }} -->

{{ HTML::script('assets/admin/assets/initialize.js') }}

{{ HTML::script('//cdn.tinymce.com/4/tinymce.min.js')}} <!-- for WYSIWYG editor -->
<!-- for category -->
{{ HTML::script('assets/js/category/script.js') }}
<!-- /for category -->
<!-- for users -->
{{ HTML::script('assets/js/sweetalert/sweetalert.min.js') }}
{{ HTML::script('assets/js/admin/script.js') }}
<!-- /for users -->
<!-- adding datatables -->
{{ HTML::script('//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js')}}
{{ HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js')}}
<!-- /adding datatables -->

<!-- Toastr -->
{{ HTML::script('assets/js/toastr/toastr.min.js') }}
{{ HTML::script('assets/js/helpers.js') }}
{!! Toastr::render() !!}
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js') }}
<script>
	window.onload = function(){
	  /* Hide Preloader */
  	$('.preloader-wrapper').css({ display: "none" });
  };
  $(document).ready(function() {
    $('select').material_select();
  });
</script>

</body>
</html>
