<?php 

require_once 'inc/config.php';
require_once 'inc/api.php';

$city = 'Osasco';

$days = 3;

$results = API::get($city, $days);

if($results['status'] == 'error'){
    echo $results['message'];
    exit;
}

$data = json_decode($results['data'], true);

# location data
$location = [];
$location['name'] = $data['location']['name'];
$location['region'] = $data['location']['region'];
$location['country'] = $data['location']['country'];
$location['latitude'] = $data['location']['lat'];
$location['longitude'] = $data['location']['lon'];
$location['current_time'] = $data['location']['localtime'];

// current weather data 
$current = [];
$current['info'] = 'Nesse momento:';
$current['temperature'] = $data['current']['temp_c'];
$current['condition'] = $data['current']['condition']['text'];
$current['condition_icon'] = $data['current']['condition']['icon'];
$current['wind_speed'] = $data['current']['wind_kph'];

// forecast weather data

$forecast = [];
foreach($data['forecast']['forecastday'] as $day) {
    $forescast_day = [];
    $forescast_day['info'] = null;
    $forescast_day['date'] = $day['date'];  
    $forescast_day['condition'] = $day['day']['condition']['text'];
    $forescast_day['condition_icon'] = $day['day']['condition']['icon'];      
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>API</title>
</head>
<body>
    
    <div class="container-fluid mt-5">
        <div class="row justify-content-center mt-5">
            <div class="col-10 p-5 bg-light text-black">
                <h3>Tempo para a cidade <strong><?= $city ?></strong></h3>
                <br>

                <!-- current -->
                <?php
                   $weather_info = $current;
                   include 'inc/weather_info.php' 
                ?>

                <!-- forecast -->
                <?php foreach($forecast as $day) : ?>
                    <?php
                        $weather_info = $day;
                        include 'inc/weather_info.php'; 
                    ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</body>
</html>