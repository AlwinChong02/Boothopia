@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endpush

<div class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 1050">
    <div class="toast align-items-center text-bg-{{ $type }} border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body text-center">
                @if ($type == 'success')
                    <i class="bi bi-check-circle-fill me-2 text-white" style="font-size: 1.2rem; padding-right: 10px"></i>
                @elseif ($type == 'error')
                    <i class="bi bi-x-circle-fill me-2 text-white" style="font-size: 1.2rem; padding-right: 10px"></i>
                @endif
                {{ $message }}
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(() => {
        const toastWrapper = document.querySelector('.position-fixed');
        if (toastWrapper) {
            toastWrapper.remove(); // completely removes it from DOM
        }
    }, 2000);
</script>
