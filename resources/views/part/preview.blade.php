<script>
let area_jsons = [];
@if(isset($area_jsons))
area_jsons = {!! $area_jsons !!}
@endif
@if(isset($category_area))
let category_area = {!! $category_area !!}
let areas_by_category = [];
for(let x in category_area) {
    areas_by_category[category_area[x].id] = category_area[x].area_jsons;
}
@endif
</script>
<script src="/js/preview.js"></script>
<canvas width="{{$width}}" height="{{$height}}" id="canvas"></canvas> 