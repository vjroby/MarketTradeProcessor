<!DOCTYPE html>
<html>
<head>
    <title>MessageTradeProcessor</title>
    <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    <link rel="stylesheet"  href="{{ URL::asset('css/main.css') }}">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="application/javascript">

       app.setAppUrl("{{ URL::to('/') }}");
</script>
</head>
<body>
<div class="container">
    <div class="col-md-10 col-md-offset-1 load-bar-container">
        <div class="load-bar hidden">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </div>
    @yield('content')
</div>
</body>
</html>