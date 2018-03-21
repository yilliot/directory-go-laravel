@extends('office.layout')
@php
  $title = 'Categories list'
@endphp
@section('content')
<div class="ui segment bg-grey text container px-5">
  <button 
    data-modal-id='new_category'
    class="ui red button pulled right modalcaller">New Category
  </button>
  <h2>Categories</h2>
  <table class="ui table">
    <thead>
      <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Counter</th>
        <th class="right aligned">Action</th>
      </tr>
    </thead>
    @foreach ($categories as $category)
      <tr>
        <td>{{$loop->index+1}}</td>
        <td>{{$category->name}}</td>
        <td>{{$category->areas->count()}}</td>
        <td class="right aligned">
          <form action="/back-office/category/order/{{$category->id}}" class="d-inline" method="POST">
            @csrf
            <input type="hidden" class="order-direction" name="direction" value="up">
            <div class="ui icon mini buttons">
              <button class="ui order-up button">
                <i class="caret up icon"></i>
              </button>
              <button class="ui order-down button">
                <i class="caret down icon"></i>
              </button>
            </div>
          </form>
          <button 
            class="ui red button edit_category modalcaller"
            data-category_edit_id="{{$category->id}}"
            data-category_edit_name="{{$category->name}}"
            data-modal-id='edit_category'>Edit
          </button>
        </td>
      </tr>
    @endforeach
  </table>
</div>

{!! Form::open(['url' => '/back-office/category/create', 'class' => 'ui small new_category modal', 'method' => 'POST']) !!}
  <div class="header capitalized">
    New category
  </div>
  <div class="center aligned content">
    <div class="ui form" style="width: 50%; margin:auto;">
      <div class="field">
        <label for="name">Name</label>
        <input type="text" name="name" id="category_new_name">
      </div>
    </div>
  </div>
  <div class="actions">
    <div class="ui cancel basic button">
      Cancel
    </div>
    <button type="submit" class="ui negative right labeled icon button">
      Create <i class="add icon"></i>
    </button>
  </div>
{!! Form::close() !!}
{!! Form::open(['url' => '/back-office/category/edit', 'class' => 'ui small edit_category modal']) !!}
  <input type="hidden" name="id" id="category_edit_id">
  <input type="hidden" name="action" id="category_edit_action" value="edit">
  <div class="header capitalized">
    Edit category
  </div>
  <div class="center aligned content">
    <div class="ui form" style="width: 50%; margin:auto;">
      <div class="field">
        <label for="name">Name</label>
        <input type="text" name="name" id="category_edit_name" value="">
      </div>
    </div>
  </div>
  <div class="actions">
    <div class="ui cancel basic button">
      Cancel
    </div>
    <button id="delete_category_button" class="ui red right labeled icon button">
      Delete <i class="trash icon"></i>
    </button>
    <button id="edit_category_button" class="ui negative right labeled icon button">
      Save <i class="checkmark icon"></i>
    </button>
  </div>
{!! Form::close() !!}
@endsection

@section('script')
<script>
  $(function(){

    $('.edit_category.modalcaller').click(function(){
      $('#category_edit_name').val($(this).data('category_edit_name'));
      $('#category_edit_id').val($(this).data('category_edit_id'));
    });

    $('#delete_category_button').click(function(){
      $('#category_edit_action').val('delete');
    });
    $('#edit_category_button').click(function(){
      $('#category_edit_action').val('edit');
    });

    $('.order-down.button').click(function(){
      $(this).closest('form').find('.order-direction').val('down');
    });
    $('.order-up.button').click(function(){
      $(this).closest('form').find('.order-direction').val('up');
    });

  });
</script>
@endsection
