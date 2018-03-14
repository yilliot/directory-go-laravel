@extends('office.layout')
@php
  $title = 'Levels list'
@endphp
@section('content')
<div class="ui segment bg-grey text container px-5">
  <h2>Manage Floor Plan of Block {{$block->name}}</h2>
  <div class="ui form">
    <div class="two fields">
      <div class="two fields">
        <div class="field">
          <select name="block" id="select-block" class="ui fluid dropdown">
            @foreach ($blocks as $blockLoop)
              <option {{$blockLoop->id == $block->id ? 'selected' : ''}} value="{{$blockLoop->id}}">Block {{$blockLoop->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="field">
          <a href="/back-office/block/edit/{{$block->id}}" class="ui red button">Edit Block</a>
        </div>
      </div>
    </div>
  </div> {{-- ui form --}}

  <table class="ui table">
    <thead>
      <tr>
        <th>No.</th>
        <th>Level</th>
        <th>Name</th>
        <th class="right aligned">Action</th>
      </tr>
    </thead>
    @foreach ($block->levels->where('is_activated', true) as $level)
    <tr>
      <td>{{$loop->index+1}}</td>
      <td>{{$level->level_order}}</td>
      <td>{{$level->name}}</td>
      <td class="right aligned"><a href="/back-office/level/edit/{{$level->id}}" class="ui red button">Edit</a></td>
    </tr>
    @endforeach
  </table>
</div>
@endsection

@section('script')
<script>
  $('#select-block').change(function(){
    location.href = '/back-office/level/list/' + $(this).val();
  });
</script>
@endsection