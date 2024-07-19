<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>

    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Bodoni+Moda+SC:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        body {
            margin: 0;
            padding: 0;
        }

        div {
            display: flex;
            justify-content: center;
            background-color: #ffd0d0;
            height: 100vh;
        }

        h1 {
            font-family: 'Bodoni Moda SC', serif;
            font-size: 3rem;
            font-weight: 1000;
            margin: 0;
        }
    </style>
</head>
<body>
<div>
    <h1>
        Welkom {{ $user->first_name }}
    </h1>
</div>
</body>
</html>

