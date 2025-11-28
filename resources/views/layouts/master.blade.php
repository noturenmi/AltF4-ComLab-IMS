<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AltF4 IMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body {
            @if (request()->is('login') || request()->is('register'))
                background: #4F798C;
                background: linear-gradient(45deg, rgba(79, 121, 140, 1) 0%, rgba(255, 255, 255, 1) 100%);
            @else
                background: #6987A3;
                background: linear-gradient(0deg, rgba(105, 135, 163, 1) 0%, rgba(196, 208, 219, 1) 100%);
            @endif

            background-attachment: fixed;
        }
    </style>
</head>

<body>
    @if (!(request()->is('login') || request()->is('register')))
        <x-navbar />
    @endif

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
