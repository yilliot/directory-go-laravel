@extends('office.layout')
@php
  $title = 'Edit Zone'
@endphp
@section('content')
<div class="ui bg-grey container segment">
  <h2 class="ui header">Edit Zone of {{$zone->block->name}}:{{$zone->level->name}} [{{$zone->level_id}}]</h2>
  <form action="/back-office/zone/edit" class="ui form" method="POST">
    @csrf
    <input type="hidden" id="map" value="/storage/{{$zone->level->map_path}}">
    <input type="hidden" id="data" name="area_json" value="{{$zone->area_json}}">
    <input type="hidden" name="id" value="{{$zone->id}}">
    <div class="ui grid">
      <div class="four wide column">
        <div class="field">
          <label for="name">Name</label>
          <input type="text" name="name" value="{{old('name', $zone->name)}}">
        </div>
        <div class="field">
          <label for="name">Name Display</label>
          <input type="text" name="name_display" id="text" value="{{old('name_display', $zone->name_display)}}">
        </div>
        <div class="field">
          <label for="zone_category_id">Zone Category</label>
          <select name="zone_category_id" id="select_zone_category_id" class="ui dropdown">
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
      </div> {{-- four wide column --}}
      <div class="ten wide column">
        <div class="field">
          <label for="">Draw area</label>
          @include('part.drawingboard', ['width' => 675, 'height' => 477])
          {{-- <img src="/storage/{{$zone->level->map_path}}" alt="" class="ui image"> --}}
        </div>
      </div>
      <div class="two wide column">
        <div class="field">
          <label for="">Draw tools</label>
          <div class="ui icon buttons">
            <label id="undo" class="ui large button tool"><i class="undo icon"></i></label>
            <label id="redo" class="ui large button tool"><i class="redo icon"></i></label>
          </div>
          <div class="ui icon buttons">
            <label id="poligon-tool" class="ui large button tool"><i class="pencil icon"></i></label>
            <label id="text-tool" class="ui large button tool"><i class="font icon"></i></label>
          </div>
          <div class="ui icon buttons">
            <label id="zoom-tool" class="ui large button tool"><i class="search icon"></i></label>
            <label id="drag-tool" class="ui large button tool"><i class="expand arrows alternate icon"></i></label>
          </div>
          <div class="ui icon buttons">
            <label id="clear" class="ui large button"><i class="trash icon"></i></label>
          </div>
        </div> {{-- field --}}
        <div class="field">
          <label for="">Font Colour</label>
          <input type="hidden" id="text_colour_temp" value="{{$zone->text_colour}}">
          <div class='flex-start'>
            <label class="colour-box fc bg-text-white" style="width:40px; height: 40px; display: block">
              <input type="radio" class="hide" name="text_colour" value="#FFF">
            </label>
            <label class="colour-box fc bg-text-black" style="width:40px; height: 40px; display: block">
              <input type="radio" class="hide" name="text_colour" value="#000">
            </label>
          </div> {{-- flex-start --}}
        </div> {{-- field --}}
        <div class="field">
          <label for="">Font Size</label>
          <select name="text_size" id="select_text_size" class="ui fluid dropdown">
            @foreach (['12px','13px','14px', '15px', '16px', '17px', '18px'] as $element)
              <option value="{{$element}}" {{$zone->text_size == $element ? 'selected' : ''}}>{{$element}}</option>
            @endforeach
          </select>
        </div> {{-- field --}}
      </div> {{-- two wide column --}}
      <div class="sixteen wide column">
        <div class="ui divider"></div>
        <a href="/back-office/zone/list/{{$zone->level_id}}" class="ui red button">Cancel</a>
        <button class="ui red pulled right button">Save</button>
        <button type="button" class="ui red pulled right modalcaller button" data-modal-id='delete_zone'>Delete</button>
      </div>
    </div>
  </form>
</div>

{!! Form::open(['url' => '/back-office/zone/delete', 'class' => 'ui small delete_zone modal']) !!}
  <input type="hidden" name="id" value="{{$zone->id}}">
  <div class="header capitalized">
    Delete zone {{$zone->name}}
  </div>
  <div class="center aligned content">
    Cofirm delete zone?
  </div>
  <div class="actions">
    <div class="ui cancel basic button">
      Cancel
    </div>
    <button class="ui red right labeled icon button">
      Delete <i class="trash icon"></i>
    </button>
  </div>
{!! Form::close() !!}
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
  $('.bg').click(function(){
    $('#bg_colour_temp').val($(this).children('input').val());
    $('#bg_colour_temp').trigger('change');
  });
  $('.fc').click(function(){
    $('#text_colour_temp').val($(this).children('input').val());
    $('#text_colour_temp').trigger('change');
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
  $('.tool').click(function(){
    var is_active = $(this).hasClass('active');
    $('.tool').removeClass('active');
    if(!is_active)$(this).addClass('active');
  });

  function update_colour_box()
  {
    let zone_category_id = $('#select_zone_category_id');
    if (zone_category_id.val() == '1') {
      let colour_box = $('#mk-choice').closest('.field').find('.colour-box');
      colour_box.show();
      $('#bc-choice').hide();
      $('#mk-choice').hide();
      colour_box.each(function(){
        if($(this).val() == $('#bg_colour_temp').val())
          $(this).click();
      });
      // TODO click the correct box
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
