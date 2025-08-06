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