<?php
    //Get Current File To Customise Header
    $currentFile = basename($_SERVER["PHP_SELF"]);
?>
<!-- Full Desktop Header -->
<header class="row align-items-center d-none d-md-flex">
    <div class="col-md-1 col-lg-1 mx-auto">
        <a href="index.php">
            <img src="Resources/Logo/DrawingJack.png" class="logo" alt="Explore UK Logo">
        </a>
    </div>
    <div class="col-md-4 col-lg-5">
    </div>
    <div class="col-md-2 col-lg-2">
        <div class="text-center">
            <?php
                $currentFile == "cities.php" ? $class = "focusedNav" : $class = "";
            ?>
            <a href="cities.php" class=<?= $class ?>>
                Cities
            </a>
        </div>
    </div>
    <div class="col-md-3 col-lg-2">
        <div class="text-center">
            <?php
                $currentFile == "attractions.php" ? $class = "focusedNav" : $class = "";
            ?>
            <a href="attractions.php" class=<?= $class ?>>
                Attractions
            </a>
        </div>
    </div>
    <div class="col-md-2 col-lg-2">
        <div class="text-center">
            <?php
                $class = "";
                if ($currentFile == "account.php" or $currentFile == "register.php" or $currentFile == "login.php") {
                    $class = "focusedNav";
                }
            ?>
            <a href="account.php" class=<?= $class ?>>
                <?php
                    if (isset($_SESSION["name"])){
                        echo "Account";
                    }
                    else {
                        echo "Login";
                    }
                ?>
            </a>
        </div>
    </div>
</header>

<!-- Mobile Header -->
<header class="row align-items-center d-flex d-md-none">
    <div class="col-3">
        <a href="index.php">
            <img src="Resources/Logo/DrawingJack.png" class="logo" alt="Explore UK Logo">
        </a>
    </div>
    <div class="col-3 text-right">
        <a href="cities.php">
            <?php
                $currentFile == "cities.php" ? $class = "mobileIcon focusedIcon" : $class = "mobileIcon";
            ?>
            <div class="<?= $class ?>" id="cityIcon">
            </div>
        </a>
    </div>
    <div class="col-3 text-right">
        <a href="attractions.php">
            <?php
                $currentFile == "attractions.php" ? $class = "mobileIcon focusedIcon" : $class = "mobileIcon";
            ?>
            <div class="<?= $class ?>" id="attractionIcon">
            </div>
        </a>
    </div>
    <div class="col-3 text-right">
        <a href="account.php">
            <?php
                $class = "mobileIcon";
                if ($currentFile == "account.php" or $currentFile == "register.php" or $currentFile == "login.php"){
                    $class = "mobileIcon focusedIcon";
                }
            ?>
            <div class="<?= $class ?>" id="accountIcon">
            </div>
        </a>
    </div>
</header>