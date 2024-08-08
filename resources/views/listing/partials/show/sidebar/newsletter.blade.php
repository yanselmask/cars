<div class="card card-body bg-transparent border-light">
    <h5 class="text-light">
        {{ __('Email me price drops and new listings for these search results') }}:</h5>
    <span id="successaddedlt" class="text-success d-none mb-2"></span>
    <form class="form-group form-group-light mb-3">
        <div class="input-group"><span class="input-group-text"> <i class="fi-mail"></i></span>
            <input name="email" id="newsletterltemail" class="form-control" type="email"
                   placeholder="{{ __('Your email') }}" required>
        </div>
        <button id="newsletterltbtnst" class="btn btn-primary"
                type="button">{{ __('Subscribe') }}</button>
    </form>
</div>
