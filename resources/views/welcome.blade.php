@extends('components.dashboard-layout')

@section('content')

  <div class="text-center font-jakarta-sans font-semibold text-xl text-gray-800">{{ Auth::user()->role }}</div>
@stop
