<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <title>Prego - Project Management App</title>
    <meta name="description" content="Prego is a project management app built for learning purposes">
 
    <!-- Typekit Fonts -->
    <script src="//use.typekit.net/udt8boc.js"></script>
    <script>try{Typekit.load();}catch(e){}</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.atwho.js') }}"></script>
    <script src="{{ asset('js/jquery.caret.js') }}"></script>
 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.atwho.min.css') }}">

</head>
<body>
    <div class="container">
        <!--@include('layouts.partials.alerts')-->
        @yield('content')
    </div>
</body>
</html>