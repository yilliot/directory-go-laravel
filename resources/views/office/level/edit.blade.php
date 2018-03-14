@extends('office.layout')
@php
  $title = 'Edit Level'
@endphp
@section('content')
<div class="ui segment bg-grey text container px-5">
  <h2>Edit Block {{$level->name}}</h2>
  <form action="/back-office/level/edit/{{$level->id}}" class="ui form" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="two fields">
      <div class="field">
        <label for="name">Name</label>
        <input name="name" type="text" value="{{$level->name}}">
      </div>
      <div class="field">
        <label for="level_order"> Assigned Level </label>
        <input type="text" disabled="disabled" value="{{$level->level_order}}">
      </div>
    </div>
    <div class="field">
      @if ($level->map_path)
        <label for="image_path">Image</label>
        <img src="/storage/{{$level->map_path}}" alt="" class="ui fluid image">
      @else
        No floor plan image yet
      @endif
      <input type="file" name="map_path" class="hide" id="fileinput-map" />
      <label for="fileinput-map" class="ui red button" style="color:white">
        <i class="ui upload icon"></i> 
        Upload image
      </label>
    </div>
    <button class="ui red button pulled right">Save</button>
    <a href="/back-office/level/list/{{$level->block_id}}" class="ui basic button pulled right">Cancel</a>
    <div class="clear"></div>
  </form>
</div>
@endsection