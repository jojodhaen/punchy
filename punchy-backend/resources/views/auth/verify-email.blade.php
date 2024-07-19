<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Punchy</title>

    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Bodoni+Moda+SC:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        body {
            margin: 0;
            padding: 0;
        }

        div {
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #ffd0d0;
            height: 100dvh;
            align-items: center;
        }

        img {
            width: 120px;
            height: 120px;
        }

        h1 {
            font-family: 'Bodoni Moda SC', serif;
            font-size: 2.5rem;
            font-weight: 7000;
            margin-top: 30px;
            margin-bottom: 4px;
            text-align: center;
        }

        p {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.3rem;
            text-align: center;
        }
    </style>
</head>
<body>
<div>
    <img src="{{ url('storage/check.png') }}" alt="check"/>
    <h1>
        Account Geactiveerd
    </h1>
    <p>Uw email werd geverifieerd.<br>U kan deze pagina sluiten en de app beginnen gebruiken!</p>
</div>
</body>
</html>
