<?php include "Utility Scripts/pageUtilities.php"; ?>
<?php
    //Constants
    $ATTRACTIONS_PER_PAGE = 20;

    //Get City
    isset($_GET["city"]) ? $city = urldecode($_GET["city"]) : $city = null;

    //Get Search Query
    isset($_POST["searchQuery"]) ? $searchQuery = $_POST["searchQuery"] :
        (isset($_GET["searchQuery"]) ? $searchQuery = urldecode($_GET["searchQuery"]) : $searchQuery = null);

    //Get Page
    $page = 1;
    if (isset($_GET["page"])){
        $page = $_GET["page"];
    }
    $offset = $ATTRACTIONS_PER_PAGE * $page;

    //Get Attraction Search Results
    $sql = "";
    $unlimitedSQL = "";
    if ($city != null){
        $sql = "SELECT * FROM `attractions` WHERE City = \"" . $city . "\" ORDER BY `Rating` DESC LIMIT 100000 OFFSET " . $offset;
        $unlimitedSQL = "SELECT * FROM `attractions` WHERE City = \"" . $city . "\" ORDER BY `Rating` DESC";
    }
    else if ($searchQuery == null){
        $sql = "SELECT * FROM `attractions` ORDER BY `Rating` DESC LIMIT 100000 OFFSET " . $offset;
        $unlimitedSQL = "SELECT * FROM `attractions` ORDER BY `Rating` DESC";
    }
    else{
        $sql = "SELECT * FROM `attractions` WHERE Name LIKE \"" . $searchQuery . "%\" OR Name Like \"%" . $searchQuery . "%\" OR `city` LIKE \"%" . $searchQuery . "%\" ORDER BY `Rating` DESC LIMIT 100000 OFFSET " . $offset;
        $unlimitedSQL = "SELECT * FROM `attractions` WHERE Name LIKE \"" . $searchQuery . "%\" OR Name Like \"%" . $searchQuery . "%\" OR `city` LIKE \"%" . $searchQuery . "%\"  ORDER BY `Rating` DESC";
    }
    $attractionSearchResult = mysqli_query($conn, $sql);

    $attractionResultsFound = false;
    if (mysqli_num_rows($attractionSearchResult) > 0) {
        $attractionResultsFound = true;
    }

    //Calculate number of pages
    $fullResult = mysqli_query($conn, $unlimitedSQL);
    $pages = floor(mysqli_num_rows($fullResult) / 20);
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Title -->
    <title>Attractions</title>
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
    <!--Title -->
    <div class="row align-items-center pageTitle">
        <div class="col-12">
            <span class="titleHighlight">Discover </span>
            The Uk's Top Attractions
        </div>
    </div>
    <div class="row">
        <div class="col-12 searchBarContainer">
            <form class="text-center" action="attractions.php" method="post">
                <br>
                <input type="text" placeholder="Where to?" class="SearchBar" name="searchQuery" autocomplete="off">
                <button type="submit" class="SearchButton">Discover</button>
            </form>
        </div>
    </div>

    <!-- Body Content -->
    <?php
        if ($attractionResultsFound) {
            ?>
            <div class="row">
            <?php
            $attractionCounter = 0;
            while ($row = mysqli_fetch_assoc($attractionSearchResult) and $attractionCounter < 20){
                $attractionCounter++;
                //Get Attraction
                include "Utility Scripts/getAttraction.php";
            }
            ?>
            </div>
            <!-- Page Navigation -->
            <div class="row align-items-center  navigationRow">
                <?php
                ?>
                <div class="col-3 text-left navigationItemContainer">
                    <?php
                        $nextPage = 1;
                        $navigationLink = "attractions.php?page=" . $nextPage;
                        if ($city != null){
                            $navigationLink = $navigationLink . "&city=" . urlencode($city);
                        }
                        else {
                            $navigationLink = $navigationLink . "&searchQuery=" . urlencode($searchQuery);
                        }
                    ?>
                    <a class="navigationItem" href=<?= $navigationLink ?>>
                        <<<
                    </a>
                </div>
                <div class="col-3 text-center navigationItemContainer">
                    <?php
                        if ($page > 1){
                            $nextPage = $page - 1;
                        }
                        $navigationLink = "attractions.php?page=" . $nextPage;
                        if ($city != null){
                            $navigationLink = $navigationLink . "&city=" . urlencode($city);
                        }
                        else {
                            $navigationLink = $navigationLink . "&searchQuery=" . urlencode($searchQuery);
                        }
                    ?>
                    <a class="navigationItem" href=<?= $navigationLink ?>>
                        <
                    </a>
                </div>
                <div class="col-3 text-center navigationItemContainer">
                    <?php
                        if ($page < $pages){
                            $nextPage = $page + 1;
                        }
                        $navigationLink = "attractions.php?page=" . $nextPage;
                        if ($city != null){
                            $navigationLink = $navigationLink . "&city=" . urlencode($city);
                        }
                        else {
                            $navigationLink = $navigationLink . "&searchQuery=" . urlencode($searchQuery);
                        }
                    ?>
                    <a class="navigationItem" href=<?= $navigationLink ?>>
                        >
                    </a>
                </div>
                <div class="col-3 text-right navigationItemContainer">
                    <?php
                        $nextPage = $pages;
                        $navigationLink = "attractions.php?page=" . $nextPage;
                        if ($city != null){
                            $navigationLink = $navigationLink . "&city=" . urlencode($city);
                        }
                        else {
                            $navigationLink = $navigationLink . "&searchQuery=" . urlencode($searchQuery);
                        }
                    ?>
                    <a class="navigationItem" href=<?= $navigationLink ?>>
                        >>>
                    </a>
                </div>
            </div>
            <?php
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