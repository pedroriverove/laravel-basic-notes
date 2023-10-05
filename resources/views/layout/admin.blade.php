@extends('layout.base')

@push('styles')
    <link href="{{ asset('assets/css/datatables.min.css') }}" rel="stylesheet"/>
@endpush

@section('body')
    <body class="sb-nav-fixed">
    @include('partials.navbar')
    <div id="layoutSidenav">
        @include('partials.sidebar')
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
            @include('partials.footer')
        </div>
    </div>
    @include('partials.scripts')
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.bootstrap5.min.js') }}"></script>
    <script>
        function logout() {
            swal({
                title: "Cerrar sesión",
                text: "¿Seguro que quieres cerrar la sesión?",
                icon: "warning",
                buttons: [
                    'No, cancélalo.',
                    'Sí, estoy seguro'
                ],
                dangerMode: true,
            }).then((willLogout) => {
                if (willLogout) {
                    window.location.href = "{{ route('logout') }}";
                }
            });
        }
    </script>
    @stack('scripts')
    </body>
@endsection
