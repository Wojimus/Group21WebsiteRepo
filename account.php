<?php include "Utility Scripts/pageUtilities.php"; ?>
<?php
    if (!isset($_SESSION["name"])){
        header("location:login.php");
    }
    $state = 1;
    if (isset($_GET["state"])){
        $state = $_GET["state"];
    }

    //Errors
    $errorCode = null;
    if (isset($_GET["errorCode"])){
        $errorCode = $_GET["errorCode"];
    }

    //Get User Data
    $sql = "SELECT * FROM `users` WHERE Username = \"" . $_SESSION["name"] . "\"";
    $user = mysqli_fetch_assoc(mysqli_query($conn, $sql));
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Title -->
    <title>Account</title>
    <!-- Head Info -->
    <?php include "Page Items/headInfo.php" ?>
</head>

<body class="blurredBackgroundImage">
<!-- Website Code -->
<div class="container-fluid backgroundImage">
    <!-- Nav Bar -->
    <?php include "Page Items/header.php"; ?>
</div>

<div class="container bodyBackground">
    <!-- Account Header -->
    <div class="row align-items-center">
        <?php
            $detailsClass = "col-4 accountHeader text-center";
            $reviewClass = "col-4 accountHeader text-center";
            $otherClass = "col-4 accountHeader text-center";

            switch ($state){
                case 1: $detailsClass = "col-4 accountHeaderActive text-center"; break;
                case 2: $reviewClass = "col-4 accountHeaderActive text-center"; break;
                case 3: $otherClass = "col-4 accountHeaderActive text-center"; break;
            }
        ?>
        <a class=<?= "\"" . $detailsClass . "\""?> href="account.php?state=1">
            Details
        </a>
        <a class=<?= "\"" . $reviewClass . "\""?> href="account.php?state=2">
            Reviews
        </a>
        <a class=<?= "\"" . $otherClass . "\""?> href="account.php?state=3">
            Other
        </a>
    </div>

    <!-- State 1 - Account Info -->
    <?php
        if ($state == 1) {
            ?>
            <div class="row">
                <div class="col-12">
                    <span class="accountTitle">
                        <span class="titleHighlight">
                            Account
                        </span>
                        Details
                    </span>
                </div>
                <div class="col-12 accountDetails">
                    <span class="accountSubTitle">
                        Username:
                        <span class="accountInfo">
                            <?= $_SESSION["name"]; ?>
                        </span>
                    </span>
                </div>
                <div class="col-12 accountDetails">
                    <span class="accountSubTitle">
                        Member Since:
                        <span class="accountInfo">
                            <?= $user["DateCreated"]; ?>
                        </span>
                    </span>
                </div>
                <div class="col-12 accountDetails" action="account.php?state=5">
                    <a class="logoutLink" href="account.php?state=5">
                        Change Password
                    </a>
                </div>
            </div>
            <?php
        }
    ?>

    <!-- State 2 - Reviews -->
    <?php
        if ($state == 2) {
            ?>
            <div class="row">
            <div class="col-12">
                    <span class="accountTitle">
                        <span class="titleHighlight">
                            Reviews
                        </span>
                    </span>
            </div>
            <?php
            //Find Reviews
            $sql = "SELECT * FROM `userreviews` WHERE `UserID` = \"" . $user["UserID"]. "\"";
            $reviewsResult = mysqli_query($conn, $sql);
            if (mysqli_num_rows($reviewsResult) > 0) {
                while ($review = mysqli_fetch_assoc($reviewsResult)) {
                    //Get Attraction Data
                    $sql = "SELECT * FROM `attractions` WHERE AttractionID = \"" . $review["AttractionID"]. "\"";
                    $attraction = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                    //Create attraction link
                    $attractionLink = "attraction.php?attractionID=" . $attraction["AttractionID"];
                    //Get Image
                    $imageDir = __DIR__ . "/" . $attraction["AlbumAddress"] . "/";
                    $thumbnail = glob($attraction["AlbumAddress"] . "/Thumbnail.jpg");
                    if (count($thumbnail) == 0) {
                        $thumbnail = "Resources/Icons/DefaultThumbnail.jpg";
                    }
                    else {
                        $thumbnail = $thumbnail[0];
                    }
                    ?>
                    <div class="col-12">
                        <a class="cityAttractionLink" href=<?= $attractionLink;?>>
                            <div class="reviewContainer">
                                <div class="row">
                                    <div class="col-6 col-sm-6 col-md-5 col-lg-5 col-xl-4">
                                        <img src=<?= $thumbnail;?> class="reviewImage">
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-7 col-lg-7 col-xl-8">
                                        <span class="cityAttractionTitle">
                                            <?= $attraction["Name"];?>
                                        </span>
                                        <br>
                                        <span class="cityAttractionTitle">
                                            <span class="titleHighlight">
                                                Created:
                                            </span>
                                            <?= $review["DateCreated"];?>
                                        </span>
                                        <br>
                                        <span class="cityAttractionTitle">
                                            <?php
                                                //Draw Rating
                                                generateRating($review);
                                            ?>
                                        </span>
                                    </div>
                                </div>
                                <!--Separator -->
                                <div class="row align-items-center reviewSeperator">
                                    <div class="col-4 col-sm-4 col-md-5 col-lg-5">
                                        <div class="separatorDash">

                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-4 col-md-2 col-lg-2">
                                        <div class="separatorText text-center">
                                            Your Review
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-4 col-md-5 col-lg-5">
                                        <div class="separatorDash">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="reviewBlurbContainer">
                                        <div class="col-12 reviewBlurb">
                                            "<?= $review["UserReview"]; ?>"
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <form class="col-12" action="Utility%20Scripts/deleteReview.php" method="post">
                        <input type="hidden" name="reviewID" value=<?= $review["UserReviewID"] ?>>
                        <button class="deleteReviewButton">
                            Delete Review
                        </button>
                    </form>
                    <?php
                }
            }
            ?>
            </div>
            <?php
        }
    ?>

    <!-- State 3 - Other Options -->
    <?php
        if ($state == 3) {
            ?>
            <div class="row">
                <div class="col-12">
                    <span class="accountTitle">
                        <span class="titleHighlight">
                            Other
                        </span>
                        Options
                    </span>
                </div>
                <div class="col-12 accountLinks">
                    <a class="logoutLink" href="Utility Scripts/logout.php">
                        Log Out?
                    </a>
                    <br>
                    <a class="logoutLink" href="account.php?state=4">
                        Want to delete your account?
                    </a>
                </div>
            </div>
            <?php
        }
    ?>

    <!-- State 4 - Delete Account -->
    <?php
        if ($state == 4) {
            ?>
            <div class="row align-items-center">
                <div class="col-12 pageTitle text-center">
                    We're sorry to see you go!
                </div>
                <form class="col-12 deleteForm" action="Utility Scripts/deleteAccount.php" method="post">
                    <span class="loginHeading">
                        Please confirm your password to proceed
                    </span>
                    <br>
                    <input type="password" class="loginInput" name="confirmedPassword">
                    <?php
                        if ($errorCode == 1){
                            ?>
                            <span class="loginError">
                                Incorrect password
                            </span>
                            <?php
                        }
                    ?>
                    <br>
                    <div class="text-center">
                        <button class="deleteButton" type="submit">
                            Delete Account
                        </button>
                    </div>
                </form>
            </div>
            <?php
        }
    ?>

    <!-- State 5 - Change Password -->
    <?php
        if ($state == 5) {
            ?>
            <div class="row align-items-center">
                <div class="col-12 pageTitle text-center">
                    We just need a couple details
                </div>
                <form class="col-12 deleteForm" action="Utility Scripts/changePassword.php" method="post">
                    <span class="loginHeading">
                        Please confirm your current password
                    </span>
                    <br>
                    <input type="password" class="loginInput" name="currentPassword">
                    <?php
                        if ($errorCode == 1){
                            ?>
                            <span class="loginError">
                                Incorrect password
                            </span>
                            <?php
                        }
                    ?>
                    <br>
                    <span class="loginHeading">
                        New Password
                    </span>
                    <br>
                    <input type="password" class="loginInput" name="newPassword">
                    <?php
                        if ($errorCode == 2){
                            ?>
                            <span class="loginError">
                                Invalid Password - Password must be 8-32 characters
                            </span>
                            <?php
                        }
                        else if ($errorCode == 3){
                            ?>
                            <span class="loginError">
                                New password cannot be the same as the old password
                            </span>
                            <?php
                        }
                    ?>
                    <div class="text-center">
                        <button class="deleteButton" type="submit">
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
            <?php
        }
    ?>

    <!-- State 6 - Confirmation Screen -->
    <?php
        if ($state == 6) {
            ?>
            <div class="row align-items-center">
                <div class="col-12 pageTitle text-center">
                    Your details have been saved
                </div>
            </div>
            <?php
        }
    ?>
</div>

<!-- Footer -->
<div class="container footerContainer">
    <?php include "Page Items/footer.php"; ?>
</div>

<!-- BootStrap Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
</body>
