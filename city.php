<?php include "Utility Scripts/pageUtilities.php"; ?>
<?php
    //URL Variables
    $city = urldecode($_GET['city']);
    $backgroundURL = "Resources/Cities/" . $city . "/Background.jpg";
    $backgroundURL = str_replace(" ", "%20", $backgroundURL);
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Title -->
    <title><?= $city;?></title>
    <!-- Head Info -->
    <?php include "Page Items/headInfo.php" ?>

    <!-- Custom Styling Per City -->
    <style type="text/css">
        .backgroundImage {
            background-image: url(<?= $backgroundURL;?>);
        }
    </style>
</head>

<body class="backgroundImage">
<!-- Website Code -->
<div class="container-fluid backgroundImage">
    <!-- Nav Bar -->
    <?php include "Page Items/header.php"; ?>
</div>

<div class="container bodyBackground">
    <!-- Title -->
    <div class="row cityTitle">
        <div class="col-8 col-sm-8 col-md-9 col-lg-9">
            <span class="titleHighlight">Discover </span>
            <?= $city;?>
        </div>
        <div class="col-4 col-sm-4 col-md-3 col-lg-3 text-center">
            <?php
                //Get Temperature
                include "Utility Scripts/requestWeather.php";
            ?>
        </div>
    </div>

    <?php
        $sql = "SELECT `Description` FROM `cities` WHERE Name = \"". $city ."\"";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    ?>
    <span class="cityDescription">
        <?= $row["Description"];?>
    </span>

    <!-- City Separator -->
    <div class="row align-items-center">
        <div class="col-3 col-sm-3 col-md-4 col-lg-5">
            <div class="separatorDash">

            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-4 col-lg-2">
            <div class="citySeparatorText text-center">
                Top Rated Attractions
            </div>
        </div>
        <div class="col-3 col-sm-3 col-md-4 col-lg-5">
            <div class="separatorDash">

            </div>
        </div>
    </div>

    <!-- Top Rated Attractions -->
    <div class="row">
    <?php
        $sql = "SELECT * FROM `attractions` WHERE City = \"" . $city . "\" ORDER BY `Rating` DESC";
        $result = mysqli_query($conn, $sql);

        for ($i = 0; $i < 4; $i++){
            if ($row = mysqli_fetch_assoc($result)){
                //Get Attraction
                include "Utility Scripts/getAttraction.php";
            }
        }
        ?>
    </div>

    <!-- See More Button -->
    <div class="row align-items-center seeAllRow">
        <div class="col-12">
            <?php
                $attractionsLink = "attractions.php?city=" . urlencode($city);
            ?>
            <a class="seeAll" href=<?= $attractionsLink;?>>
                See All
            </a>
        </div>
    </div>

    <!--City Separator -->
    <div class="row align-items-center">
        <div class="col-3 col-sm-3 col-md-4 col-lg-5">
            <div class="separatorDash">

            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-4 col-lg-2">
            <div class="citySeparatorText text-center">
                Gallery
            </div>
        </div>
        <div class="col-3 col-sm-3 col-md-4 col-lg-5">
            <div class="separatorDash">

            </div>
        </div>
    </div>

    <!-- Gallery -->
    <div class="row">
        <?php
            $sql = "SELECT * FROM `cities` WHERE Name = \"". $city ."\"";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $images = glob($row["AlbumAddress"] . "/*.jpg");

            $imageNum = floor(count($images) / 4) * 4;

            for ($i = 0; $i <= $imageNum; $i++) {
                $imageURL = str_replace(" ", "%20", $images[$i]);
                if ($imageURL == $backgroundURL){
                    continue;
                }
                ?>
        <div class="col-12 col-sm-12 col-md-6 col-lg-3">
            <img class="cityGalleryImage" src=<?= str_replace(" ", "%20", $images[$i]);?>>
        </div>
                <?php
            }
        ?>
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
    $conn -> close();
?>
</html>