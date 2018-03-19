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
            <select name="zone_category_id" id="select_zone_category_id" class="ui dropdown">
              @foreach (\App\Models\ZoneCategory::all() as $zoneCategory)
                <option value="{{$zoneCategory->id}}">{{$zoneCategory->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="field">
            <label>Zone Colour</label>
            <div class='flex-space-around'>
              <label class="colour-box bg bg-zone-green">
                <input type="radio" class="hide" name="bg_colour" value="#01937c">
              </label>
              <label class="colour-box bg bg-zone-yellow">
                <input type="radio" class="hide" name="bg_colour" value="#ffc727">
              </label>
            </div> {{-- flex-space-around --}}
            <div class='flex-space-around'>
              <label class="colour-box bg bg-zone-blue">
                 <input type="radio" class="hide" name="bg_colour" value="#3f78be">
               </label> {{-- field --}}
              <label class="colour-box bg bg-zone-red">
                <input type="radio" class="hide" name="bg_colour" value="#d4441f">
              </label>
            </div>
            <div class="flex-space-around">
              <label id="mk-choice" class="colour-box bg bg-zone-tiffany">
                <input type="radio" class="hide" name="bg_colour" value="#91cdc6">
              </label>
              <label id="bc-choice" class="colour-box bg bg-zone-grey">
                 <input type="radio" class="hide" name="bg_colour" value="#d6d7d9">
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
  $('#select_zone_category_id').change(function(){
    update_colour_box();
  });
  $('.colour-box').click(function(){
    $(this).closest('.field').find('.colour-box').removeClass('active');
    $(this).addClass('active');
  });


  function update_colour_box()
  {
    let zone_category_id = $('#select_zone_category_id');
    if (zone_category_id.val() == '1') {
      let colour_box = $('#mk-choice').closest('.field').find('.colour-box');
      colour_box.show();
      $('#bc-choice').hide();
      $('#mk-choice').hide();
      colour_box.first().click();
    }
    if (zone_category_id.val() == '2') {
      let colour_box = $('#mk-choice').closest('.field').find('.colour-box');
      colour_box.show();
      colour_box.not('#mk-choice').hide();
      $('#mk-choice').click();
    }
    if (zone_category_id.val() == '3') {
      let colour_box = $('#bc-choice').closest('.field').find('.colour-box');
      colour_box.show();
      colour_box.not('#bc-choice').hide();
      $('#bc-choice').click();
    }
  }
  $(function(){
    update_colour_box();
  });

</script>
@endsection
