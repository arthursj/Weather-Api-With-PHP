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

echo '<pre>';
print_r($data);