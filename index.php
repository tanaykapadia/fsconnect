<?php
    session_start();
    if (isset($_SESSION["username"])) {
        if($_SESSION["username"] !== "") {
            header("Location: home.php");
        }
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="logos/favicon.ico" type="image/png">
        <title>
            Home | FSConnect
        </title>
        <style>
            body{
                background-color: #6d9ac9;
            }
            h1, a, p, button {
                font-family: 'Roboto', sans-serif;
            }
            h1, p {
                color: #f0f0f0;
            }
            h1 {
                margin-top: 15%;
                font-size: 50px;
            }
            p {
                font-size: 30px;
            }
            button {
                cursor: pointer;
                border: 1px solid transparent;
                border-radius: 40px;
                font-size: 35px;
                color: #6d9ac9;
                background-color: #f0f0f0;
                padding: 20px;
                margin: 10px;
                transition: box-shadow 0.5s;
            }
            button:hover {
                box-shadow: 10px 10px 5px grey;
            }
        </style>
    </head>
    <body><center>
        <h1>
            FS Connect
        </h1>
        <p>Connect to anyone anywhere in the world</p>
        <a href="login.php"><button>
            Log-In
        </button></a>
        <a href="signup.php"><button>
            Sign-Up
        </button></a>
    </center></body>
</html>