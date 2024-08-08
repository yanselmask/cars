<x-modal>
    <x-slot name="title">
        {{__('You are not logged in')}}
    </x-slot>
    <p>{{__('You need to log in to be able to follow this user.')}}</p>
    <x-slot name="actions">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{__('Close')}}</button>
        <a href="{{route('filament.'. config('listing.vendor_path') .'.auth.login')}}" class="btn btn-sm btn-primary">{{__('Login')}}</a>
    </x-slot>
</x-modal>
