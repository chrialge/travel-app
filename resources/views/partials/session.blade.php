@if (Str::contains(session('message'), 'cancellato'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session('message') }}

    </div>
@elseif (@session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert"
        style="position: absolute; z-index: 8; top: 70px; width: 90%; margin-left:5%">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session('message') }}

    </div>
@endif
