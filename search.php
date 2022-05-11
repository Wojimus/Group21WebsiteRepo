<?php include "Utility Scripts/pageUtilities.php"; ?>
<?php
    //Get Search Query
    $searchQuery = $_POST["searchQuery"];

    //Get City Search Results
    $sql = "SELECT * FROM `cities` WHERE Name LIKE \"" . $searchQuery . "%\"";
    $citySearchResult = mysqli_query($conn, $sql);

    $cityResultsFound = false;
    if (mysqli_num_rows($citySearchResult) > 0) {
        $cityResultsFound = true;
    }

    //Get Attraction Search Results
    $sql = "SELECT * FROM `attractions` WHERE Name LIKE \"" . $searchQuery . "%\" OR Name Like \"%" . $searchQuery . "%\" ORDER BY `Rating` DESC";
    $attractionSearchResult = mysqli_query($conn, $sql);

    $attractionResultsFound = false;
    if (mysqli_num_rows($attractionSearchResult) > 0) {
        $attractionResultsFound = true;
    }
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Title -->
    <title>Search</title>
    <!-- Head Info -->
    <?php include "Page Items/headInfo.php" ?>
</head>

<body class="blurredBackgroundImage">
<!-- Website Code -->
<div class="container-fluid backgroundImage">
    <!-- Nav Bar -->
    <?php include "Page Items/header.php"; ?>
</div>

<div class="container">
    <div class="row separator">
    </div>
</div>

<div class="container bodyBackground">
    <!--Title -->
    <div class="row align-items-center pageTitle">
        <div class="col-12">
            <span class="pageTitle">Search Results</span>
        </div>
    </div>

    <!-- Body Content -->
    <div class="row">
        <div class="col-12 searchBarContainer">
            <form class="text-center" action="search.php" method="post">
                <br>
                <input type="text" placeholder="Where to?" class="SearchBar" name="searchQuery" autocomplete="off">
                <button type="submit" class="SearchButton">Discover</button>
            </form>
        </div>
    </div>

    <?php
        if ($cityResultsFound and $attractionResultsFound){
            ?>

            <!-- Cities -->
            <?php
            if ($cityResultsFound) {
                ?>
                <!--Separator -->
                <div class="row align-items-center">
                    <div class="col-4 col-sm-4 col-md-5 col-lg-5">
                        <div class="separatorDash">

                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2">
                        <div class="separatorText text-center">
                            Explore Cities
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-5 col-lg-5">
                        <div class="separatorDash">

                        </div>
                    </div>
                </div>
                <div class="row">
                <?php
                while ($row = mysqli_fetch_assoc($citySearchResult)) {
                    $thumbnail = str_replace(" ", "%20", $s3bucketlinkprefix . $row["AlbumAddress"]) . "/Background.jpg";
                    $cityURL = "city.php?city=" . urlencode($row["Name"]);
                    ?>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                        <a href=<?= $cityURL;?>>
                            <div class="cityButton">
                                <img src=<?= $thumbnail;?> class="cityImage">
                                <div class="cityImageText">
                                    <?= $row["Name"];?>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            }
            else {
                ?>
                <div class="row">
                    <div class="col-12 text-center">
                        <span class="searchSubHeading">
                            <br>
                            Woops! looks like we don't have anything that matches that search
                            <br>
                        </span>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>

            <!-- Attractions -->
            <?php
            if ($attractionResultsFound) {
                $attractionCounter = 0;
                ?>
                <!--Separator -->
                <div class="row align-items-center">
                    <div class="col-4 col-sm-4 col-md-5 col-lg-5">
                        <div class="separatorDash">

                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2">
                        <div class="separatorText text-center">
                            Explore Attractions
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-5 col-lg-5">
                        <div class="separatorDash">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php

                        //Display Attractions
                        while ($row = mysqli_fetch_assoc($attractionSearchResult) and $attractionCounter < 40) {
                            $attractionCounter++;
                            //Create attraction link
                            $attractionLink = "attraction.php?attractionID=" . $row["AttractionID"];
                            //Get Image
                            $imageDir = __DIR__ . "/" . $row["AlbumAddress"] . "/";
                            $thumbnail = s3Glob($s3bucket, $s3bucketlinkprefix, $row["AlbumAddress"]);
                            if (count($thumbnail) == 0) {
                                $thumbnail = $s3bucketlinkprefix . "Resources/Icons/DefaultThumbnail.jpg";
                            }
                            else {
                                $thumbnail = $thumbnail[0];
                            }
                            ?>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                <a class="cityAttractionLink" href=<?= $attractionLink;?>>
                                    <div class="cityAttraction">
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-md-5 col-lg-5 col-xl-4">
                                                <img src=<?= $thumbnail;?> class="cityAttractionImage">
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-7 col-lg-7 col-xl-8">
                        <span class="cityAttractionTitle">
                            <?= $row["Name"];?>
                        </span>
                                                <br>
                                                <span class="cityAttractionBlurb">
                            <?= $row["Description"];?>
                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php

                        }
                    ?>
                </div>
                <?php
            }
        }
        else {
            ?>
            <div class="row">
                <div class="col-12 text-center">
            <span class="searchSubHeading">
                <br>
                Woops! looks like we don't have anything that matches that search
                <br>
            </span>
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

<?php
    //Close Database Connection
    $conn -> close();
?>
</html>