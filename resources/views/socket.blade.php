
@extends('app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2" >
                <div id="messages" ></div>
            </div>
        </div>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-info">
            <div class="panel-heading">Message viwer</div>
            <div class="panel-body">

            </div>
        </div>
        <a class="btn btn-default" href="#" role="button">Reload</a>
        <table class="table table-striped messages-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>User Id</th>
                <th>Currency From</th>
                <th>Currency To</th>
                <th>Amount Sell</th>
                <th>Amount Buy</th>
                <th>Rate</th>
                <th>Time Placed</th>
                <th>Originating Country</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <script>
        var socket = io.connect('http://192.168.33.11:8890');
        socket.on('message', function (data) {
            app.loadMessagesToTable(data);
        });
        $(document).ready(function(){
           app.getMessages();
        });
    </script>
@endsection