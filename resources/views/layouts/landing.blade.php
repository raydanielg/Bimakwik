<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BimaKwik') }}</title>
    
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .hero-section {
            padding: 100px 0;
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), url('/serious-expert-expressing-support-colleague.jpg');
            background-size: cover;
            background-position: center;
        }
        .feature-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 24px;
        }
        .hover-lift {
            transition: transform 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-10px);
        }
        .btn-quote-custom {
            background-color: #d1d5db; /* Light gray base */
            color: #15803d; /* Dark green text */
            border: none;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .btn-quote-custom .icon-circle {
            background-color: rgba(0, 0, 0, 0.05);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }
        .btn-quote-custom:hover {
            background-color: #c4c9d0;
            transform: scale(1.05);
            color: #15803d;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app" class="d-flex flex-column min-vh-100">
        @include('partials.header')

        <main class="flex-grow-1">
            @yield('content')
        </main>

        @include('partials.footer')
    </div>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#0056b3',
            timer: 3000
        });
    </script>
    @endif

    @if($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ $errors->first() }}",
            confirmButtonColor: '#0056b3'
        });
    </script>
    @endif
</body>
</html>
