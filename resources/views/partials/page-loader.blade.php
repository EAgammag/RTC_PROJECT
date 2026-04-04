{{-- ── Full-page loader (minimum 2 s display) ──────────────────────────── --}}
<div class="page-loader" id="pageLoader">
    <div class="page-loader__ring">
        <img src="{{ asset('133rd NROTC_logo.jpg') }}" alt="Loading…" class="page-loader__logo">
    </div>
    <p class="page-loader__text">133rd NROTC</p>
</div>
<script>
    (function () {
        var start = Date.now();
        var MIN_MS = 2000;
        window.addEventListener('load', function () {
            var elapsed = Date.now() - start;
            var remaining = Math.max(0, MIN_MS - elapsed);
            setTimeout(function () {
                var el = document.getElementById('pageLoader');
                if (el) {
                    el.classList.add('loaded');
                    el.addEventListener('transitionend', function () { el.remove(); });
                }
            }, remaining);
        });
    })();
</script>
