<?php include "pageUtilities.php"; ?>
<?php include "formUtilities.php" ?>
<?php
    //Get User Details
    $name = $_POST["userName"];
    $password = $_POST["password"];

    //Form Check
    //If the user does not exist
    if (!checkUserExists($name, $conn)){
        header("location:../login.php?errorCode=1");
    }
    //If the users password is incorrect
    else if (!checkPassword($name, $password, $conn)) {
        header("location:../login.php?errorCode=2");
    }
    else{
        //Set Session User
        $_SESSION["name"] = $name;

        //Redirect
        header("location:../index.php");
    }
?>