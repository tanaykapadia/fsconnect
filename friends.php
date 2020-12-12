<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: index.php");
    }
    $followingList = "";
    $followerList = "";
    $followRequestList = "";
    $username = $_SESSION["username"];
    $followmessage = "";
    $unfollowmessage = "";
    $removemessage = "";
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "fsconnect";
    $conn = mysqli_connect($server, $user, $pass, $db);
    $selectquery = "SELECT following FROM following WHERE follower = '$username'";
    $squery = mysqli_query($conn,$selectquery);
    if ($squery->num_rows > 0) {
        $followingList = "<ul id='followingListHTML' class='followingUnfollowingList'>";
        while ($row = $squery->fetch_assoc()) {
            $followingList = $followingList . "<li>" . $row['following'] . "</li>";
            while ($row = $squery->fetch_assoc()) {
                $followingList = $followingList . "<li>" . $row['following'] . "</li>";
            }
        }
        $followingList = $followingList . "</ul>";
    } else {
        $followingList = "<span id='nofollowing' class='nofollowingfollower'>You have not started following anybody yet!</span>";
    }
    $selectquery = "SELECT follower FROM following WHERE following = '$username'";
    $squery = mysqli_query($conn,$selectquery);
    if ($squery->num_rows > 0) {
        $followerList = "<ul id='followerListHTML' class='followingUnfollowingList'>";
        while ($row = $squery->fetch_assoc()) {
            $followerList = $followerList . "<li>" . $row['follower'] . "</li>";
            while ($row = $squery->fetch_assoc()) {
                $followerList = $followerList . "<li>" . $row['follower'] . "</li>";
            }
        }
        $followerList = $followerList . "</ul>";
    } else {
        $followerList = "<span id='nofollower' class='nofollowingfollower'>You have no followers as of now.</span>";
    }
    $selectquery = "SELECT follower FROM followrequest WHERE following = '$username'";
    $squery = mysqli_query($conn,$selectquery);
    if ($squery->num_rows > 0) {
        $followRequestList = "<ul id='followerRequestListHTML' class='followingUnfollowingList'>";
        while ($row = $squery->fetch_assoc()) {
            $followRequestList = $followRequestList . "<form action='' method='POST'><li>" . $row['follower'] . " <input type='submit' style='border:0;background:transparent;color:blue;' value='Accept' id='accept" . $row["follower"] . "' name='accept" . $row["follower"] . "'><input type='submit' style='border:0;background:transparent;color:blue;' value='Reject' id='reject" . $row["follower"] . "' name='reject" . $row["follower"] . "'></li></form>";
            while ($row = $squery->fetch_assoc()) {
                $followRequestList = $followRequestList . "<form action='' method='POST'><li>" . $row['follower'] . " <input type='submit' style='border:0;background:transparent;color:blue;' value='Accept' id='accept" . $row["follower"] . "' name='accept" . $row["follower"] . "'><input type='submit' style='border:0;background:transparent;color:blue;' value='Reject' id='reject" . $row["follower"] . "' name='reject" . $row["follower"] . "'></li></form>";
            }
        }
        $followRequestList = $followRequestList . "</ul>";
    } else {
        $followRequestList = "<span id='nofollowrequest' class='nofollowingfollower'>No pending requests.</span>";
    }
    if (isset($_POST["follow"])) {
        $followingUsername = $_POST["followingUsername"];
        if ($followingUsername !== $username) {
            $query = "SELECT * FROM users WHERE username='$followingUsername'";
            $results = mysqli_query($conn, $query);
            if (mysqli_num_rows($results) == 1) {
                $query = "SELECT * FROM following WHERE follower = '$username' AND following = '$followingUsername'";
                $results = mysqli_query($conn, $query);
                if (mysqli_num_rows($results) > 0) {
                    $followmessage = "<label id='error'>You are already following @" . $followingUsername . "</label>";
                } else {
                    $insertquery = "INSERT INTO followrequest (follower, following) VALUES ('$username', '$followingUsername')";
                    $iquery = mysqli_query($conn,$insertquery);
                    if ($iquery) {
                        $followmessage = "<label id='success'>You have sent a follow request to @" . $followingUsername . ".</label>";
                    }
                }
            } else {
                $followmessage = "<label id='error'>No account with given username exists.</label>";
            }
        } else {
            $followmessage = "<label id='error'>No need to follow yourself :P</label>";
        }
    }
    if (isset($_POST["unfollow"])) {
        $unfollowingUsername = $_POST["unfollowingUsername"];
        if ($unfollowingUsername !== $username) {
            $query = "SELECT * FROM users WHERE username='$unfollowingUsername'";
            $results = mysqli_query($conn, $query);
            if (mysqli_num_rows($results) == 1) {
                $query = "SELECT * FROM following WHERE follower = '$username' AND following = '$unfollowingUsername'";
                $results = mysqli_query($conn, $query);
                if (mysqli_num_rows($results) > 0) {
                    $deletequery = "DELETE from following where follower ='$username' AND following = '$unfollowingUsername'";
                    $dquery = mysqli_query($conn,$deletequery);
                    if ($dquery) {
                        $unfollowmessage = "<label id='success'>You are no longer following @" . $unfollowingUsername . ".</label>";
                    }
                } else {
                    $unfollowmessage = "<label id='error'>You were never following @" . $unfollowingUsername . ".</label>";
                }
            } else {
                $unfollowmessage = "<label id='error'>No account with given username exists.</label>";
            }
        } else {
            $unfollowmessage = "<label id='error'>No need to unfollow yourself :P</label>";
        }
    }
    if (isset($_POST["remove"])) {
        $removingUsername = $_POST["removingUsername"];
        $query = "SELECT * FROM following WHERE follower = '$removingUsername' AND following = '$username'";
        $results = mysqli_query($conn, $query);
        if (mysqli_num_rows($results) > 0) {
            $deletequery = "DELETE FROM following WHERE follower = '$removingUsername' AND following = '$username'";
            $dquery = mysqli_query($conn,$deletequery);
            if ($dquery) {
                $removemessage = "<label id='success'>@" . $removingUsername . " is no longer following you.</label>";
            }
        } else {
            $removemessage = "<label id='error'>@" . $removingUsername . " was never following you.</label>";
        }
    }
    if (isset($_POST["acceptuser1"])) {
        $query = "DELETE FROM followrequest WHERE follower = 'user1' AND following = '$username'; INSERT INTO following (follower, following) VALUES ('user1', '$username');";
        if (!$conn->multi_query($query)) {
            echo "<script>alert('Multi query failed: " . $mysqli->error . "');</script>";
        }
    }
    if (isset($_POST["rejectuser1"])) {
        $deletequery = "DELETE FROM followrequest WHERE follower = 'user1' AND following = '$username'";
        $dquery = mysqli_query($conn,$deletequery);
    }
    if (isset($_POST["acceptuser2"])) {
        $query = "DELETE FROM followrequest WHERE follower = 'user2' AND following = '$username'; INSERT INTO following (follower, following) VALUES ('user2', '$username');";
        if (!$conn->multi_query($query)) {
            echo "<script>alert('Multi query failed: " . $mysqli->error . "');</script>";
        }
    }
    if (isset($_POST["rejectuser2"])) {
        $deletequery = "DELETE FROM followrequest WHERE follower = 'user1' AND following = '$username'";
        $dquery = mysqli_query($conn,$deletequery);
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="logos/favicon.ico" type="image/png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <title>
            Friends | FSConnect
        </title>
        <style>
            a.nav-link {
                font-size: 25px;
                font-family: 'Roboto', sans-serif;
                margin: 10px;
            }
            div.form-group {
                width: 20%;
                margin-top: 2%;
            }
            input#follow, input#unfollow, input#remove, div.form-group, label, #followingListButton, #followerListButton, #followingList, #followerList, #followrequestList, #followRequestListButton {
                margin-left: 2%;
            }
            #followingList, #followerList, #followRequestList {
                width: 20%;
                margin-top: 20px;
            }
            label {
                font-size: 18px;
                margin-top: 1%;
            }
            label#error {
                color: #ed4e4e;
            }
            label#success {
                color: #44b543;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="home.php">
                <img src="logos/logo-white.png" height="40" alt="FSConnect Logo" id="logo">
            </a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php"><img src="logos/feed.png" height="28" class="pagelogos"> &nbsp;<span class="pagelinks">Feed</span></a>
                </li>
            </div>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <li class="nav-item active">
                    <a class="nav-link" href="chat"><img src="logos/messages.png" height="28" class="pagelogos"> &nbsp;<span class="pagelinks">Messages</span></a>
                </li>
            </div>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <li class="nav-item active">
                    <a class="nav-link" href="calls"><img src="logos/calls.png" height="28" class="pagelogos"> &nbsp;<span class="pagelinks">Calls</span></a>
                </li>
            </div>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <li class="nav-item active">
                    <a class="nav-link" href="friends.php"><img src="logos/friends.png" height="28" class="pagelogos"> &nbsp;<span class="pagelinks">Friends</span></a>
                </li>
            </div>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <li class="nav-item active">
                    <a class="nav-link" href="account.php"><img src="logos/account.png" height="28" class="pagelogos"> &nbsp;<span class="pagelinks">Account</span></a>
                </li>
            </div>
            </ul>
        </nav>
        <br>
        <a class="btn btn-light" data-toggle="collapse" href="#followerList" role="button" aria-expanded="false" aria-controls="collapseExample" id="followerListButton">
            People who follow you
        </a>
        <div class="collapse" id="followerList">
            <div class="card card-body"><?php echo $followerList ?></div>
        </div>
        <br><br>
        <a class="btn btn-light" data-toggle="collapse" href="#followRequestList" role="button" aria-expanded="false" aria-controls="collapseExample" id="followRequestListButton">
            Pending Follow Requests
        </a>
        <div class="collapse" id="followRequestList">
            <div class="card card-body"><?php echo $followRequestList ?></div>
        </div>
        <br><br>
        <a class="btn btn-light" data-toggle="collapse" href="#followingList" role="button" aria-expanded="false" aria-controls="collapseExample" id="followingListButton">
            People you follow
        </a>
        <div class="collapse" id="followingList">
            <div class="card card-body"><?php echo $followingList ?></div>
        </div>
        <br>
        <form method="POST" action="">
            <div class="form-group">
                <input type="text" class="form-control" id="followingUsername" name="followingUsername" required>
            </div>
            <input type="submit" class="btn btn-dark" name="follow" id="follow" value="Follow User" class="followUnfollowButtons">
            <br>
            <?php echo $followmessage; ?>
        </form>
        <form method="POST" action="">
            <div class="form-group">
                <input type="text" class="form-control" id="unfollowingUsername" name="unfollowingUsername" required>
            </div>
            <input type="submit" class="btn btn-dark" name="unfollow" id="unfollow" value="Unfollow User" class="followUnfollowButtons">
            <br>
            <?php echo $unfollowmessage; ?> 
        </form>
        <form method="POST" action="">
            <div class="form-group">
                <input type="text" class="form-control" id="removingUsername" name="removingUsername" required>
            </div>
            <input type="submit" class="btn btn-dark" name="remove" id="remove" value="Remove User" class="followUnfollowButtons">
            <br>
            <?php echo $removemessage; ?> 
        </form>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
</html>
