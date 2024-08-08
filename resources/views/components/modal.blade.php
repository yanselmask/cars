<div class="modal" tabindex="-1" role="dialog" id="modalNoLoggin">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                @isset($title)
                <h5 class="modal-title">{{$title}}</h5>
                @endisset
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{$slot}}
            </div>
            @isset($actions)
            <div class="modal-footer">
                    {{$actions}}
            </div>
            @endisset
        </div>
    </div>
</div>
