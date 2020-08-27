<?php
require_once '../vendor/autoload.php';

use S25\ShipCalcSDK\Settings\Settings;
use S25\ShipCalcSDK\Client\Client;
use S25\ShipCalcSDK\Place\Place;
use S25\ShipCalcSDK\Product\SimpleProduct;

$from = array_map(static function ($country) {
    return (new Place())->setCountry($country);
}, ['US', 'JP']);

$to = array_map(static function ($country) {
    return (new Place())->setCountry($country);
}, ['AT', 'AU', 'AW', 'BE', 'CA', 'CH', 'CZ', 'DE', 'ES', 'FR', 'GB', 'IE', 'IL', 'IT', 'KR', 'NL', 'PL', 'SP', 'US']);

$settings = (new Settings())
          ->setApiHost('http://host')
          ->setApiUrl('/api/v1.0/calculate/');

$client = new Client($settings);
$client->getRequest()->setFrom($from)
                  ->setTo($to)
                  ->setCurrency('RUB', 'USD')
                  ->setProduct((new SimpleProduct())->setWeight(1000));
$client->calc();

$result = $client->getResponse()->getResponseQuery()->getCheapestShipping();
