@extends('layouts.admin')

@section('admin_content')

  <h1 class="thin">Dashboard</h1>
  <div id="dashboard">

    <div class="row">
      <!-- Latest Tasks START -->
      <div class="col s12 m6">
        <div id="tasks" class="card hoverable">
          <ul class="collection with-header">
            <li class="collection-header primary-color">
              <h5 class="light secondary-color-text">My Tasks <a href="#" class="secondary-content tooltipped" data-position="bottom" data-delay="50" data-tooltip="View All" data-tooltip-id="9d98bd53-af2f-b87d-533c-d394eb5f4ca2"><i class="material-icons secondary-color-text">arrow_forward</i></a></h5>
            </li>
            <li class="collection-item in-progress">
              <p>Create e-commerce cards<br>
                <span class="badge static pink accent-4">UI/UX</span> <span class="secondary-content">25%</span> </p>
              <div class="progress">
                <div class="determinate" style="width: 25%"></div>
              </div>
            </li>
            <li class="collection-item in-progress">
              <p>Implement another smart JS<br>
                <span class="badge static blue">Development</span> <span class="secondary-content">67%</span> </p>
              <div class="progress">
                <div class="determinate" style="width: 67%"></div>
              </div>
            </li>
            <li class="collection-item finished">
              <p>SASS code revision<br>
                <span class="badge static blue">Development</span> <span class="secondary-content"><i class="material-icons">check</i></span> </p>
            </li>
          </ul>
        </div>
      </div>
      <!-- Latest Tasks END -->
    </div>

  <div class="section">
    <p>{{ ucwords(Config::get('monster_call.site_name')) }}</p>
  </div>

 </div>
@endsection
