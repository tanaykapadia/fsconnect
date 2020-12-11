<?php
	$successMessage = "";
	if (isset($_POST["submit"])) {
		$email = $_POST["email"];
		$server = "localhost";
        $user = "root";
        $pass = "";
        $db = "fsconnect";
        $conn = mysqli_connect($server, $user, $pass, $db);
        $query = "SELECT * FROM users WHERE email='$email'";
        $results = mysqli_query($conn, $query);
        if (mysqli_num_rows($results) == 1) {
        	while($row = mysqli_fetch_assoc($results)) {
        	    $username = $row["username"];
        	    $password = $row["password"];
        	}
        	ini_set("SMTP","smtp.gmail.com");
        	ini_set("sendmail_from","tkapadia2911@gmail.com");
        	$subject = "FSConnect Login Credentials";
        	$body = "The username of your account is " . $username . " and the password is " . $password . ". Thank you!";
        	$headers = "From: sender\'s email";
        	if (mail($email, $subject, $body, $headers)) {
        	    $successMessage = "Email with all login credentials successfully sent to " . $email . "!";
        	} else {
        	    $successMessage = "Failed to send an email to the given address.";
        	}
        } else {
            $successMessage = "Account with given email does not exist.";
        }
	}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="logos/favicon.ico" type="image/png">
        <title>
            Reset Credentials | FSConnect 
        </title>
        <style>
            body {
                background-color: #6d9ac9;
            }
            body, table, td, input {
                font-family: 'Roboto', sans-serif;
                color: #ffffff;
            }
            td#login-td {
                color: white;
                text-align: center;
                font-size: 36px;
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
                width: 300px;
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
        </style>
    </head>
    <body><center>
        <table class="header">
            <tr class="header">
                <td class="header" id="image-td">
                    <img src="logos/logo-blue.png" class="header">
                </td>
            </tr>
            <tr class="header">
                <td class="header" id="login-td">
                    Reset your Credentials
                </td>
            </tr>
        </table>
        <form method="POST" action="">
        <table class="login">
            <tr class="login">
                <td class="login">
                    Email
                </td>
                <td class="login">
                    <input type="email" class="inputtext" name="email" id="email" required>
                </td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Submit" id="submit">
        <br><br>
        <div id="successMessage"><?php echo $successMessage; ?></div>
    </center></body>
</html>