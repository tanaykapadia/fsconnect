<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: ../index.php");
    }
    $username = $_SESSION["username"];
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "fsconnect";
    $conn = mysqli_connect($server, $user, $pass, $db);
    $selectquery = "SELECT following FROM following WHERE follower = '$username'";
    $squery = mysqli_query($conn,$selectquery);
    if ($squery->num_rows > 0) {
        $followingList = array();
        while ($row = $squery->fetch_assoc()) {
            array_push($followingList, $row["following"]);
            while ($row = $squery->fetch_assoc()) {
                array_push($followingList, $row["following"]);
            }
        }
    }
    $array = implode("', '",$followingList);
    $personalSelectQuery = "SELECT username FROM users WHERE username IN ('" . $array . "') ORDER BY username ASC";
    $squery1 = mysqli_query($conn,$personalSelectQuery);
    $contactList = "";
    while ($row = $squery1->fetch_assoc()) {
        $contactList = $contactList . "<ul class='contactList'><li class='contactList'><a class='contactList' href='" . $row["username"] . ".php' target='_blank'>" . $row["username"] . "</a></li>";
        while ($row = $squery1->fetch_assoc()) {
            $contactList = $contactList . "<li class='contactList'><a class='contactList' href='" . $row["username"] . ".php' target='_blank'>" . $row["username"] . "</a></li>";
        }
        $contactList = $contactList . "</ul>";
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="logos/favicon.ico" type="image/png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <title>
            Calls | FSConnect
        </title>
        <style>
            a.nav-link {
                font-size: 25px;
                font-family: 'Roboto', sans-serif;
                margin: 10px;
            }
            .jumbotron {
                width: 30%;
                float: right;
                margin-top: 4%;
                margin-right: 10%;
            }
            #myInput {
                font-size: 0;
                width: 0;
                height: 0;
                border: 0px solid white;
            }
            ul.contactList, div.header {
                margin: 10px;
            }
            li.contactList {
                font-size: 20px;
            }
            div.header {
                font-size: 25px;
                width: 44.8%;
                padding: 1%;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="home.php">
                <img src="../logos/logo-white.png" height="40" alt="FSConnect Logo" id="logo">
            </a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <li class="nav-item active">
                    <a class="nav-link" href="../home.php"><img src="../logos/feed.png" height="28" class="pagelogos"> &nbsp;<span class="pagelinks">Feed</span></a>
                </li>
            </div>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <li class="nav-item active">
                    <a class="nav-link" href="../chat"><img src="../logos/messages.png" height="28" class="pagelogos"> &nbsp;<span class="pagelinks">Messages</span></a>
                </li>
            </div>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <li class="nav-item active">
                    <a class="nav-link" href="../calls"><img src="../logos/calls.png" height="28" class="pagelogos"> &nbsp;<span class="pagelinks">Calls</span></a>
                </li>
            </div>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <li class="nav-item active">
                    <a class="nav-link" href="../friends.php"><img src="../logos/friends.png" height="28" class="pagelogos"> &nbsp;<span class="pagelinks">Friends</span></a>
                </li>
            </div>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <li class="nav-item active">
                    <a class="nav-link" href="../account.php"><img src="../logos/account.png" height="28" class="pagelogos"> &nbsp;<span class="pagelinks">Account</span></a>
                </li>
            </div>
            </ul>
        </nav>
        <div class="header bg-light">
            Join a video call with any of your friends!
            <br>
            Just click on their name and tell your friend to do the same.
        </div>
        <?php echo $contactList ?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
</html>
