<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <header class="shadow-sm p-3 mb-5 bg-body rounded d-flex justify-content-center py-3">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Главная</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('agencies') }}">Агенства</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('rule.create') }}">Создать новое правило</a></li>
            </ul>
        </header>
    </div>

    <div class="main" style="height: 80vh;">
        @yield('content')
    </div>

    <br><br><br><br>

    @stack('scripts')

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('message'))
            // toastr.success('{{ session('message') }}');
            toastr.info('{{ session('message') }}');
        @endif
    });
</script>

</html>