@extends('office.layout')
@php
  $title = 'Create Area'
@endphp
@section('content')
<div class="ui container">
  <h2 class="ui header">Add Area</h2>
  <div class="ui grid">
    <div class="five wide column">
      <div class="ui bg-grey segment">
        <form action="/back-office/area/create" class="ui form" method="POST">
          @csrf
          <input type="hidden" name="level_id" value="{{$level->id}}">
          <div class="field">
            <label for="name">Name</label>
            <input type="text" name="name">
          </div>
          <div class="field">
            <label for="name">Name Display</label>
            <input type="text" name="name_display">
          </div>
          <div class="field">
            <label for="area_category_ids">Area Category</label>
            <select multiple="multiple" name="area_category_ids[]" id="select_area_category_ids" class="" style="height: 420px;">
              @foreach (\App\Models\Category::all() as $areaCategory)
                <option value="{{$areaCategory->id}}">{{$areaCategory->name}}</option>
              @endforeach
            </select>
          </div>
          <button class="ui red fluid button">Create New Area</button>
        </form>
      </div>
    </div>
    <div class="eleven wide column">
      <div class="field">
        <label for="">Floor plan preview of level {{$level->name}}</label>
        <img src="/storage/{{$level->map_path}}" alt="" class="ui image">
      </div>
    </div>
  </div>
</div>
@endsection

