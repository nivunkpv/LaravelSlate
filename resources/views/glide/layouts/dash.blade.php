@include('glide.navbar.dash')
<main x-data class="overflow-hidden d-flex vw-100 flex-grow-1 position-relative">
    @include('glide.sidebar.dash')
    <section class="overflow-auto flex-grow-1">
        {{ $slot }}
    </section>
</main>
