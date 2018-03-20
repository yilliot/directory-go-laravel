@extends('_layout')

@section('script')
<script>
let blocks = {!!$blocks!!};
for(let i in blocks.blocks) {
    blocks.blocks[i].colour = blocks.blocks[i].bg_colour;
}
let direction = {{$location->direction}};
let pointer = {
    json: {!!$location->position_json!!},
    level_id: {{$location->level_id}}
}
@if(isset($version))
let version = {{$version}};
@endif
</script>
<script src="/js/ui.js"></script>
@endsection