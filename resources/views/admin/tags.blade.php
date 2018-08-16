@extends('layouts.admin')

@section('admin_content')
<div class="row card">
  <div class="card-content">
    <table class="responsive-table striped" id="tags-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Created At</th>
          <th class="hide">Visibility Status</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>

</div>


@endsection
