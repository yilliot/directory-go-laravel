@extends('office.layout')
@php
  $title = 'Level'
@endphp
@section('content')
  <div class="ui container">
    <h1>All Floors</h1>
    @foreach ($levels->groupBy('block_id') as $blocksArr)
      <h3>
        <a href="/back-office/level/list/{{$blocksArr->first()->block_id}}">
          Block {{$blocksArr->first()->block->name}}
        </a>
      </h3>
      <ul class="ui list">
      @foreach ($blocksArr as $level)
        <li><a href="/back-office/level/list/{{$level->block_id}}">{{$level->name}}</a></li>
      @endforeach
      </ul>
    @endforeach
  </div>
@endsection