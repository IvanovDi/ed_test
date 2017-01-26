<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    @section('navbar')
        <div class="navbar">
            <div class="logo">Logo</div>
            <div class="links">
                <ul class="linksList">
                    <li class="linkList__item">demo</li>
                    <li class="linkList__item">demo</li>
                    <li class="linkList__item">demo</li>
                    <li class="linkList__item">demo</li>
                </ul>
            </div>
        </div>
        <style>
            .navbar {
                min-height: 150px;
                background: lightblue;
            }
            .links {
                float: right;
            }
            .linkList__item {
                display: inline-block;
            }
        </style>
    @show
    @yield('content')

</body>
</html>