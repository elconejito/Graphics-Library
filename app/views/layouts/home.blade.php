<!DOCTYPE html>
<html lang="en">
<head>

@include('components.header')

</head>

<body id="homepage">

@include('components.nav-primary')

@if(Session::has('message'))
    @include('components.flash')
@endif

@yield('content')

@include('components.footer')

</body>
</html>
