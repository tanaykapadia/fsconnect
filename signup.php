<?php
    $emailError = "";
    $usernameError = "";
    $password1Error = "";
    $password2Error = "";
    $successMessage = "Already have an account?<br><a href='login.php'>Sign in here instead.</a>";
    if(isset($_POST["submit"])) {
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];
        $server = "localhost";
        $user = "root";
        $pass = "";
        $db = "fsconnect";
        $conn = mysqli_connect($server, $user, $pass, $db);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (strlen($username) > 0 && strlen($username) <= 20) {
                if (!preg_match('/\s/',$username)) {
                    if (strlen($password1) >= 8 && strlen($password2) <= 15) {
                        if ($password1 === $password2) {
                            $insertquery = "INSERT INTO users (username,email,password) VALUES ('$username','$email','$password1')";
                            $iquery = mysqli_query($conn,$insertquery);
                            if ($iquery) {
                                $successMessage = "Account registered successfully<br><a href='login.php'>Login with your new account here</a>";
                            }
                        } else {
                            $password2Error = "Passwords don't match";
                        }
                    } else {
                        $password1Error = "Password should be 8-15 chars.";
                    }
                } else {
                    $usernameError = "Username should not have space";
                }
            } else {
                $usernameError = "Username should be 1-20 chars";
            }
        } else {
            $emailError = "Please enter a valid email";
        }
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="logos/favicon.ico" type="image/png">
        <title>
            Signup | FSConnect 
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
            td#signup-td {
                color: white;
                font-size: 50px;
                padding: 15px;
            }
            table.signup {
                margin-top: 20px;
            }
            input.inputtext, input.inputtext:focus {
                background-color: #6d9ac9;
                color: #00000;
                font-size: 20px;
                border: 1px solid #ffffff;
                border-radius: 5px;
                width: 170px;
                padding: 5px;
            }
            td.signup {
                font-size: 25px;
                padding: 15px;
            }
            input#submit {
                margin-top: 15px;
                background-color: #6d9ac9;
                color: #00000;
                font-size: 30px;
                border: 1px solid #ffffff;
                border-radius: 5px;
                padding: 10px 20px;
                font-weight: bold;
                cursor: pointer;
            }
            div.errorMessage {
                color: white;
                text-align: left;
                font-family: 'Verdana', sans-serif;
                font-style: italic;
                font-size: 12px;
                margin-top: 2px;
            }
            div#successMessage {
                font-family: 'Verdana', sans-serif;
                color: white;
                font-size: 25px;
                margin-top: 5px;
            }
            a, a:link, a:visited, a:active {
                color: white;
                text-decoration: underline;
            }
        </style>
    </head>
    <body><center>
        <table class="header">
            <tr class="header">
                <td class="header" id="image-td">
                    <img src="logos/logo-blue.png" class="header">
                </td>
                <td class="header" id="signup-td">
                    Sign Up
                </td>
            </tr>
        </table>
        <form method="POST" action="">
        <table class="signup">
            <tr class="signup">
                <td class="signup">
                    Email
                </td>
                <td class="signup">
                    <input type="text" class="inputtext" name="email" id="email" required>
                    <br>
                    <div class="errorMessage" id="emailError"><?php echo $emailError; ?></div>
                </td>
            </tr>
            <tr class="signup">
                <td class="signup">
                    Username
                </td>
                <td class="signup">
                    <input type="text" class="inputtext" name="username" id="username" required>
                    <br>
                    <div class="errorMessage" id="usernameError"><?php echo $usernameError; ?></div>
                </td>
            </tr>
            <tr class="signup">
                <td class="signup">
                    Password
                </td>
                <td class="signup">
                    <input type="password" class="inputtext" name="password1" id="password1" required>
                    <br>
                    <div class="errorMessage" id="password1Error"><?php echo $password1Error; ?></div>
                </td>
            </tr>
            <tr class="signup">
                <td class="signup">
                    Confirm Pass
                </td>
                <td class="signup">
                    <input type="password" class="inputtext" name="password2" id="password2" required>
                    <br>
                    <div class="errorMessage" id="pass2Error"><?php echo $password2Error; ?></div>
                </td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Sign Up" id="submit">
        <br><br>
        <div id="successMessage"><?php echo $successMessage; ?></div>
    </center></body>
</html>