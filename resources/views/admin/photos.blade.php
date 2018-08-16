@extends('layouts.admin')

@section('admin_content')

<div class="col s12">
<div class="card-panel no-padding" style="display: block;"> 
<a href="{{url('/admin/addphoto/1')}}" class="right">Add new Photo</a> 
<table class="list bordered highlight" id="photo-table">
  <div class="card-panel no-padding" style="display: block;">
  <table class="list bordered highlight" id="photo-table">
              <thead>
                <tr>
                  <th class="first">Album Name</th>
                  <th class="first">Image</th>
                  <th class="first">Updated At</th>
                  <th class="right">Action</th>
                 </tr>
              </thead>
              <tbody>
              @if($photos->count() > 0)
                 @foreach ($photos as $photo)
                      <tr class="unreaded">
                        <td>
                          <div class="cell-row">
                            <div class="cell">
                              <h6>{{ $photo->album->getName() }}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="cell-row">
                            <div class="cell">
                              <img src="/uploads/category/{{ $photo->getPhoto(false) }}" alt="default image">
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="cell-row">
                            <div class="cell">
                                  <span class="datetime">{{ $photo->getUpdatedAt() }} </span>
                            </div>
                          </div>  
                        </td>    
                        <td>
                          <div class="cell-row">
                            <div class="cell w2 last">
                              <a id="delete" class="right" href="#">
                                Delete
                              </a>
                            </div>
                          </div>  
                        </td>    
                      </tr>
                  @endforeach
                 @else
                  <tr>
                    <td colspan=3>No photos</td>
                  </tr>   
                @endif
                              
              </tbody>
    </table>
  </div>
</div>


@endsection