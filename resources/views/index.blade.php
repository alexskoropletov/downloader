<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Downloader</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            /*align-items: top;*/
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .btn {
            margin-left: 10px;
            border: 1px solid blue;
            border-radius: 5px;
            padding: 3px 15px;
        }

        .error {
            color: red;
        }

        .pending {
            color: black;
        }

        .processing {
            color: blue;
        }

        .ready {
            color: green;
        }

        table {
            margin-top: 50px;
        }

        table, table tr, table tr td {
            text-align: left;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <h1 class="title">Downloader</h1>
        <form method="POST" action="/">
            @csrf
            <div>
                <label for="download-me">Resourse url</label>
                <input type="text" name="download-me" id="download-me" placeholder="Resource url goes here">
                <input type="submit" class="btn" value="+">
            </div>
        </form>
        <div id="downloads-list">
            @include('downloadsList')
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/js/app.js"></script>

</body>
</html>
