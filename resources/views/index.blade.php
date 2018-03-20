@extends('_layout')

@section('script')
<script>
let blocks = {!!$blocks!!};
for(let i in blocks.blocks) {
    blocks.blocks[i].colour = blocks.blocks[i].bg_colour;
}
let direction = {{$location->direction}};
let position_json = {!!$location->position_json!!};
let level_id = {{$location->level_id}};
</script>
<script src="/js/ui.js"></script>
@endsection