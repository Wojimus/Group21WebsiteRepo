<?php include "pageUtilities.php"; ?>
<?php include "formUtilities.php" ?>
<?php
    //Get Details
    $name = $_SESSION["name"];
    $currentPassword = $_POST["currentPassword"];
    $newPassword = $_POST["newPassword"];

    //Form Checking
    //If password incorrect
    if (!checkPassword($name, $currentPassword, $conn)){
        header("location:../account.php?state=5&errorCode=1");
    }
    //If the password does not fit the criteria
    else if (!validatePassword($newPassword)){
        header("location:../account.php?state=5&errorCode=2");
    }
    //if both password fields are equal
    else if (checkEqual($currentPassword, $newPassword)){
        header("location:../account.php?state=5&errorCode=3");
    }
    else {
        //Generate new password hash
        $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);

        //SQL
        $sql = "UPDATE `users` SET `PasswordHash` = \"" . $passwordHash . "\" WHERE `userName` = \"" . $name . "\"";
        mysqli_query($conn, $sql);

        //Redirect
        header("location:../account.php?state=6");
    }
?>