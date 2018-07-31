<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            .slot {
                display: block;
                width: 50px;
                background: red;
                float: left;
                position: absolute;
                bottom: 0;
                margin: 2px;
                border-bottom: 1px solid #ccc;
            }
            .slotLabel {
                position: absolute;
                margin-top: -20px;
                font-weight: bold;
                text-align: center;
                width: 100%;
            }
        </style>
    </head>
    <body>
        NumBalls: {{$numBalls}}
        NumSlots: {{$numSlots}}

        @foreach($slots AS $key => $slot)
            <div class="slot" style="height: {{$slot * 10}}px; left:{{$key * 52}}px;">
                <span class="slotLabel">{{$slot}}</span>
            </div>
        @endforeach
    </body>
</html>
