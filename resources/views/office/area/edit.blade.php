@extends('office.layout')
@php
  $title = 'Edit Area'
@endphp
@section('content')
<div class="ui bg-grey container segment">
  <h2 class="ui header">Edit Area</h2>
  <form action="/back-office/area/edit" class="ui form" method="POST">
    @csrf
    <input type="hidden" id="map" value="/storage/{{$area->level->map_path}}">
    <input type="hidden" id="data" name="area_json" value="{{$area->area_json}}">
    <input type="hidden" name="id" value="{{$area->id}}">
    <input type="hidden" id="bg_colour_temp" value="{{$area->block->bg_colour}}">
    <input type="hidden" id="text_colour_temp" value="{{$area->block->text_colour}}">
    <div class="ui grid">
      <div class="four wide column">
        <div class="field">
          <label for="name">Name</label>
          <input type="text" name="name" value="{{old('name', $area->name)}}">
        </div>
        <div class="field">
          <label for="name">Name Display</label>
          <input type="text" name="name_display" id="text" value="{{old('name_display', $area->name_display)}}">
        </div>
        <div class="field">
          <label for="area_category_ids">Area Category</label>
          <select multiple="multiple" name="area_category_ids[]" id="select_area_category_ids" class="">
            @foreach (\App\Models\Category::all() as $areaCategory)
              <option
                {{$area->categories->pluck('id')->contains($areaCategory->id) ? 'selected' : ''}} 
                value="{{$areaCategory->id}}"
              >{{$areaCategory->name}}</option>
            @endforeach
          </select>
        </div>
      </div> {{-- four wide column --}}
      <div class="ten wide column">
        <div class="field">
          <label for="">Draw area</label>
          @include('part.drawingboard', ['width' => 675, 'height' => 477])
          {{-- <img src="/storage/{{$area->level->map_path}}" alt="" class="ui image"> --}}
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
            <label id="clear" class="ui large button tool"><i class="trash icon"></i></label>
          </div>
        </div> {{-- field --}}
        <div class="field">
          <label for="">Font Size</label>
          <select name="text_size" id="select_text_size" class="ui fluid dropdown">
            @foreach (['14px', '15px', '16px'] as $element)
              <option value="{{$element}}" {{$area->text_size == $element ? 'selected' : ''}}>{{$element}}</option>
            @endforeach
          </select>
        </div> {{-- field --}}
      </div> {{-- two wide column --}}
      <div class="sixteen wide column">
        <div class="ui divider"></div>
        <button class="ui red button">Cancel</button>
        <button class="ui red pulled right button">Save</button>
        <button type="button" class="ui red pulled right modalcaller button" data-modal-id='delete_area'>Delete</button>
      </div>
    </div>
  </form>
</div>

{!! Form::open(['url' => '/back-office/area/delete', 'class' => 'ui small delete_area modal']) !!}
  <input type="hidden" name="id" value="{{$area->id}}">
  <div class="header capitalized">
    Delete area {{$area->name}}
  </div>
  <div class="center aligned content">
    Cofirm delete area?
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
  $('.tool').click(function(){
    var is_active = $(this).hasClass('active');
    $('.tool').removeClass('active');
    if(!is_active)$(this).addClass('active');
  });

  $(function(){
  });

</script>
@endsection
