<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
    <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
</head>
<body>
<div class="container">
    @yield('content')
</div>
<script type="application/javascript">

       app.setAppUrl("{{ URL::to('/') }}");
</script>
</body>
</html>