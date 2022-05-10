<?php include "pageUtilities.php"; ?>
<?php include "formUtilities.php" ?>
<?php
    //Get Review Details
    $reviewID = $_POST["reviewID"];

    //Delete Review
    $sql = "DELETE FROM `userreviews` WHERE `UserReviewID` = " . $reviewID . ";";
    mysqli_query($conn, $sql);

    //Redirect
    header("location:../account.php?state=2");
