<section class="searchicon">
  <a href="javascript:toggle1();" id="displayText1">
    <img src="{{ url('assets/images/search_icon.png') }}" alt="search icon">
  </a>

  <div id="toggleText1" style="display:none;" class="search_link">
    <div class="serachinner">
      <img src="{{ url('assets/images/arrowtop.png') }}" class="toparrow" alt="top arrow">

      {!! Form::open(['method' => 'GET', 'route' => ['siteSearch'] ]) !!}
      
        {!! Form::text('q', null, ['class' => 'serachinner_field', 'placeholder' => 'Search here...']) !!}
        {!! Form::submit('', ['class' => 'popsearch']) !!}

      {!! Form::close() !!}

    </div>
  </div>

</section>
