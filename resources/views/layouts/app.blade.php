<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.header')
<body>
@yield('body')
</body>
@include('layouts.footer')
@include('layouts.script')
</html>
