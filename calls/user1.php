<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: ../index.php");
    }
    $username = $displayName = $_SESSION["username"];
    $subjectUsername = "user1";
    if ($subjectUsername == $username) {
        header("Location: ./index.php");
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="logos/favicon.ico" type="image/png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <title>
            Video Call with @<?php echo $subjectUsername ?> | FSConnect
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
        <div class="jumbotron">
            <h1 class="display-4">Video Chat with @<?php echo $subjectUsername ?></h1>
            <p class="lead">Simply tell your friend to log onto FSConnect, and join the call using the link below or through the call feature.</p>
            <hr class="my-4">
            <p>It's as simple as that!</p>
            <a class="btn btn-dark btn-lg" onclick="copyURL()" role="button">Copy URL to clipboard</a>
        </div>
        <textarea id="myInput">localhost/fsconnect/calls/<?php echo $username ?>.php</textarea>
        <script>
            function copyURL(link) {
                var copyText = document.getElementById("myInput");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
            }
        </script>
        <script>
                function onVidyoClientLoaded(status) {
                switch (status.state) {
                    case "READY":
                        VC.CreateVidyoConnector({
                            viewId: "renderer",
                            viewStyle: "VIDYO_CONNECTORVIEWSTYLE_Default",
                            remoteParticipants: 8,
                            logFileFilter: "warning info@VidyoClient info@VidyoConnector",
                            logFileName: "",
                            userData: ""
                        }).then(function (vidyoConnector) {
                            /*Handle appearance and disappearance of camera devices in the system*/
                            vidyoConnector.RegisterLocalCameraEventListener({
                            onAdded: function(localCamera) {},
                            onRemoved: function(localCamera) {},
                            onSelected: function(localCamera) {},
                            onStateUpdated: function(localCamera, state) {}
                        }).then(function() {
                            console.log("RegisterLocalCameraEventListener Success");
                        }).catch(function() {
                            console.error("RegisterLocalCameraEventListener Failed");
                        });
                        /*Handle appearance and disappearance of microphone devices in the system*/
                        vidyoConnector.RegisterLocalMicrophoneEventListener({
                            onAdded: function(localMicrophone) {},
                            onRemoved: function(localMicrophone) {},
                            onSelected: function(localMicrophone) {},
                            onStateUpdated: function(localMicrophone, state) {}
                        }).then(function() {
                            console.log("RegisterLocalMicrophoneEventListener Success");
                        }).catch(function() {
                            console.error("RegisterLocalMicrophoneEventListener Failed");
                        });
                        /*Handle appearance and disappearance of speaker devices in the system*/
                        vidyoConnector.RegisterLocalSpeakerEventListener({
                            onAdded: function(localSpeaker) {},
                            onRemoved: function(localSpeaker) {},
                            onSelected: function(localSpeaker) {},
                            onStateUpdated: function(localSpeaker, state) {}
                        }).then(function() {
                            console.log("RegisterLocalSpeakerEventListener Success");
                        }).catch(function() {
                            console.error("RegisterLocalSpeakerEventListener Failed");
                        });
                        vidyoConnector.Connect({
                            host: "prod.vidyo.io",
                            token: 'cHJvdmlzaW9uAHVzZXIxQDcxMjcyNS52aWR5by5pbwA2Mzc3MzY0MTA2MgAAMGY4ZTYxYjJkY2M5NDkxY2NkNGIzNDI0NWFjMzE4Mzg3NWUxYzM1ZTBjYTNhN2ZlMGFkZmI4YWUwMjU1NDhhYzA0YjI0NzUxZTM3ZTYyNTFmMDQ1MzYxODYzZjRlM2Fl', //Generated Token
                            displayName: "<?php echo $displayName; ?>", //User Name
                            resourceId: "demoroom", //Conference Name
                            onSuccess: function () {
                                console.log("Sucessfully connected");
                            },
                            onFailure: function (reason) {
                                console.log("Error while connecting ", reason);
                            },
                            onDisconnected: function (reason) {
                                console.log("Disconnected ", reason);
                            }
                            }).then(function (status) {

                            }).catch(function () {

                            });
                        });
                        break;
                    case "RETRYING":
                        break;
                    case "FAILED":
                        break;
                    case "FAILEDVERSION":
                        break;
                    case "NOTAVAILABLE":
                        break;
                }
                return true;
                }                
        </script>
        <div id="renderer" style="position: absolute; top: 150px; left: 2%; bottom: -23px; z-index: 99; height: 500px; width: 860px;"></div>
        <script src="https://static.vidyo.io/latest/javascript/VidyoClient/VidyoClient.js?onload=onVidyoClientLoaded&webrtc=true&plugin=false"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
</html>