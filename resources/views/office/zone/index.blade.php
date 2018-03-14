@extends('office.layout')
@php
  $title = 'Zone'
@endphp
@section('content')

mkdir resources/views/area
touch resources/views/area/index.blade.php
touch resources/views/area/list.blade.php
touch resources/views/area/create.blade.php
touch resources/views/area/edit.blade.php

mkdir resources/views/zone
touch resources/views/zone/index.blade.php
touch resources/views/zone/list.blade.php
touch resources/views/zone/create.blade.php
touch resources/views/zone/edit.blade.php

mkdir resources/views/level
touch resources/views/level/index.blade.php
touch resources/views/level/list.blade.php

mkdir resources/views/category
touch resources/views/category/index.blade.php
touch resources/views/category/list.blade.php
touch resources/views/category/create.blade.php
touch resources/views/category/edit.blade.php

@endsection
