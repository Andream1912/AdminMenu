<?php include "./connection.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Nova+Mono&display=swap" rel="stylesheet" />
    <link rel="icon" href="logo.ico" type="image/X-icon">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap");
    </style>
    <title>HomePage</title>
</head>
<style>
    body,
    html {
        height: 100%;
        width: 100%;
    }

    body {
        background-color: #203865;
        margin: 0;
        font-family: "Indie Flower", cursive;
    }

    .background {
        background-image: url(/immagini/background-index.jpg);
        background-size: cover;
        -o-background-size: cover;
        -moz-background-size: cover;
        background-position: center center;
        height: 100%;
    }

    a{
        position: absolute;
        background-image: url(immagini/background-button.jpg);
        opacity: 0.9;
        text-decoration: none;
        margin-top: 65vh;
        margin-left: 38%;
        font-size: 37px;
        padding: 1%;
        text-align: center;
        color: white;
    }

    .button-login {
        position: absolute;
        padding: 1%;
        text-decoration: none;
        float: right;
        top: 30px;
        text-align: center;
        color: white;
        background-color: beige;
        border-radius: 30%;
        border: 1px solid black;
        font-size: 37px;
    }

    @media screen and (min-width: 768px) {
        a {
            margin-left: 44%;
        }
    }

    @media screen and (min-width: 1200px) {
        .background {
            background-position: 100% 80%;
        }

        a {
            margin-left: 47%;
        }
    }
</style>

<body>
    <div class="background">
        <a href="login.php" style="margin-top:0px">Accedi</a>
        <a href="menu.html">MENU</a>
    </div>
</body>

</html>