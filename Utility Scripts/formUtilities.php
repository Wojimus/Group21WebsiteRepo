<?php
    //Functions to aid in checking form validity

    //Validate whether a chosen password fits the criteria for the website
    function validatePassword($password){
        $valid = true;
        if ((strlen($password) < 8 or strlen($password) > 32)) {
            $valid = false;
        }
        return $valid;
    }

    //Validate whether a chosen username fits the criteria for the website
    function validateUserName($name){
        $valid = true;
        $invalidCharacters = array(" ", "/", "*", "!", "\"", "'", "£", "$", "%", "^", "&", "(", ")", "{", "}", "[", "]", ".", ",", "\\", "/", "#" , "`", "|", "-", "=");
        if ((strlen($name) >= 5 and strlen($name) <= 24)) {
            foreach ($invalidCharacters as $invalidCharacter){
                if (strpos($name, $invalidCharacter) != false){
                    $valid = false;
                }
            }
        }
        else {
            $valid = false;
        }
        return $valid;
    }

    //Validate whether a username already exists in the database
    function checkUserExists($name, $conn){
        //SQL
        $sql = "SELECT Username FROM `users` WHERE `Username` = \"" . $name . "\"";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    //Check whether an input password is correct for the user
    function checkPassword($name, $password, $conn){
        $sql = "SELECT `PasswordHash` FROM `users` WHERE `Username` = \"" . $name . "\"";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $passwordHash = mysqli_fetch_assoc($result)["PasswordHash"];
            return password_verify($password, $passwordHash);
        }
    }

    //Check whether two values are identical
    function checkEqual($value1, $value2){
        if ($value1 == $value2) {
            return true;
        }
        else{
            return false;
        }
    }
?>