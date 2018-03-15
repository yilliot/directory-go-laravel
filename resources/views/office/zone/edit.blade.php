@extends('office.layout')
@php
  $title = 'Edit Zone'
@endphp
@section('content')
<div class="ui container">
  <div class="ui grid">
    <div class="four wide column">
      <div class="ui bg-grey segment">
        <form action="/back-office/zone/create" class="ui form" method="POST">
          @csrf
          <input type="hidden" name="id" value="{{$zone->id}}">
          <div class="field">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{old('name', $zone->name)}}">
          </div>
          <div class="field">
            <label for="name">Name Display</label>
            <input type="text" name="name_display" value="{{old('name_display', $zone->name_display)}}">
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
            <div class="three fields">
              <div class="field">
                <label class="colour-box bg-zone-green">
                  <input type="radio" class="hide" name="bg_colour" checked="checked" value="#d6d7d9">
                </label>
              </div>
              <div class="field">
                <label class="colour-box bg-zone-yellow">
                  <input type="radio" class="hide" name="bg_colour" value="#91cdc6">
                </label>
              </div>
              <div class="field">
                <label class="colour-box bg-zone-blue">
                  <input type="radio" class="hide" name="bg_colour" value="#d4441f">
                </label>
              </div> {{-- field --}}
            </div> {{-- three fields --}}
            <div class="three fields">
              <div class="field">
                <label class="colour-box bg-zone-red">
                  <input type="radio" class="hide" name="bg_colour" value="#3f78be">
                </label>
              </div>
              <div class="field">
                <label class="colour-box bg-zone-tiffany">
                  <input type="radio" class="hide" name="bg_colour" value="#ffc727">
                </label>
              </div>
              <div class="field">
                <label class="colour-box bg-zone-grey">
                  <input type="radio" class="hide" name="bg_colour" value="#01937c">
                </label>
              </div> {{-- field --}}
            </div> {{-- three fields --}}
          </div> {{-- field --}}
          <button class="ui red fluid button">Update Zone</button>
        </form>
      </div>
    </div>
    <div class="twelve wide column">
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  $('.colour-box').click(function(){
    $('.colour-box').removeClass('active');
    $(this).addClass('active');
  })
</script>
@endsection
