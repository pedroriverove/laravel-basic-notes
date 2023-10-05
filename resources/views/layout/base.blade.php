<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content="@yield('title')"/>
    <meta name="author" content=""/>
    <title>@yield('title', 'Laravel')</title>
    @include('partials.stylesheets')
    @stack('styles')
</head>
@yield('body')
</html>
