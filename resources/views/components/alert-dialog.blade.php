@if ($type == 'success')
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-2"></i> <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
        {{ $message }}
    </div>
@elseif($type == 'error')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="mdi mdi-block-helper me-2"></i> <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
        {{ $message }}
    </div>
@endif
