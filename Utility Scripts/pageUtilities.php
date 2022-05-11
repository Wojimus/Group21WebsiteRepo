<?php
    use Aws\S3\S3Client;
    use Aws\S3\Exception\S3Exception;

    //Check if Utility Script
    basename(getcwd()) == "Utility Scripts" ? $isUtility = true : $isUtility = false;
    //Credentials
    $isUtility ? $credentials = parse_ini_file("../ExploreUKCredentials.ini"):
        $credentials = parse_ini_file("ExploreUKCredentials.ini");
    //AWS
    $isUtility ? require '../aws/aws-autoloader.php': require 'aws/aws-autoloader.php';

    //Variables
    $servername = $credentials["servername"];
    $username = $credentials["username"];
    $password = $credentials["password"];
    $dbname = $credentials["dbname"];
    $apiKey = $credentials["openweatherkey"];
    $s3bucket = $credentials["s3bucket"];
    $s3bucketlinkprefix = "https://" . $s3bucket . ".s3.amazonaws.com/";

    //Create Database Connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    //Check for success
    if (mysqli_connect_errno()) {
        die("Connection Failed: " . mysqli_connect_error());
    }

    //Start Session
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }

    //Generate Rating
    function generateRating($review){
        $fullStars = floor($review["UserRating"]);
        $halfStar = false;
        if (($review["UserRating"] * 10) % 10 == 5){
            $halfStar = true;
        }
        for ($i = 0; $i < $fullStars; $i++){
            ?>
            <img class="starIcon" src="Resources/Icons/StarSharp.png">
            <?php
        }
        if ($halfStar) {
            ?>
            <img class="starIcon" src="Resources/Icons/StarHalfSharp.png">
            <?php
        }
    }

    function s3Glob($bucket, $bucketlinkprefix, $directory){
        // Instantiate the client.
        $s3 = new S3Client([
            'version' => 'latest',
            'region'  => 'us-east-1',
            'credentials' => [
                'key'    => "ASIA4IPSFXQOJ2QU6MHT",
                'secret' => "skBPgsUcZAVIe2NLR41wp7YcNSipCrJufIfmYniw",
                "token" => "FwoGZXIvYXdzEGwaDNyfn38FvONz+DaafyLOAehNBMVjzkOEd+vNmjdKnetedpK3nKZi7s5PC9h9pGhfmi5yhqUljTu9jF0MI3smg2KGApU3omsQ4zRsPri4/cdujyOXKBlqSh+30ZPq3nwfUIYZJWnCvFFjI60tmcc1C8D2Eg8a4R5yvp74JYEwfBqk+pipJ5VTqzIeQ7RCeinELaQLMwwNzMr5jpG8kRt53xhuVUFBl0kkgSQwi6sM0m2D26IcELcoe08SC8Jug6XIh8BFnSpDnCdrjILBCTzlAI6Bm7dG9lpE9o4NoAtlKMz475MGMi3ag8V7wW7spQI7q7Xst6G2WTR3ooItbwGnTtySnwnUmSEfteptPAlJliOWhCQ="
            ],
        ]);

        //Results Array
        $results = array();

        try {
            $objects = $s3->listObjects([
                'Bucket' => $bucket,
                "Prefix" => $directory . "/"
            ]);
            if ($objects['Contents'] != null){
                foreach ($objects['Contents']  as $object) {
                    array_push($results, $bucketlinkprefix . $object['Key']);
                }
            }
        } catch (S3Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }

        return $results;;
    }
?>