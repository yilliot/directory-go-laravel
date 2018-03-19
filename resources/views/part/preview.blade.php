<script>
let area_jsons = [];
@if(isset($area_jsons))
area_jsons = {!! $area_jsons !!}
@endif
</script>
<script src="/js/preview.js"></script>
<canvas width="{{$width}}" height="{{$height}}" id="canvas"></canvas> 