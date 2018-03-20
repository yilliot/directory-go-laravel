<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title> {{$title or ''}} | Majulah Interactive CMS</title>
</head>
<body>
  <div class="ui bg-red no-corner mb-0 pl-5 inverted menu">
    <h1 class="pt-3"><a href="/back-office" class="text-white">Interactive CMS</a></h1>
    <div class="right menu">
      <div class="item modalcaller" data-modal-id='create_publish'>
        <i class="upload icon"></i>
        Publish
      </div>
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
      <a href="/back-office/level/list/1" class="{{Request::is('back-office/level*')?'active':''}} item">Manage Floor Plans</a>
      <a href="/back-office/category/list" class="{{Request::is('back-office/category*')?'active':''}} item">Manage Categories</a>
      <a href="/back-office/zone/list/1" class="{{Request::is('back-office/zone*')?'active':''}} item">Manage Zones</a>
      <a href="/back-office/area/list/1" class="{{Request::is('back-office/area*')?'active':''}} item">Manage Areas</a>
    </div>
  </div>
  <div id="content-body">
    @section('content')
    @show
  </div>

  {!! Form::open(['url' => '/back-office/publish/create', 'class' => 'ui small create_publish modal']) !!}
    <div class="header capitalized">
      Publish content
    </div>
    <div class="center aligned content">
      Updated data will be published to kiosk within 24 hrs after action.
    </div>
    <div class="actions">
      <div class="ui cancel basic button">
        Cancel
      </div>
      <button id="edit_category_button" class="ui negative right labeled icon button">
        Publish <i class="checkmark icon"></i>
      </button>
    </div>
  {!! Form::close() !!}
  <link rel="stylesheet" href="/semantic/semantic.min.css">
  <link rel="stylesheet" href="/css/office.css">
  <script src="/js/office.js"></script>
  @yield('script')
</body>
</html>