<!-- resources/views/common/flashMessage.blade.php -->

@if(Session::has('flash_message'))
  <div class="alert alert-success fade in" id="flash_message">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success! </strong> {!! session('flash_message') !!}
  </div>
@endif
