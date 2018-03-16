@extends('office.layout')
@php
  $title = 'Edit Zone'
@endphp
@section('content')
<div class="ui bg-grey container segment">
  <h2 class="ui header">Edit Zone</h2>
  <form action="/back-office/zone/edit" class="ui form" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{$zone->id}}">
    <div class="ui grid">
      <div class="four wide column">
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
              <option
                {{$zoneCategory->id == $zone->zone_category_id ? 'selected' : ''}} 
                value="{{$zoneCategory->id}}"
              >{{$zoneCategory->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="field">
          <label>Zone Colour</label>
          <input type="hidden" id="bg_colour_temp" value="{{$zone->bg_colour}}">
          <div class='flex-space-around'>
            <label class="colour-box bg-zone-green">
              <input type="radio" class="hide" name="bg_colour" value="#d6d7d9">
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
      </div> {{-- four wide column --}}
      <div class="ten wide column">
        <div class="field">
          <label for="">Draw area</label>
          <img src="/storage/{{$zone->level->map_path}}" alt="" class="ui image">
        </div>
      </div>
      <div class="two wide column">
        <div class="field">
          <label for="">Draw tools</label>
          <div class="ui icon buttons">
            <label class="ui large button"><i class="mouse pointer icon"></i></label>
            <label class="ui large button"><i class="object ungroup outline icon"></i></label>
          </div>
          <div class="ui icon buttons">
            <label class="ui large button"><i class="trash icon"></i></label>
            <label class="ui large button"><i class="i cursor icon"></i></label>
          </div>
        </div> {{-- field --}}
        <div class="field">
          <label for="">Font Colour</label>
          <input type="hidden" id="text_colour_temp" value="{{$zone->text_colour}}">
          <div class='flex-start'>
            <label class="colour-box bg-text-white" style="width:40px; height: 40px; display: block">
              <input type="radio" class="hide" name="text_colour" value="#FFF">
            </label>
            <label class="colour-box bg-text-black" style="width:40px; height: 40px; display: block">
              <input type="radio" class="hide" name="text_colour" value="#000">
            </label>
          </div> {{-- flex-start --}}
        </div> {{-- field --}}
        <div class="field">
          <label for="">Font Size</label>
          <select name="text_size" id="select_text_size" class="ui fluid dropdown">
            @foreach (['14px', '15px', '16px'] as $element)
              <option value="{{$element}}" {{$zone->text_size == $element ? 'selected' : ''}}>{{$element}}</option>
            @endforeach
          </select>
        </div> {{-- field --}}
      </div> {{-- two wide column --}}
      <div class="sixteen wide column">
        <div class="ui divider"></div>
        <button class="ui red button">Cancel</button>
        <button class="ui red pulled right button">Save</button>
        <button class="ui red pulled right button">Delete</button>
      </div>
    </div>
  </form>
</div>
@endsection

@section('script')
<script>
  $('.colour-box').click(function(){
    $(this).closest('.field').find('.colour-box').removeClass('active');
    $(this).addClass('active');
  });
  $('.colour-box').each(function(){
    var checked = $('#bg_colour_temp').val() == $(this).children('input').val();
    if (checked) {
     $(this).addClass('active'); 
     $(this).children('input').attr('checked', 'checked')
    }
    var checked = $('#text_colour_temp').val() == $(this).children('input').val();
    if (checked) {
     $(this).addClass('active'); 
     $(this).children('input').attr('checked', 'checked')
    }
  });

</script>
@endsection
