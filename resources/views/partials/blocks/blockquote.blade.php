<blockquote class="blockquote {{$data['align']}} text-light">
    <p>{{$data['content']}}</p>
    @isset($data['author'])
    <footer class="blockquote-footer text-light"> {{$data['author']}}</footer>
    @endif
</blockquote>
