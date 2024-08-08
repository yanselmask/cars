@auth
    @if(auth()->id() != $user->id)
<button type="button" class="btn {{$class}} follow-user me-2 {{auth()->user()->isFollowing($user) ? 'btn-success' : 'btn-info'}} " data-user="{{$user->id}}">
        @if(auth()->user()->isFollowing($user))
            {{__('Following')}}
        @else
           {{__('Follow')}}
        @endif
</button>
    @endif
@else
    <button type="button" class="btn btn-lg btn-info" data-bs-toggle="modal" data-bs-target="#modalNoLoggin">
        {{__('Follow')}}
    </button>
@endauth
