@extends('office.layout')
@php
  $title = 'Edit Block'
@endphp
@section('content')
<div class="ui segment bg-grey text container px-5">
  <h2>Edit Block {{$block->name}}</h2>
  <form action="/back-office/block/edit/{{$block->id}}" class="ui form" method="POST">
    @csrf
    <div class="field">
      <label for="name">Name</label>
      <input name="name" type="text" value="{{$block->name}}">
    </div>
    <table class="ui table">
      @foreach ($block->levels->chunk(2) as $levelsChunk)
      <tr>
        @foreach ($levelsChunk as $level)
        <td>
          <div class="ui toggle checkbox">
            <label>{{$level->name}}</label>
            <input type="checkbox" name="levels[{{$level->id}}]" {{$level->is_activated ? 'checked' : ''}}>
          </div>
        </td>
        @endforeach
      </tr>
      @endforeach
    </table>
    <button class="ui red button pulled right">Save</button>
    <a href="/back-office/level/list/{{$block->id}}" class="ui basic button pulled right">Cancel</a>
    <div class="clear"></div>
  </form>
</div>
@endsection