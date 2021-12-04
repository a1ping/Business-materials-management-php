<!DOCTYPE html>
<html lang="en">
@if(session('level') == '')
    You should login rightly in login page.
@elseif(session('level') == 'supplier' and $pg != 'supplier')
    You can't browse other page.
@else
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lars Management V1.0</title>
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- <link href="/jslib3.1/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="/jslib3.1/css.css" rel='stylesheet' type='text/css'>
    <link href="/jslib3.1/bootstrap.min.css" rel="stylesheet">
    <script src="/jslib3.1/jquery.min.js"></script>
    <script src="/jslib3.1/bootstrap.min.js"></script> -->

</head>
<body id="app-layout">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#alignment-example" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Login Out</a>
            </div>
            <!-- COLLAPSIBLE NAVBAR -->
            <div class="collapse navbar-collapse" id="alignment-example">
                @if(session('level') != 'supplier')
                <ul class="nav navbar-nav">
                    <li class="{{$pg=='home'?'active':''}}"><a href="/home">Home</a></li>
                    <li class="{{$pg=='laboratory'?'active':''}}"><a href="/laboratory">Laboratory</a></li>
                    <li class="{{$pg=='supplier'?'active':''}}"><a href="/supplier">Supplier</a></li>
                </ul>
                @endif
            </div>
        </div>
    </nav>   
    @yield('content')
</body>
</html>
@endif