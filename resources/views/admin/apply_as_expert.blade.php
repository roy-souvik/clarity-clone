@extends('layouts.admin')


@section('admin_content')

  <!-- <h1 class="thin">Expert Applications</h1> -->
  <!--  Tables Section-->
  <div id="messages" class="mailbox section">
    <div class="row">
      {{-- <div class="col s12">
        <div class="z-depth-1">
          <nav class="z-depth-0">
            <div class="nav-wrapper">
              <div class="col s10 m7">
                <form>
                  <div class="input-field round-in-box">
                    <input id="search" type="search" required="" placeholder="Search not working">
                    <label for="search" class=""><i class="material-icons">search</i></label>
                    <i class="material-icons">close</i> </div>
                </form>
              </div>
              <div class="col s2 m5">
                <ul class="right">
                  <li class="">
                    <a href="#" class="dropdown-button" data-activates="dropdown1"><i class="mdi-navigation-more-vert"></i>
                    </a>

                    <ul id="dropdown1" class="dropdown-content slim">
                      <li>
                        <a href="#">
                          <i class="mdi-content-archive"></i> </a>
                        </li>
                      <li>
                        <a href="#"> <i class="mdi-action-delete"></i> </a>
                        </li>
                      <li class="divider"></li>
                      <li>
                        <a href="#"> <i class="mdi-action-settings"></i> </a>
                      </li>
                    </ul>

                  </li>
                </ul>
              </div>
            </div>
          </nav>

          <ul class="tabs tab-demo" style="width: 100%;">
            <li class="tab col s4">
              <a class="active" href="javascript:void(0)">
                <span class="new badge">{{ $users->total() }}</span>
                Applications
              </a>
            </li>
          </ul>


        </div>
      </div> --}}
      <div class="col s12">
        <div class="card-panel no-padding">
      <!--  MAIN mailbox START-->
          <div id="main-mailbox" style="display: block;">

              <table class="list bordered highlight">
                <thead>
                  <tr>
                    <th class="first">
                      <b>{{ $users->total() . ucwords(' new expert ' . str_plural('application') ) }}</b>
                    </th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($users as $user)

                    <tr class="unreaded">
                      <td>
                        <div class="cell-row">
                          <div class="cell">

                            <img src="/uploads/profile-pictures/thumbs/{{ $user->getProfilePicture() }}" alt="profile image" class="simple-avatar small circle left">

                            <h6>{{ $user->getFullName() }} <em>[ {{ $user->getEmail() }} ]</em> </h6>
                            <p>{{ $user->getShortBio() }}</p>
                          </div>
                          <div class="cell">
                            {{-- <span class="new badge static"></span><br/> --}}
                            <span class="datetime">{{ $user->getUpdatedAtTime() }} </span>
                          </div>
                          <div class="cell w2 last">
                            <a id="approve" class="" href="{{ route('approve_expert',['user_id'=>$user->id]) }}">
                              {{-- <i class="small material-icons">perm_identity</i>  --}}
                              Approve
                            </a>
                          </div>
                        </div>
                      </td>
                    </tr>

                @endforeach

                </tbody>
              </table>

            <div class="center-align row">
              {!! $users->render() !!}
            </div>

          </div>
    <!--  MAIN END -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- container END -->

@endsection
