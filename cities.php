<?php include "Utility Scripts/pageUtilities.php"; ?>
<!doctype html>
<html lang="en">
<head>
    <!-- Title -->
    <title>Cities</title>
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
            <span class="titleHighlight">Discover </span>
            The Uk's Cities
        </div>
    </div>

    <!-- Body Content -->
    <div class="row">
        <?php
            $sql = "SELECT * FROM `cities`";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $thumbnail = str_replace(" ", "%20", $row["AlbumAddress"]) . "/Background.jpg";
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
        ?>
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

<?php
    //Close Database Connection
    $conn -> close();
?>
</html>