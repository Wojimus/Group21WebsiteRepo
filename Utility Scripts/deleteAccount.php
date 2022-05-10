<?php include "pageUtilities.php"; ?>
<?php include "formUtilities.php" ?>
<?php
    //Get User Details
    $name = $_SESSION["name"];
    $confirmedPassword = $_POST["confirmedPassword"];

    //Form Check
    //If the password is incorrect
    if (!checkPassword($name, $confirmedPassword, $conn)){
        header("location:../account.php?state=4&errorCode=1");
    }
    else {
        //Delete User
        $sql = "DELETE FROM `users` WHERE `Username` = \"" . $_SESSION["name"] . "\"";
        mysqli_query($conn, $sql);

        //Destroy the session
        session_destroy();

        //Redirect
        header("location:../index.php");
    }
?>