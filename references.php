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
</div>

<div class="container bodyBackground">
    <!--Title -->
    <div class="row align-items-center pageTitle">
        <div class="col-12">
            <span class="titleHighlight">References </span>
            And Other Info
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
                How Explore UK Was Made
            </div>
        </div>
        <div class="col-4 col-sm-4 col-md-5 col-lg-5">
            <div class="separatorDash">

            </div>
        </div>
    </div>

    <!-- How Explore UK Was Made -->
    <div class="row">
        <div class="col-12">
            <span class="referencesSubTitle">
                Data
            </span>
            <br>
            <span>
                <b>ExploreUK</b> was made by Wojciech Marek using a combination of php and python.
                All data used in Explore UK was taken from
                <a href="https://en.wikipedia.org/wiki" class="contentLink">Wikipedia</a> and
                <a href="https://www.tripadvisor.co.uk/" class="contentLink">Trip Advisor</a>.
            </span>
            <br>
            <br>
            <span class="referencesSubTitle">
                Database Creation
            </span>
            <br>
            <div class="row">
                <a class="col-4 referenceImageContainer" href="Resources/References/ScraperCode.jpg">
                    <img src="Resources/References/ScraperCode.jpg" class="referenceImage">
                </a>
                <a class="col-4 referenceImageContainer" href="Resources/References/Database.jpg">
                    <img src="Resources/References/Database.jpg" class="referenceImage">
                </a>
                <a class="col-4 referenceImageContainer" href="Resources/References/CityDatabase.jpg">
                    <img src="Resources/References/CityDatabase.jpg" class="referenceImage">
                </a>
            </div>
            <br>
            <span>
                To create the extensive <b>ExploreUK</b> database a python webscraper was created specifically to crawl tripadvisor and create a database of attractions for every city in the UK.
                This webscraper was created using the scrapy framework and allowed me to create a database of over <b>ten thousand</b> attractions.
                <br>
                <b>ExploreUK</b> consists of 4 relational tables 2 of which are editable by the user. the attractions and cities database were left unmodifiable due to their creation being controlled by a separate program,
                Potential functionality would be to create an admin side of the site to allow creation and deletion of cities/attractions however <b>ExploreUK</b> is a customer facing product and I chose to assume the content tables would be edited by an intra company tool which was not web facing.
                <br>
            </span>
            <br>
        </div>
    </div>
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