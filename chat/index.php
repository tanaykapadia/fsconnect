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
    $personalListHTML = "";
    while ($row = $squery1->fetch_assoc()) {
        $personalListHTML = $personalListHTML . "<li class='personalListHTML'><a class='personalListHTML' href='" . $row["username"] . ".php' target='_blank'>" . $row["username"] . "</a></li>";
        while ($row = $squery1->fetch_assoc()) {
            $personalListHTML = $personalListHTML . "<li class='personalListHTML'><a class='personalListHTML' href='" . $row["username"] . ".php' target='_blank'>" . $row["username"] . "</a></li>";
        }
    }
    $groupSelectQuery = "SELECT name FROM groupchatinfo WHERE (member1 = '$username') OR (member2 = '$username') OR (member3 = '$username') OR (member4 = '$username') OR (member5 = '$username') OR (member6 = '$username') OR (member7 = '$username') OR (member8 = '$username') OR (member9 = '$username') OR (member10 = '$username') ORDER BY name ASC";
    $squery2 = mysqli_query($conn,$groupSelectQuery);
    $groupListHTML = "";
    if($squery2->num_rows > 0) {
        while ($row2 = $squery2->fetch_assoc()) {
            $groupListHTML = $groupListHTML . "<li class='groupListHTML'><a class='groupListHTML' href='" . $row2['name'] . ".php' target='_blank'>" . $row2['name'] . "</a></li>";
            while ($row2 = $squery2->fetch_assoc()) {
                $groupListHTML = $groupListHTML . "<li class='groupListHTML'><a class='groupListHTML' href='" . $row2['name'] . ".php' target='_blank'>" . $row2['name'] . "</a></li>";
            }
        }
    }
    if (isset($_POST["submit"])) {
        if (isset($_POST["name"]) && $_POST["name"] !== "") {
            if((!isset($_POST["member1"]) OR $_POST["member1"] == "") && (!isset($_POST["member2"]) OR $_POST["member2"] == "") && (!isset($_POST["member3"]) OR $_POST["member3"] == "") && (!isset($_POST["member4"]) OR $_POST["member4"] == "") && (!isset($_POST["member5"]) OR $_POST["member5"] == "") && (!isset($_POST["member6"]) OR $_POST["member6"] == "") && (!isset($_POST["member7"]) OR $_POST["member7"] == "") && (!isset($_POST["member8"]) OR $_POST["member8"] == "") && (!isset($_POST["member9"]) OR $_POST["member9"] == "") && (!isset($_POST["member10"]) OR $_POST["member10"] == "")) {
                echo "<script>alert('Please enter atleast one group member');</script>";
            } else {
                $name = $_POST["name"];
                $member1 = $_POST["member1"];
                $member2 = $_POST["member2"];
                $member3 = $_POST["member3"];
                $member4 = $_POST["member4"];
                $member5 = $_POST["member5"];
                $member6 = $_POST["member6"];
                $member7 = $_POST["member7"];
                $member8 = $_POST["member8"];
                $member9 = $_POST["member9"];
                $member10 = $_POST["member10"];
                $insertquery = "INSERT INTO groupchatinfo (name, member1, member2, member3, member4, member5, member6, member7, member8, member9, member10) VALUES ('$name', '$member1', '$member2', '$member3', '$member4', '$member5', '$member6', '$member7', '$member8', '$member9', '$member10')";
                $iquery = mysqli_query($conn,$insertquery);
                if ($iquery) {
                } else {
                    echo "<script>alert('Attempt to create group unsuccesfull');</script>";
                }
            }
        } else {
            echo "<script>alert('Please enter a groupchat name first');</script>";
        }
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="../logos/favicon.ico" type="image/png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <title>
            Inbox | FSConnect
        </title>
        <style>
            a.nav-link {
                font-size: 25px;
                font-family: 'Roboto', sans-serif;
                margin: 10px;
            }
            ul.personalListHTML, ul.groupListHTML {
                margin: 20px;
            }
            li.personalListHTML, li.groupListHTML {
                font-size: 20px;
            }
            span.sectionHeaders {
                font-size: 30px;
            }
            span#personalChat, span#groupChat, #makeNewGroupButton, #makeNewGroup {
                margin-left: 20px;
            }
            div#makeNewGroup {
                width: 80%;
            }
            div.card-body {
                padding-bottom: 0;
            }
            div.form-row {
                margin-top: 10px;
            }
            div.form-group-submit {
                margin-top: 10px;
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
                    <a class="nav-link" href="index.php"><img src="../logos/messages.png" height="28" class="pagelogos"> &nbsp;<span class="pagelinks">Messages</span></a>
                </li>
            </div>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <li class="nav-item active">
                    <a class="nav-link" href="../calls.php"><img src="../logos/calls.png" height="28" class="pagelogos"> &nbsp;<span class="pagelinks">Calls</span></a>
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
        <br>
        <span class="sectionHeaders" id="personalChat">Personal Chat</span>
        <ul class="personalListHTML">
            <?php echo $personalListHTML ?>
        </ul>
        <hr>
        <span class="sectionHeaders" id="groupChat">Group Chat</span>
        <ul class="groupListHTML">
            <?php echo $groupListHTML ?>
        </ul>
        <a class="btn btn-light" data-toggle="collapse" href="#makeNewGroup" role="button" aria-expanded="false" aria-controls="collapseExample" id="makeNewGroupButton">
            Make a New Group
        </a>
        <br><br>
        <div class="collapse" id="makeNewGroup">
            <div class="card card-body">
                <form id="createGroupchat" name="createGroupchat" action="" method="POST">
                   <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-1 col-form-label">Name</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name of your Groupchat">
                        </div>
                    </div>
                    <div>
                        Enter the name of the group members (including yourself)
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" id="member1" name="member1" placeholder="Member 1">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="member2" name="member2" placeholder="Member 2">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="member3" name="member3" placeholder="Member 3">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="member4" name="member4" placeholder="Member 4">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="member5" name="member5" placeholder="Member 5">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" id="member6" name="member6" placeholder="Member 6">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="member7" name="member7" placeholder="Member 7">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="member8" name="member8" placeholder="Member 8">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="member9" name="member9" placeholder="Member 9">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="member10" name="member10" placeholder="Member 10">
                        </div>
                      </div>
                    <div class="form-group row form-group-submit">
                        <div class="col-sm-10">
                            <button type="submit" name="submit" id="submit" class="btn btn-secondary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
</html>