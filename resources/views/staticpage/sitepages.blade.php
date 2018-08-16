@extends('layouts.inner')
@section('content')

<h3 style = "text-align:center">{{$page->title}}</h3>


{!! html_entity_decode($page->content) !!}

@endsection
