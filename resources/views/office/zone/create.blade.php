@extends('office.layout')
@php
  $title = 'Create Zone'
@endphp
@section('content')
<div class="ui container">
  <h2 class="ui header">Add Zone</h2>
  <div class="ui grid">
    <div class="five wide column">
      <div class="ui bg-grey segment">
        <form action="/back-office/zone/create" class="ui form" method="POST">
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
            <label for="zone_category_id">Zone Category</label>
            <select name="zone_category_id" id="" class="ui dropdown">
              @foreach (\App\Models\ZoneCategory::all() as $zoneCategory)
                <option value="{{$zoneCategory->id}}">{{$zoneCategory->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="field">
          <label>Zone Colour</label>
          <div class='flex-space-around'>
            <label class="colour-box bg-zone-green active">
              <input type="radio" class="hide" name="bg_colour" checked="checked" value="#d6d7d9">
            </label>
            <label class="colour-box bg-zone-yellow">
              <input type="radio" class="hide" name="bg_colour" value="#91cdc6">
            </label>
            <label class="colour-box bg-zone-blue">
               <input type="radio" class="hide" name="bg_colour" value="#d4441f">
             </label> {{-- field --}}
          </div> {{-- flex-space-around --}}
          <div class='flex-space-around'>
            <label class="colour-box bg-zone-red">
              <input type="radio" class="hide" name="bg_colour" value="#3f78be">
            </label>
            <label class="colour-box bg-zone-tiffany">
              <input type="radio" class="hide" name="bg_colour" value="#ffc727">
            </label>
            <label class="colour-box bg-zone-grey">
               <input type="radio" class="hide" name="bg_colour" value="#01937c">
             </label> {{-- field --}}
          </div> {{-- flex-space-around --}}
        </div> {{-- field --}}
          <button class="ui red fluid button">Create New Zone</button>
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

@section('script')
<script>
  $('.colour-box').click(function(){
    $('.colour-box').removeClass('active');
    $(this).addClass('active');
  });
</script>
@endsection
