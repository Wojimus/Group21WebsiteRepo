<?php include "pageUtilities.php"; ?>
<?php include "formUtilities.php" ?>
<?php
    //Get User Details
    $name = $_POST["userName"];
    $password = $_POST["password"];
    $confirmedPassword = $_POST["confirmedPassword"];

    //Form Checking
    //If the username does not fit the criteria
    if (!validateUserName($name)){
        header("location:../register.php?errorCode=1");
    }
    //If the username already exists
    else if (checkUserExists($name, $conn)) {
        header("location:../register.php?errorCode=2");
    }
    //If the password does not fit the criteria
    else if (!validatePassword($password)){
        header("location:../register.php?errorCode=3");
    }
    //If the password and confirm password fields do not match
    else if (!checkEqual($password, $confirmedPassword)){
        header("location:../register.php?errorCode=4");
    }
    else {
        //Password Hash
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        //Create User
        $sql = "INSERT INTO `users` (`UserID`, `Username`, `PasswordHash`, `DateCreated`) VALUES (NULL, \"" . $name . "\", \"" . $passwordHash . "\", CURRENT_DATE());";
        mysqli_query($conn, $sql);

        //Set Session User
        $_SESSION["name"] = $name;

        //Redirect
        header("location:../index.php");
    }
?>