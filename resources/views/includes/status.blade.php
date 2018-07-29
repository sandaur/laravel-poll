{{-- Status Message Handler --}}
@if (session()->has('message'))
<div class="row justify-content-center pt-4">
    <div class="col-md-8">
        <div class="alert alert-{{ session()->get('msg-type') }}">
            <strong>
                @if (session()->has('msg-head'))
                    {{ session()->get('msg-head') }}
                @endif
            </strong> {{ session()->get('message') }}
        </div>
    </div>
</div>
@endif