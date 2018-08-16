@extends('layouts.admin')

@section('admin_content')
  <div class="row card">
    <div class="card-content">
  <table class="responsive-table striped" id="users-table">
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Email</th>
      <th>Created At</th>
      <th>Updated At</th>
    </tr>
  </thead>
</table>
</div>
</div>
@endsection
