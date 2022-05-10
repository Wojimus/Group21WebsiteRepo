<!--
ExploreUK

ExploreUK was created by Wojciech Marek,
-->

<?php include "Utility Scripts/pageUtilities.php"; ?>
<!doctype html>
<html lang="en">
<head>
    <!-- Title -->
    <title>ExploreUK</title>
    <!-- Head Info -->
    <?php include "Page Items/headInfo.php" ?>
</head>

<body class="blurredBackgroundImage">
<div class="container-fluid backgroundImage">
    <!-- Nav Bar -->
    <?php include "Page Items/header.php"; ?>

    <!-- Home Search -->
    <div class="row align-items-center homeSearchContainer">
        <div class="col-12">
            <form class="text-center" action="search.php" method="post">
                <input type="text" placeholder="Where to?" class="homeSearchBar" name="searchQuery" autocomplete="off">
                <button type="submit" class="homeSearchButton">Discover</button>
            </form>
        </div>
    </div>
</div>

<!-- Full Width Separator -->
<div class="container-fluid">
    <div class="row separator">
    </div>
</div>

<div class="container-fluid cityGalleryContainer">
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

    <!-- Pre-determined City Gallery -->
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
            <a href="city.php?city=London">
                <div class="cityButton">
                    <img src="Resources/Cities/London/Background.jpg" class="cityImage">
                    <div class="cityImageText">
                        London
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
            <a href="city.php?city=Birmingham">
                <div class="cityButton">
                    <img src="Resources/Cities/Birmingham/Background.jpg" class="cityImage">
                    <div class="cityImageText">
                        Birmingham
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
            <a href="city.php?city=Edinburgh">
                <div class="cityButton">
                    <img src="Resources/Cities/Edinburgh/Background.jpg" class="cityImage">
                    <div class="cityImageText">
                        Edinburgh
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
            <a href="city.php?city=Cardiff">
                <div class="cityButton">
                    <img src="Resources/Cities/Cardiff/Background.jpg" class="cityImage">
                    <div class="cityImageText">
                        Cardiff
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
            <a href="city.php?city=Glasgow">
                <div class="cityButton">
                    <img src="Resources/Cities/Glasgow/Background.jpg" class="cityImage">
                    <div class="cityImageText">
                        Glasgow
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
            <a href="city.php?city=Manchester">
                <div class="cityButton">
                    <img src="Resources/Cities/Manchester/Background.jpg" class="cityImage">
                    <div class="cityImageText">
                        Manchester
                    </div>
                </div>
            </a>
        </div>
    </div>
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