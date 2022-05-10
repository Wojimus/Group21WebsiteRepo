<?php
    //Check if Utility Script
    basename(getcwd()) == "Utility Scripts" ? $isUtility = true : $isUtility = false;
    //Credentials
    $isUtility ? $credentials = parse_ini_file("../ExploreUKCredentials.ini"):
        $credentials = parse_ini_file("ExploreUKCredentials.ini");
    //Variables
    $servername = $credentials["servername"];
    $username = $credentials["username"];
    $password = $credentials["password"];
    $dbname = $credentials["dbname"];
    $apiKey = $credentials["openweatherkey"];

    //Create Database Connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    //Check for success
    if (mysqli_connect_errno()) {
        die("Connection Failed: " . mysqli_connect_error());
    }

    //Start Session
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }

    //Generate Rating
    function generateRating($review){
        $fullStars = floor($review["UserRating"]);
        $halfStar = false;
        if (($review["UserRating"] * 10) % 10 == 5){
            $halfStar = true;
        }
        for ($i = 0; $i < $fullStars; $i++){
            ?>
            <img class="starIcon" src="Resources/Icons/StarSharp.png">
            <?php
        }
        if ($halfStar) {
            ?>
            <img class="starIcon" src="Resources/Icons/StarHalfSharp.png">
            <?php
        }
    }
?>