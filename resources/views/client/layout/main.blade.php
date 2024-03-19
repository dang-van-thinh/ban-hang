<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @include('client.layout.style')

</head>

<body>
    @include('client.layout.header')
    {{-- //phần đầu  --}}

    <div class="container-fluid">
        <article>
            @yield('content')
        </article>
    </div>

    @include('client.layout.footer')
</body>
@include('client.layout.script')

</html>
