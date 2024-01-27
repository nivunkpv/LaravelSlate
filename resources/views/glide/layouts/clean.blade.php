@extends('scaffold')
@section('content')
        @include('glide.navbar.clean')
        <main x-data class="overflow-hidden d-flex vw-100 flex-grow-1 position-relative">
            <section class="overflow-auto flex-grow-1">
                {{ $slot }}
            </section>
        </main>
    </div>
@endsection
