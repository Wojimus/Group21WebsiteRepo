<?php include "Utility Scripts/pageUtilities.php"; ?>
<?php
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
    <title>Login</title>
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
            <span class="titleHighlight">Login</span>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form action="Utility Scripts/loginUser.php" method="post">
                <!--Login-->
                <span class="loginHeading">
                    Username
                </span>
                <br>
                <input type="text" class="loginInput" name="userName">
                <?php
                    if ($errorCode == 1){
                        ?>
                        <span class="loginError">
                            Username does not exist
                        </span>
                        <?php
                    }
                ?>
                <br>
                <!--Password-->
                <span class="loginHeading">
                    Password
                </span>
                <br>
                <input type="password" class="loginInput" name="password">
                <?php
                    if ($errorCode == 2){
                        ?>
                        <span class="loginError">
                            Incorrect password
                        </span>
                        <?php
                    }
                ?>
                <br>
                <button type="submit" class="loginButton">
                    Login
                </button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <br>
            <span class="loginSubHeading">
                Don't have an account?
            </span>
            <br>
            <a href="register.php" class="loginSubHeading">
                Register Here
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
    $conn -> close();
?>
</html>