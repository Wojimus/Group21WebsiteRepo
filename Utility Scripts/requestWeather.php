<?php
//Get Temperature
    //Format city name
    $apiCity = "";
    if (strpos($city, 'St') === 0){
        $apiCity = $city;
    }
    else {
        $apiCity = strtok($city, " ");
    }
    //Create the request link
    $apiUrl = "api.openweathermap.org/data/2.5/weather?q=" . $apiCity . "&appid=" . $apiKey;

    //Create Request using CURL
    $request = curl_init();
    curl_setopt($request, CURLOPT_HEADER, 0);
    curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($request, CURLOPT_URL, $apiUrl);
    curl_setopt($request, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($request, CURLOPT_VERBOSE, 0);
    curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($request);
    $err = curl_error($request);
    curl_close($request);

    //Extract Data
    //Get Temp
    $celsius = 0;
    if (!$err) {
        $weatherData = json_decode($response);
        $kelvin = $weatherData->main->temp;
        $celsius = round($kelvin - 273.15, 1);
    }
    //Get Weather
    $weatherIcon = "";
    $weather = $weatherData->weather[0]->main;
    if ($weather == "Clear"){
        $weatherIcon = "&#9728";
    }
    else if ($weather == "Drizzle" or $weather == "Rain" or $weather == "Thunderstorm"){
        $weatherIcon = "&#9730";
    }
    else if ($weather == "Snow"){
        $weatherIcon = "&#9731";
    }
    else {
        $weatherIcon = "&#9729";
    }
    ?>
<span class="cityTemperature">
    <?= $weatherIcon?> <?= $celsius?>&#8451;
</span>
