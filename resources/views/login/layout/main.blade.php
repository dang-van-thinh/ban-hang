<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/boostrap.min.css') }}">

    <title>{{$title}}</title>
</head>

<body>
    <div class="bg_custom">
        <div class="margin_top">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('js/boostrap.min.js') }}"></script>
</body>

</html>
