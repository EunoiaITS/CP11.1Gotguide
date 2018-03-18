<!DOCTYPE html>
<html>
<head>
    <title>GOT GUIDE API V1 - forgot password!</title>
    <link rel="stylesheet" href="{{ URL::asset('/bootstrap-3.3.6-dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/bootstrap-3.3.6-dist/css/bootstrap-theme.css') }}">
    <script type="text/javascript" src="{{ URL::asset('/bootstrap-3.3.6-dist/js/bootstrap.js') }}"></script>
    <style>
        body {
            background: url('{{ URL::asset('/images/GotGuide.png') }}') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .panel-default {
            opacity: 0.9;
            margin-top: 50%;
        }
        .form-group.last {
            margin-bottom:0px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="jumbotron">
        <p>{{ $message }}</p>
    </div>
</div>
</body>
</html>