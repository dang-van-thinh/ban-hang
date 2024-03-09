<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    @include('layout.style')
    @include('layout.script')
</head>
<body>
    <div class="container-fluid">
        <header class="fw-bold">
            hellooo
        </header>
        <article>
            @yield('content')
        </article>
    </div>
   
</body>
</html>