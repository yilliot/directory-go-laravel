@extends('_layout')

@section('script')
<script>
let blocks = {!!$blocks!!};
for(let i in blocks.blocks) {
    blocks.blocks[i].colour = blocks.blocks[i].bg_colour;
}
let direction = 0;
</script>
<script src="/js/ui.js"></script>
@endsection