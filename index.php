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