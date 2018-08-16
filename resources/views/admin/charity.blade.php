@extends('layouts.admin')

@section('admin_content')
<div class="row card">
  <div class="card-content">
  <table class="responsive-table striped" id="charity-table">
    <thead>
      <tr>
        <th>UserName</th>
        <th>UserEmail</th>
        <th>CharityName</th>
        <th>CharityUrl</th>
        <th class="hide">Visibility Status</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
</div>
</div>


@endsection
