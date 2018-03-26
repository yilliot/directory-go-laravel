@extends('office.layout')
@php
  $title = 'Edit Kiosk'
@endphp
@section('content')
<div class="ui segment bg-grey text container px-5">
  <h2>Edit Kiosk {{$kiosk->slug}}</h2>
  <form action="/back-office/kiosk/edit" class="ui form" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{$kiosk->id}}">
    <div class="field">
      <label for="slug">Name</label>
      <input name="slug" type="text" value="{{$kiosk->slug}}">
    </div>
    <div class="field">
      <label for="level_id">Level</label>
      <select name="level_id" class="ui dropdown">
        @foreach (\App\Models\Level::with('block')->get() as $level)
        <option value="{{$level->id}}" {{$level->id == $kiosk->level_id ? 'selected' : ''}} >
          {{$level->block->name}} :
          {{$level->name}}
        </option>
        @endforeach
      </select>
    </div>
    <div class="field">
      <label for="slug">Position JSON</label>
      <textarea name="position_json">{{$kiosk->position_json}}</textarea>
    </div>
    <div class="field">
      <label for="direction">Direction</label>
      <select name="direction" class="ui dropdown">
        <option value="1" {{$kiosk->direction == 1 ? 'selected' : ''}} >
          South
        </option>
        <option value="2" {{$kiosk->direction == 2 ? 'selected' : ''}} >
          North
        </option>
      </select>
    </div>

    <button class="ui red button pulled right">Save</button>
    <div class="clear"></div>
  </form>
</div>
@endsection