@extends('office.layout')
@php
  $title = 'Zones list'
@endphp
@section('content')
<div class="ui container">
  <div class="ui grid">
    <div class="ten wide column">
      <div class="ui segment bg-grey">

        <h2 class="ui header">Manage Zones of Blk:{{$level->block->name}} Level:{{$level->name}}</h2>
        <div class="ui form">
          <div class="two fields">
            <div class="field">
              <select name="block" id="select-level" class="ui dropdown">
                @foreach (\App\Models\Level::with('block')->where('is_activated', true)->get() as $levelLoop)
                  <option {{$levelLoop->id == $level->id ? 'selected' : ''}} value="{{$levelLoop->id}}">
                    Blk:{{$levelLoop->block->name}} Lv:{{$levelLoop->name}}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="field">
              <a href="/back-office/zone/create/{{$level->id}}" class="ui red pulled right button">New Zone</a>
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
          @foreach ($level->zones as $zone)
          <tr>
            <td>{{$loop->index + 1}}</td>
            <td>{{$zone->name}}</td>
            <td>{{$zone->name_display}}</td>
            <td>
              <a href="/back-office/zone/edit/{{$zone->id}}" class="ui red mini button">EDIT</a>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div> {{-- ten wide column --}}
    <div class="six wide column">
      <div class="ui segment bg-grey">
        <h2 class="ui header">Preview</h2>
        <input type="hidden" id="map" value="/storage/{{$level->map_path}}">
        @include('part.preview', ['width' => 375, 'height' => 265, 'area_jsons' => $area_jsons]) {{-- Here need to input the array of area_json  --}}
        {{-- <img src="/storage/{{$level->map_path}}" alt="" class="ui fluid image"> --}}
      </div>
    </div> {{-- six wide column --}}
  </div>
</div>
@endsection
@section('script')
<script>
  $('#select-level').change(function(){
    location.href = '/back-office/zone/list/' + $(this).val();
  });
</script>
@endsection