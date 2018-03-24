@extends('office.layout')

@section('content')
<div class="ui text container">
  <h1>Update profile</h1>
  <div class="ui segment form">
    <form action="/back-office/user/update" method="POST">
      @csrf
      <div class="field">
        <label for="email">Email</label>
        <input name="email" type="email" value="{{\Auth::user()->email}}">
      </div>
      <div class="field">
        <label for="password">Current Password</label>
        <input name='password' type="password">
      </div>
      <div class="field">
        <label for="new_password">New Password</label>
        <input name='new_password' type="password">
      </div>
      <button class="ui red button">Update</button>
    </form>
  </div>
</div>
@endsection