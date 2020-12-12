<?php
    $textPostError = "";
    $imagePostError = "";
    $videoPostError = "";
    $feedHTML = "";
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: index.php");
    }
    $username = $_SESSION["username"];
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "fsconnect";
    $conn = mysqli_connect($server, $user, $pass, $db);
    if (isset($_POST["createTextPost"])) {
        $text = $_POST["text"];
        if(!empty($text) && preg_match("/[a-z]/i", $text)){
            $insertquery = "INSERT INTO posts (username,text,likes) VALUES ('$username','$text',0)";
            $iquery = mysqli_query($conn,$insertquery);
            if ($iquery) {
                $textPostError = "Post made successfully!";
            } else {
                $textPostError = "Post unsuccessful.";
            }
        } else {
            $textPostError = "Please enter something in the text post.";
        }
    }
    if (isset($_POST["createImagePost"])) {
        $file_name = $_FILES['photo']['name'];
        $file_size = $_FILES['photo']['size'];
        $file_tmp = $_FILES['photo']['tmp_name'];
        $file_type= $_FILES['photo']['type'];
        $folder = "posts/" . $file_name; 
        $insertquery = "INSERT INTO posts (username,photo,likes) VALUES ('$username','$file_name',0)";
        $iquery = mysqli_query($conn,$insertquery);
        if ($iquery && move_uploaded_file($file_tmp, $folder)) {
            $imagePostError = "Image posted successfully!";
        } else {
            $imagePostError = "Image not posted.";
        }
    }
    if (isset($_POST["createVideoPost"])) {
        $file_name = $_FILES['video']['name'];
        $file_size = $_FILES['video']['size'];
        $file_tmp = $_FILES['video']['tmp_name'];
        $file_type= $_FILES['video']['type'];
        $folder = "posts/" . $file_name; 
        $insertquery = "INSERT INTO posts (username,video,likes) VALUES ('$username','$file_name',0)";
        $iquery = mysqli_query($conn,$insertquery);
        if ($iquery && move_uploaded_file($file_tmp, $folder)) {
            $videoPostError = "Video posted successfully!";
        } else {
            $videoPostError = "Video not posted.";
        }
    }
    if (isset($_POST["like1"])) {
        $postID = 1;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        $squery = mysqli_query($conn,$selectquery);
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
        $iquery = mysqli_query($conn,$insertquery);
    }
    if (isset($_POST["like2"])) {
        $postID = 2;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        $squery = mysqli_query($conn,$selectquery);
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
        $iquery = mysqli_query($conn,$insertquery);
    }
    if (isset($_POST["like3"])) {
        $postID = 3;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        $squery = mysqli_query($conn,$selectquery);
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
        $iquery = mysqli_query($conn,$insertquery);
    }
    if (isset($_POST["like4"])) {
        $postID = 4;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        $squery = mysqli_query($conn,$selectquery);
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
        $iquery = mysqli_query($conn,$insertquery);
    }
    if (isset($_POST["like5"])) {
        $postID = 5;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        $squery = mysqli_query($conn,$selectquery);
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
        $iquery = mysqli_query($conn,$insertquery);
    }
    if (isset($_POST["like6"])) {
        $postID = 6;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        $squery = mysqli_query($conn,$selectquery);
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
        $iquery = mysqli_query($conn,$insertquery);
    }
    if (isset($_POST["like7"])) {
        $postID = 7;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        $squery = mysqli_query($conn,$selectquery);
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
        $iquery = mysqli_query($conn,$insertquery);
    }
    if (isset($_POST["like8"])) {
        $postID = 8;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        $squery = mysqli_query($conn,$selectquery);
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
        $iquery = mysqli_query($conn,$insertquery);
    }
    if (isset($_POST["like9"])) {
        $postID = 9;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        $squery = mysqli_query($conn,$selectquery);
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
        $iquery = mysqli_query($conn,$insertquery);
    }
    if (isset($_POST["like10"])) {
        $postID = 10;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        $squery = mysqli_query($conn,$selectquery);
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
        $iquery = mysqli_query($conn,$insertquery);
    }
    if (isset($_POST["like11"])) {
        $postID = 11;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
           $squery = mysqli_query($conn,$selectquery);
        $iquery = mysqli_query($conn,$insertquery);
    }
    if (isset($_POST["like12"])) {
        $postID = 12;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
           $squery = mysqli_query($conn,$selectquery);
        $iquery = mysqli_query($conn,$insertquery);
    }
    if (isset($_POST["like13"])) {
        $postID = 13;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
           $squery = mysqli_query($conn,$selectquery);
        $iquery = mysqli_query($conn,$insertquery);
    }
    if (isset($_POST["like14"])) {
        $postID = 14;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
           $squery = mysqli_query($conn,$selectquery);
        $iquery = mysqli_query($conn,$insertquery);
    }
    if (isset($_POST["like15"])) {
        $postID = 15;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
           $squery = mysqli_query($conn,$selectquery);
        $iquery = mysqli_query($conn,$insertquery);
    }
    if (isset($_POST["like16"])) {
        $postID = 16;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
           $squery = mysqli_query($conn,$selectquery);
        $iquery = mysqli_query($conn,$insertquery);
    }
    if (isset($_POST["like17"])) {
        $postID = 17;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
           $squery = mysqli_query($conn,$selectquery);
        $iquery = mysqli_query($conn,$insertquery);
    }
    if (isset($_POST["like18"])) {
        $postID = 18;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
           $squery = mysqli_query($conn,$selectquery);
        $iquery = mysqli_query($conn,$insertquery);
    }
    if (isset($_POST["like19"])) {
        $postID = 19;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
           $squery = mysqli_query($conn,$selectquery);
        $iquery = mysqli_query($conn,$insertquery);
    }
    if (isset($_POST["like20"])) {
        $postID = 20;
        $selectquery = "SELECT likes FROM posts WHERE postID = '$postID'";
        while ($row = $squery->fetch_assoc()) {
            $currentLikes = $row["likes"];
        }
        $newLikes = (1 * $currentLikes) + 1;
        $insertquery = "UPDATE posts SET likes='$newLikes' WHERE postID = '$postID'";
           $squery = mysqli_query($conn,$selectquery);
        $iquery = mysqli_query($conn,$insertquery);
    }
    $followingList = array();
    $selectquery = "SELECT following FROM following WHERE follower = '$username'";
    $squery = mysqli_query($conn,$selectquery);
    if ($squery->num_rows > 0) {
        while ($row = $squery->fetch_assoc()) {
            array_push($followingList, $row["following"]);
            while ($row = $squery->fetch_assoc()) {
                array_push($followingList, $row["following"]);
            }
        }
    }
    $array = implode("', '",$followingList);
    $selectquery = "SELECT * FROM posts WHERE username IN ('" . $array . "') ORDER BY postID DESC";
    $squery = mysqli_query($conn,$selectquery);
    if ($squery->num_rows > 0) {
        $feedHTML = "<table class='feedTable'><tr class='feedTable'><th class='feedTable header-username'>Username</th><th class='feedTable header-content'>Post</th></tr>";
        while ($row = $squery->fetch_assoc()) {
            if (!$row["photo"] && !$row["video"]) {
                $postContent = $row["text"];
            } elseif (!$row["video"]) {
                $postContent = "<img class='feedImage' src='posts/" . $row["photo"] . "'>";
            } else {
                $postContent = "<video class='feedVideo' controls><source src='posts/" . $row["video"] . "'></video>";
            }
            $nameID = "like" . $row["postID"];
            $feedHTML = $feedHTML . "<tr class='feedTable'><td class='feedTable username'>" . $row["username"] . "</td><td class='feedTable content'>" . $postContent . "<br><form action='' method='POST'><input type='submit' value='Like' name='" . $nameID . "' id='" . $nameID . "' class='likeButton'> &nbsp;" . $row["likes"] . "</form></td></tr>";
            while ($row = $squery->fetch_assoc()) {
                if (!$row["photo"] && !$row["video"]) {
                    $postContent = $row["text"];
                } elseif (!$row["video"]) {
                    $postContent = "<img class='feedImage' src='posts/" . $row["photo"] . "'>";
                } else {
                    $postContent = "<video class='feedVideo' controls><source src='posts/" . $row["video"] . "'></video>";
                }
                $nameID = "like" . $row["postID"];
                $feedHTML = $feedHTML . "<tr class='feedTable'><td class='feedTable username'>" . $row["username"] . "</td><td class='feedTable content'>" . $postContent . "<br><form action='' method='POST'><input type='submit' value='Like' name='" . $nameID . "' id='" . $nameID . "' class='likeButton'> &nbsp;" . $row["likes"] . "</form></td></tr>";
            }
        }
        $feedHTML = $feedHTML . "</table>";
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="logos/favicon.ico" type="image/png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <title>
            Home | FSConnect
        </title>
        <style>
            a.nav-link {
                font-size: 25px;
                font-family: 'Roboto', sans-serif;
                margin: 10px;
            }
            nav {
                margin-bottom: 20px;
            }
            table.createPostTable {
                float: right;
                margin-left: 1%;
                margin-right: 17%;
                position: relative;
            }
            td.createPostTable {
                padding: 10px;
                text-align: center;
            }
            td.textPost {
                padding-right: 20px;
            }
            td.imagePost {
                padding-left: 10px;
            }
            textarea {
                font-size: 15px;
            }
            td.createPostTableHeader {
                border-top: 2px solid black;
                font-size: 20px;
            }
            td.createPostTableHeader.textPost {
                border-top: 0;
            }
            td.imageUpload, td.videoUpload {
                text-align: center;
                font-size: 15px;
            }
            input#photo {
                font-size: 15px;
            }
            img.feedImage {
                width: 500px;
            }
            td.username {
                font-size: 20px;
                text-align: center;
            }
            th.FeedTable {
                font-size: 30px;
                border-bottom: 2px solid black;
            }
            table.FeedTable {
                margin-left: 10%;
            }
            td.content {
                padding: 10px;
                max-width: 520px;
                word-wrap: normal;
                font-size: 18px;
            }
            th.header-username {
                padding-right: 20px;
                text-align: center;
            }
            th.header-content {
                padding-left: 10px;
            }
            input.likeButton {
                width: 48px;
                margin-top: 6px;
            }
            video.feedVideo {
                width: 500px;
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
        <form action="" method="POST" enctype="multipart/form-data"><table class="createPostTable">
            <tr class="createPostTable">
                <td class="createPostTable createPostTableHeader textPost">Create a Text Post</td>
            </tr>
            <tr class="createPostTable">
                <td class="createPostTable textPost"><textarea cols="35" rows="6" name="text" id="text"></textarea></td>
            </tr>
            <tr class="createPostTable">
                <td class="createPostTable textPost"><input type="submit" name="createTextPost" id="createTextPost" value= "Post!"></td>
            </tr class="createPostTable">
            <tr class="createPostTable">
                <td class="createPostTable textPost"><?php echo $textPostError; ?></td>
            </tr class="createPostTable">
            <tr class="createPostTable">
                <td class="createPostTable createPostTableHeader imagePost">Create a Image Post</td>
            </tr>
            <tr class="createPostTable">
                <td class="createPostTable imagePost imageUpload"><input type="file" name="photo" id="photo" accept="image/*"></td>
            </tr>
            <tr class="createPostTable">
                <td class="createPostTable imagePost"><input type="submit" name="createImagePost" id="createImagePost" value="Post!"></td>
            </tr class="createPostTable">
            <tr class="createPostTable">
                <td class="createPostTable imagePost"><?php echo $imagePostError; ?></td>
            </tr class="createPostTable">
            <tr class="createPostTable">
                <td class="createPostTable createPostTableHeader videoPost">Create a Video Post</td>
            </tr>
            <tr class="createPostTable">
                <td class="createPostTable videoPost videoUpload"><input type="file" name="video" id="video" accept="video/*"></td>
            </tr>
            <tr class="createPostTable">
                <td class="createPostTable videoPost"><input type="submit" name="createVideoPost" id="createVideoPost" value= "Post!"></td>
            </tr class="createPostTable">
            <tr class="createPostTable">
                <td class="createPostTable videoPost"><?php echo $videoPostError; ?></td>
            </tr class="createPostTable">
        </table></form>
        <?php echo $feedHTML; ?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
</html>
