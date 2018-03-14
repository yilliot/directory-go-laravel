<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title> {{$title or ''}} | Majulah Interactive CMS</title>
</head>
<body>
  <div class="ui bg-red no-corner mb-0 menu">
    <h1>Interactive CMS</h1>
    <div class="right menu">
      <div class="ui simple dropdown item">
        <i class="circular white inverted user icon"></i>
        {{ Auth::user() }}
        <i class="dropdown icon"></i>
        <div class="menu">
{{-- 
          <a class="item" href="#"><i class="add user icon"></i>Add Admin</a>
          <div class="divider"></div>
          <a class="item" href="#"><i class="edit icon"></i>Update Profile</a>
 --}}
          {{ Form::open(['url' => '/auth/logout', 'method' => 'POST', 'class' => "item clicksubmit"]) }}
            <i class="sign out icon"></i>Logout
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
  <div class="ui inverted no-corner mt-0 menu">
    <div class="ui text container">
      <a href="/back-office/level" class="active item">Manage Floor Plans</a>
      <a href="/back-office/category/list" class="item">Manage Categories</a>
      <a href="/back-office/zone" class="item">Manage Zones</a>
      <a href="/back-office/area" class="item">Manage Areas</a>
    </div>
  </div>
  <div id="content-body">
    @section('content')
    @show
  </div>
  <script src="/js/office.js"></script>
  <link rel="stylesheet" href="/semantic/semantic.min.css">
  <link rel="stylesheet" href="/css/office.css">
</body>
</html>