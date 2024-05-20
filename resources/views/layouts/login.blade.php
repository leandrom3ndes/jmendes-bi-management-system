<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    @include('includes.head')
</head>
<body>
    <div id="app">
        <div class="container">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
