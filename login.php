<?php
    session_start();
    $successMessage = "Don't have an account?<br><a href='signup.php'>Sign up here.</a>";
    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $server = "localhost";
        $user = "root";
        $pass = "";
        $db = "fsconnect";
        $conn = mysqli_connect($server, $user, $pass, $db);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($conn, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION["username"] = $username;
            $successMessage = "Login Successful.<br><a href='home.php'>Head over here.</a>";
            header("Location: home.php");
        } else {
            $successMessage = "Incorrect username-password combination<br>Please try again.";
        }
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="logos/favicon.ico" type="image/png">
        <title>
            Login | FSConnect 
        </title>
        <style>
            body {
                background-color: #6d9ac9;
            }
            body, table, td, input {
                font-family: 'Roboto', sans-serif;
                color: #ffffff;
            }
            td#image-td {
                border-right: 2px solid white;
            }
            td#login-td {
                color: white;
                font-size: 50px;
                padding: 15px;
            }
            table.login {
                margin-top: 20px;
            }
            input.inputtext, input.inputtext:focus {
                background-color: #6d9ac9;
                color: #ffffff;
                font-size: 20px;
                border: 1px solid #ffffff;
                border-radius: 5px;
                width: 170px;
                padding: 5px;
            }
            td.login {
                font-size: 25px;
                padding: 15px;
            }
            input#submit {
                margin-top: 15px;
                background-color: #6d9ac9;
                color: #ffffff;
                font-size: 30px;
                border: 1px solid #ffffff;
                border-radius: 5px;
                padding: 10px 20px;
                font-weight: bold;
                cursor: pointer;
            }
            div#signup {
                font-family: 'Verdana', sans-serif;
                color: white;
                font-size: 25px;
                margin-top: 5px;
            }
            a, a:link, a:visited, a:active {
                color: white;
                text-decoration: underline;
            }
            div#successMessage {
                font-family: 'Verdana', sans-serif;
                color: white;
                font-size: 25px;
                margin-top: 5px;
            }
            ::selection {
                background: grey;
                color: #ADD8E6;
            }
            .forgot {
                font-style: italic;
                font-size: 14px;
            }
            label {
                font-size: 20px;
            }
            input#rememberMe {
                height: 15px;
                width: 15px;
                background-color: #6d9ac9;
                opacity: 100;
            }
        </style>
    </head>
    <body><center>
        <table class="header">
            <tr class="header">
                <td class="header" id="image-td">
                    <img src="logos/logo-blue.png" class="header">
                </td>
                <td class="header" id="login-td">
                    Log In
                </td>
            </tr>
        </table>
        <form method="POST" action="">
        <table class="login">
            <tr class="login">
                <td class="login">
                    Username
                    <br>
                    <div class="forgot username"><a href="forgotUsernamePassword.php">Forgot Username?</a></div>
                </td>
                <td class="login">
                    <input type="text" class="inputtext" name="username" id="username" required>
                </td>
            </tr>
            <tr class="login">
                <td class="login">
                    Password
                    <br>
                    <div class="forgot password"><a href="forgotUsernamePassword.php">Forgot Password?</a></div>
                </td>
                <td class="login">
                    <input type="password" class="inputtext" name="password" id="password" required>
                </td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Log In" id="submit">
        <br><br>
        <div id="successMessage"><?php echo $successMessage; ?></div>
    </center></body>
</html>