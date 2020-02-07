<!doctype html>
<html class="no-js" lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>demo app</title>

    <style type="text/css">

        div {
            border: solid 1px #F00;
        }
        .container {
            display: flex;
            flex-direction: column;
        }
        .content-container {
            display: flex;
        }
        .header {
            background-color: #CCC;
        }
        .footer {
            background-color: #CCC;
        }
        table {
            border-top: solid 1px #000;
            border-right: solid 1px #000;
            width:100%;
        }
        table td, table th {
            border-left: solid 1px #000;
            border-bottom: solid 1px #000;
        }

        .footer ul {
            display: block;
        }

        .footer ul>li {
            display: inline-block;
        }

        .footer ul>li:before {
            content: ' [';
        }

        .footer ul>li:after {
            content: '] ';
        }

    </style>

</head>
<body>

<div class="container">
    <div class="header">
        <form action="{{route('searchpage')}}" method="get">
{{--            @csrf--}}
            <input name="qry" value="{{ old('qry') }}"> <button>search</button>
        </form>
    </div>
    <div class="content-container">
        <div class="sidebar">
            <a href="{{ route('frontpage') }}">home</a>
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>
    <div class="footer">
        @yield('footer')
    </div>
</div>

</body>
</html>
