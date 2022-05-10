<?php include "pageUtilities.php"; ?>
<?php include "formUtilities.php" ?>
<?php
    //Get Review Details
    $attractionID = $_POST["attractionID"];
    $reviewText = $_POST["reviewText"];
    $starRating = $_POST["starRating"];

    //Form Checking
    if ($reviewText == "" or $reviewText == "Write your review here"){
        //Redirect
        header("location:../attraction.php?attractionID=" . $attractionID . "&errorCode=1");
    }
    else {
        //Get User
        $sql = "SELECT * FROM `users` WHERE `userName` = \"" . $_SESSION["name"] . "\"";
        $user = mysqli_fetch_assoc(mysqli_query($conn, $sql));

        //Create Review User
        $sql = "INSERT INTO `userreviews` (`UserReviewID`, `UserID`, `AttractionID`, `UserRating`, `UserReview`, `DateCreated`) VALUES (NULL, '" . $user["UserID"] . "', '" . $attractionID . "', '" . $starRating . "', '" . $reviewText . "', CURRENT_DATE())";
        mysqli_query($conn, $sql);

        //Redirect
        header("location:../attraction.php?attractionID=" . $attractionID);
    }