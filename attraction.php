<?php include "Utility Scripts/pageUtilities.php"; ?>
<?php
    //URL Variables
    $attractionID = urldecode($_GET['attractionID']);

    //Get Attraction
    $sql = "SELECT * FROM `attractions` WHERE `AttractionID` = " . $attractionID;
    $result = mysqli_query($conn, $sql);
    $attraction = mysqli_fetch_assoc($result);

    //Errors
    $errorCode = null;
    if (isset($_GET["errorCode"])){
        $errorCode = $_GET["errorCode"];
    }
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Title -->
    <title><?= $attraction["Name"]; ?></title>
    <!-- Head Info -->
    <?php include "Page Items/headInfo.php" ?>
</head>

<body class="backgroundImage">
<!-- Website Code -->
<div class="container-fluid backgroundImage">
    <!-- Nav Bar -->
    <?php include "Page Items/header.php"; ?>
</div>

<div class="container bodyBackground">
    <!--Title-->
    <div class="row attractionTitle">
        <?php
            $thumbnail = s3Glob($s3bucket, $s3bucketlinkprefix, $attraction["AlbumAddress"]);
            if (count($thumbnail) == 0) {
                $thumbnail = $s3bucketlinkprefix . "Resources/Icons/DefaultThumbnail.jpg";
            } else {
                $thumbnail = $thumbnail[0];
            }
        ?>
        <div class="col-12 col-xl-6">
            <?= $attraction["Name"]; ?>
            <br>
            <?php
                $fullStars = floor($attraction["Rating"]);
                $halfStar = false;
                if (($attraction["Rating"] * 10) % 10 == 5) {
                    $halfStar = true;
                }
                for ($i = 0; $i < $fullStars; $i++) {
                    ?>
                    <img class="starIcon" src= <?php $s3bucketlinkprefix . "Resources/Icons/StarSharp.png" ?>>
                    <?php
                }
                if ($halfStar) {
                    ?>
                    <img class="starIcon" src=<?php $s3bucketlinkprefix . "Resources/Icons/StarHalfSharp.png" ?>>
                    <?php
                }
            ?>
            <div class="row">
                <div class="col-12 attractionDescription">
                    <span>
                        <?= $attraction["Description"]; ?>
                    </span>
                    <br>
                    <br>
                    <span class="attractionPrice">
                        <?php
                            $price = $attraction["Price"];
                            if ($price == -1) {
                                $price = "Price on request";
                            } else {
                                $price = "£" . $price;
                            }
                            echo $price;
                        ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 attractionImageContainer text-center">
            <img class="attractionImage" src=<?= $thumbnail ?>>
        </div>
    </div>

    <!--Separator -->
    <div class="row align-items-center">
        <div class="col-4 col-sm-4 col-md-5 col-lg-5">
            <div class="separatorDash">

            </div>
        </div>
        <div class="col-4 col-sm-4 col-md-2 col-lg-2">
            <div class="separatorText text-center">
                Details
            </div>
        </div>
        <div class="col-4 col-sm-4 col-md-5 col-lg-5">
            <div class="separatorDash">

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 attractionDetails">
            <span class="attractionSubTitle">
                Address:
            </span>
            <?= $attraction["Address"]; ?>
            <br>
            <br>
            <span class="attractionSubTitle">
                Contact Number:
            </span>
            <?= $attraction["ContactNumber"]; ?>
            <br>
            <br>
            <span class="attractionSubTitle">
                Contact Email:
            </span>
            <?= $attraction["ContactEmail"]; ?>
            <br>
        </div>
        <?php
            $images = s3Glob($s3bucket, $s3bucketlinkprefix, $attraction["AlbumAddress"]);

            $imageNum = floor(count($images) / 4) * 4;

            $imageNum = 0;
            if (count($images) > 2) {
                $imageNum = 2;
            } else {
                $imageNum = count($images);
            }

            for ($i = 0; $i < $imageNum; $i++) {
                $imageURL = str_replace(" ", "%20", $images[$i]);
                if ($imageURL == $thumbnail) {
                    continue;
                }
                ?>
                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <img class="cityGalleryImage" src=<?= str_replace(" ", "%20", $images[$i]); ?>>
                </div>
                <?php
            }
        ?>
    </div>

    <!--Separator -->
    <div class="row align-items-center">
        <div class="col-4 col-sm-4 col-md-5 col-lg-5">
            <div class="separatorDash">

            </div>
        </div>
        <div class="col-4 col-sm-4 col-md-2 col-lg-2">
            <div class="separatorText text-center">
                Reviews
            </div>
        </div>
        <div class="col-4 col-sm-4 col-md-5 col-lg-5">
            <div class="separatorDash">

            </div>
        </div>
    </div>
    <!-- Write a review -->
    <div class="row">
        <div class="col-12">
            <span class="reviewTitle">
                Write a review
            </span>
        </div>
    </div>
    <form class="row" action="Utility%20Scripts/createReview.php" method="post">
        <input type="hidden" name="attractionID" value=<?= $attraction["AttractionID"]; ?>>
        <div class="col-12">
            <div class="row">
                <! -- 0.5 -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <input type="radio" id="0.5" name="starRating" value="0.5">
                    <label for="0.5">
                        <img class="starIcon" src="Resources/Icons/StarHalfSharp.png">
                    </label><br>
                </div>
                <! -- 1.0 -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <input type="radio" id="1" name="starRating" value="1">
                    <label for="1">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                    </label><br>
                </div>
            </div>
            <div class="row">
                <! -- 1.5 -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <input type="radio" id="1.5" name="starRating" value="1.5">
                    <label for="1.5">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarHalfSharp.png">
                    </label><br>
                </div>
                <! -- 2.0 -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <input type="radio" id="2" name="starRating" value="2">
                    <label for="2">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                    </label><br>
                </div>
            </div>
            <div class="row">
                <! -- 2.5 -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <input type="radio" id="2.5" name="starRating" value="2.5">
                    <label for="2.5">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarHalfSharp.png">
                    </label><br>
                </div>
                <! -- 3.0 -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <input type="radio" id="3" name="starRating" value="3">
                    <label for="3">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                    </label><br>
                </div>
            </div>
            <div class="row">
                <! -- 3.5 -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <input type="radio" id="3.5" name="starRating" value="3.5">
                    <label for="3.5">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarHalfSharp.png">
                    </label><br>
                </div>
                <! -- 4.0 -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <input type="radio" id="4" name="starRating" value="4">
                    <label for="4">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                    </label><br>
                </div>
            </div>
            <div class="row">
                <! -- 4.5 -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <input type="radio" id="4.5" name="starRating" value="4.5">
                    <label for="4.5">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarHalfSharp.png">
                    </label><br>
                </div>
                <! -- 5.0 -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2c">
                    <input type="radio" id="5" name="starRating" value="5" checked="checked">
                    <label for="5">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                        <img class="starIcon" src="Resources/Icons/StarSharp.png">
                    </label><br>
                </div>
            </div>
        </div>
        <div class="col-12">
            <textarea class="reviewInput" name="reviewText">Write your review here</textarea>
        </div>
        <?php
            if ($errorCode == 1){
                ?>
                    <div class="col-12">
                        <span class="loginError">
                            Invalid Review
                        </span>
                    </div>
                <?php
            }
        ?>
        <button class="col-9 col-sm-9 col-md-6 col-lg-3 reviewButton">
            Submit
        </button>
    </form>


    <!-- Reviews -->
    <?php
        //Find Reviews
        $sql = "SELECT * FROM `userreviews` WHERE `AttractionID` = \"" . $attraction["AttractionID"] . "\"";
        $reviewsResult = mysqli_query($conn, $sql);
        if (mysqli_num_rows($reviewsResult) > 0) {
            while ($review = mysqli_fetch_assoc($reviewsResult)) {
                //Get Attraction Data
                $sql = "SELECT * FROM `attractions` WHERE AttractionID = \"" . $review["AttractionID"] . "\"";
                $attraction = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                $sql = "Select * FROM `users` WHERE `UserID` = \"" . $review["UserID"] . "\"";
                $user = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                ?>
                <!-- Attraction Review -->
                <div class="row attractionReview">
                    <div class="col-12">
                        <div class="row reviewContainer">
                            <div class="col-12">
                                <span class="reviewTitle">
                                    <?= $user["Username"] ?>
                                </span>
                            </div>
                            <span class="col-12 reviewTitle">
                                <span class="titleHighlight">
                                    Created:
                                </span>
                                <?= $review["DateCreated"];?>
                            </span>
                            <div class="col-12">
                                <?php
                                    //Draw Rating
                                    generateRating($review);
                                    ?>
                            </div>
                            <div class="col-12 reviewBlurbContainer">
                                <span class="reviewBlurb">
                                    <?= $review["UserReview"] ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
            }
        }
    ?>
</div>

<!-- Footer -->
<div class="container-fluid footerContainer">
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

<?php
    //Close Database Connection
    $conn->close();
?>
</html>