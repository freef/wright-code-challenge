@extends('layout')

@section('content')
<h1>Contact</h1>
<p>Call Matt</p>
<ul>
  @foreach($stuff as $thing)
  <li>{{ $thing; }}</li>
  @endforeach
</ul>
@endsection
