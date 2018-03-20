<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title> {{$title or ''}} | Majulah Interactive CMS</title>
</head>
<body>
  <div class="ui bg-red no-corner mb-0 pl-5 inverted menu">
    <h1 class="pt-3"><a href="/back-office" class="text-white">Interactive CMS</a></h1>
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
  @yield('script')
</body>
</html>