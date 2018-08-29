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
<script>
  let currentLink = "{{ Request::url() }}";
  let pieces = currentLink.split('/');
  let i = pieces.indexOf('kiosk');
  let newLink = 'http://google-directory.ascendcom.my/' + pieces.splice(i).join('/');
  if (newLink != currentLink) location.href = newLink;
</script>
@endsection