<div class="container">
    <div class="row">
        <div class="col">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
    </div>
</div>

@if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif