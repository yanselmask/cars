@if(isset($data['bold']) && $data['bold'])
    <p class="fs-lg fw-bold text-light mb-4">{{$data['content']}}</p>
@else
    <p class="text-light opacity-70">{{$data['content']}}</p>
@endif

