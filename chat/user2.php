<?php
	session_start();
	if (!isset($_SESSION["username"])) {
	    header("Location: index.php");
	}
	$username = $_SESSION["username"];
	$toUsername = "user2"
	$server = "localhost";
	$user = "root";
	$pass = "";
	$db = "fsconnect";
	$conn = mysqli_connect($server, $user, $pass, $db);
	if (isset($_POST["sendText"])) {
		if (isset($_POST["message"]) && $_POST["message"] !== "") {
			$content = $_POST["message"];
			$insertquery = "INSERT INTO chat (fromUsername,toUsername,content,datetime) VALUES ('$username','$toUsername','$content',now())";
			$iquery = mysqli_query($conn,$insertquery);
            if ($iquery) {
            } else {
            	echo "<script>alert('Message not successfully sent.');</script>";
            }
		} else {
			echo "<script>alert('Please enter a message first');</script>";
		}
	}
	if (isset($_POST["sendPhoto"])) {
		$file_name = $_FILES['photo']['name'];
		$file_size = $_FILES['photo']['size'];
		$file_tmp = $_FILES['photo']['tmp_name'];
		$file_type= $_FILES['photo']['type'];
		$folder = "media/" . $file_name;
		$content = "<img style=\'padding: 5px 0px; width:300px\' src=\'media/" . $file_name . "\'>";
		$insertquery = "INSERT INTO chat (fromUsername,toUsername,content,datetime) VALUES ('$username','$toUsername','$content',now())";
		$iquery = mysqli_query($conn,$insertquery);
		if ($iquery && move_uploaded_file($file_tmp, $folder)) {
		} else {
		    echo "<script>alert('Message not successfully sent.');</script>";
		} 
	}
	if (isset($_POST["sendVideo"])) {
		$file_name = $_FILES['video']['name'];
		$file_size = $_FILES['video']['size'];
		$file_tmp = $_FILES['video']['tmp_name'];
		$file_type= $_FILES['video']['type'];
		$folder = "media/" . $file_name;
		$content = "<video style=\'padding: 5px 0px; width:300px\' controls><source src=\'media/" . $file_name . "\'></video>";
		$insertquery = "INSERT INTO chat (fromUsername,toUsername,content,datetime) VALUES ('$username','$toUsername','$content',now())";
		$iquery = mysqli_query($conn,$insertquery);
		if ($iquery && move_uploaded_file($file_tmp, $folder)) {
		} else {
		    echo "<script>alert('Message not successfully sent.');</script>";
		}
	}
	$selectquery = "SELECT * FROM chat WHERE (fromUsername='$toUsername' AND toUsername='$username') OR (fromUsername='$username' AND toUsername='$toUsername')  ORDER BY datetime DESC";
    $squery = mysqli_query($conn,$selectquery);
    if ($squery->num_rows > 0) {
        $feedHTML = "<table class='feedTable'>";
        while ($row = $squery->fetch_assoc()) {
            $feedHTML = $feedHTML . "<tr class='feedTable'><td class='feedTable'>" . $row["fromUsername"] . " at " . $row["datetime"] . " says:</td></tr><tr class='feedTable feedTableMessage'><td class='feedTable'>" . $row["content"] . "</td></tr>";
            while ($row = $squery->fetch_assoc()) {
                $feedHTML = $feedHTML . "<tr class='feedTable'><td class='feedTable'>" . $row["fromUsername"] . " at " . $row["datetime"] . " says:</td></tr><tr class='feedTable feedTableMessage'><td class='feedTable'>" . $row["content"] . "</td></tr>";
            }
        }
        $feedHTML = $feedHTML . "</table>";
    } else {
    	$feedHTML = "<span id='noMessagesYet'>No Messages Yet.</span>";
    }
?>
<html>
	<head>
		<link rel="icon" href="../logos/favicon.ico" type="image/png">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>
			Chat with @<?php echo $toUsername ?> | FSConnect
		</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<style>
			div.feedDiv {
				max-height: 74%;
				overflow-y: scroll;
			}
			input#message {
				width: 600px;
			}
			.sendMessage {
				padding: 10px;
			}
			td.sendMessage {
				vertical-align: center;
			}
			span.form-group.mb-2 {
				font-size: 20px;
			}
			tr#sendMessageLabel {
				padding: 0;
			}
			form {
				position: fixed;
				left: 0;
				top: 74%;
				width: 100%;
			}
			div#sendMessageDiv, table.sendMessage {
				background-color: #858585;
				color: #FFFFFF;
			}
			table.feedTable {
				margin: 10px;
			}
			tr.feedTableMessage {
				font-size: 20px;
			}
			span#noMessagesYet {
				font-size: 25px;
				margin: 10px;
			}
			input#submit {
				margin-top: 4.5px;
			}
			input#video, input#photo {
				background: transparent;
				border-color: transparent;
				color: #FFFFFF;
				padding-left: 0;
			}
		</style>
	</head>
	<body>
		<?php echo $feedHTML; ?>
		<center>
		<form method="POST" action="" enctype="multipart/form-data">
			<div id="sendMessageDiv"><table class="sendMessage">
				<tr class="sendMessage" id="sendMessageLabel">
					<td class="sendMessage">
						<span class="form-group mb-2 headers">Message</span>
					</td>
					<td class="sendMessage">
						<span class="form-group mx-sm-3 mb-2"><input type="text" class="form-control" id="message" name="message"></span>
					</td>
					<td class="sendMessage">
						<input type="submit" name="sendText" id="sendText" value="Send" class="btn btn-light mb-2">
					</td>
				</tr>
				<tr>
					<td class="sendMessage">
						<span class="form-group mb-2 headers">Image</span>
					</td>
					<td class="sendMessage">
						<span class="form-group mx-sm-3 mb-2"><input type="file" class="form-control" id="photo" name="photo" accept="image/*"></span>
					</td>
					<td class="sendMessage">
						<input type="submit" name="sendPhoto" id="sendPhoto" value="Send" class="btn btn-light mb-2">
					</td>
				</tr>
				<tr>
					<td class="sendMessage">
						<span class="form-group mb-2 headers">Video</span>
					</td>
					<td class="sendMessage">
						<span class="form-group mx-sm-3 mb-2"><input type="file" class="form-control" id="video" name="video" accept="video/*"></span>
					</td>
					<td class="sendMessage">
						<input type="submit" name="sendVideo" id="sendVideo" value="Send" class="btn btn-light mb-2">
					</td>
				</tr>
			</table></div>
		</form>
		</center>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</body>
</html>