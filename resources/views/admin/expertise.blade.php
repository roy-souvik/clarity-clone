@extends('layouts.admin')

@section('admin_content')
    <div class="row card">
        <div class="card-content">
            <table class="responsive-table striped" id="expertise-table">
                <thead>
                <tr>
                    <th>Expertise</th>
                    <th>Expert</th>
                    <th>Email</th>
                    <th>Tags</th>
                    <th class="hide">Featured Status</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>

    </div>


@endsection