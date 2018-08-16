@extends('layouts.inner')

@section('content')

      <div class="row profile">
        <div class="col-sm-12 information">
          <h3>Add your areas of expertise</h3>
          <strong>Add expertise listings to your profile to make it easier for others to find you.</strong>
          
            <div class="geenbutt">
<a class="btn btn-primary btn-lg" href="{{ route('show_new_expertise_form') }}">New Area of Expertise</a>
</div>
          
        </div>
      </div>



@endsection