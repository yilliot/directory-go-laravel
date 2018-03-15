@extends('office.layout')
@php
  $title = 'Areas list'
@endphp
@section('content')
<div class="ui container">
  <div class="ui grid">
    <div class="ten wide column">
      <div class="ui segment bg-grey">

        <h2 class="ui header">Manage Areas of Blk:{{$level->block->name}} Level:{{$level->name}}</h2>
        <div class="ui form">
          <div class="two fields">
            <div class="field">
              <select name="block" id="select-level" class="ui dropdown">
                @foreach (\App\Models\Level::isActivated()->get() as $levelLoop)
                  <option {{$levelLoop->id == $level->id ? 'selected' : ''}} value="{{$levelLoop->id}}">
                    Blk:{{$levelLoop->block->name}} Lv:{{$levelLoop->name}}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="field">
              <a href="/back-office/area/create" class="ui red pulled right button">New area</a>
            </div>
          </div>
        </div> {{-- ui form --}}

        <table class="ui very compact table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Display Name</th>
              <th>Action</th>
            </tr>
          </thead>
          @foreach ($level->areas as $area)
          <tr>
            <td>{{$loop->index + 1}}</td>
            <td>{{$area->name}}</td>
            <td>{{$area->name_display}}</td>
            <td>
              <a href="/back-office/area/edit/{{$area->id}}" class="ui red mini button">EDIT</a>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div> {{-- ten wide column --}}
    <div class="six wide column">
      <div class="ui segment bg-grey">
        <h2 class="ui header">Category Preview</h2>
        <select name="select_category" id="select_category" class="ui dropdown">
          @foreach (\App\Models\Category::all() as $category)
            <option value="{{$category->id}}">
              {{$category->name}}
            </option>
          @endforeach
        </select>
        <div class="ui divider"></div>
        <img src="/storage/{{$level->map_path}}" alt="" class="ui fluid image">
      </div>
    </div> {{-- six wide column --}}
  </div>
</div>
@endsection
@section('script')
<script>
  $('#select-level').change(function(){
    location.href = '/back-office/area/list/' + $(this).val();
  });
</script>
