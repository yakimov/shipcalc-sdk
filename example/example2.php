<?php
require_once '../vendor/autoload.php';

use S25\ShipCalcSDK\Settings\Settings;
use S25\ShipCalcSDK\Client\Client;
use S25\ShipCalcSDK\Place\Place;
use S25\ShipCalcSDK\Product\SimpleProduct;

$destinations = [
    ['US', 'AK', '99501-99950'],
    ['US', 'AL', '35004-36925'],
    ['US', 'AR', '71601-72959'],
    ['US', 'AR', '75502-75502'],
    ['US', 'AZ', '85001-86556'],
    ['US', 'CA', '90001-96162'],
    ['US', 'CO', '80001-81658'],
    ['US', 'CT', '06001-06389'],
    ['US', 'CT', '06401-06928'],
    ['US', 'DC', '20001-20039'],
    ['US', 'DC', '20042-20599'],
    ['US', 'DC', '20799-20799'],
    ['US', 'DE', '19701-19980'],
    ['US', 'FL', '32004-34997'],
    ['US', 'GA', '30001-31999'],
    ['US', 'GA', '39901-39901'],
    ['US', 'HI', '96701-96898'],
    ['US', 'IA', '50001-52809'],
    ['US', 'IA', '68119-68120'],
    ['US', 'ID', '83201-83876'],
    ['US', 'IL', '60001-62999'],
    ['US', 'IN', '46001-47997'],
    ['US', 'KS', '66002-67954'],
    ['US', 'KY', '40003-42788'],
    ['US', 'LA', '70001-71232'],
    ['US', 'LA', '71234-71497'],
    ['US', 'MA', '01001-02791'],
    ['US', 'MA', '05501-05544'],
    ['US', 'MD', '20331-20331'],
    ['US', 'MD', '20335-20797'],
    ['US', 'MD', '20812-21930'],
    ['US', 'ME', '03901-04992'],
    ['US', 'MI', '48001-49971'],
    ['US', 'MN', '55001-56763'],
    ['US', 'MO', '63001-65899'],
    ['US', 'MS', '38601-39776'],
    ['US', 'MS', '71233-71233'],
    ['US', 'MT', '59001-59937'],
    ['US', 'NC', '27006-28909'],
    ['US', 'ND', '58001-58856'],
    ['US', 'NE', '68001-68118'],
    ['US', 'NE', '68122-69367'],
    ['US', 'NH', '03031-03897'],
    ['US', 'NJ', '07001-08989'],
    ['US', 'NM', '87001-88441'],
    ['US', 'NV', '88901-89883'],
    ['US', 'NY', '06390-06390'],
    ['US', 'NY', '10001-14975'],
    ['US', 'OH', '43001-45999'],
    ['US', 'OK', '73001-73199'],
    ['US', 'OK', '73401-74966'],
    ['US', 'OR', '97001-97920'],
    ['US', 'PA', '15001-19640'],
    ['US', 'RI', '02801-02940'],
    ['US', 'SC', '29001-29948'],
    ['US', 'SD', '57001-57799'],
    ['US', 'TN', '37010-38589'],
    ['US', 'TX', '73301-73301'],
    ['US', 'TX', '75001-75501'],
    ['US', 'TX', '75503-79999'],
    ['US', 'TX', '88510-88589'],
    ['US', 'UT', '84001-84784'],
    ['US', 'VA', '20040-20041'],
    ['US', 'VA', '20040-20167'],
    ['US', 'VA', '20042-20042'],
    ['US', 'VA', '22001-24658'],
    ['US', 'VT', '05001-05495'],
    ['US', 'VT', '05601-05907'],
    ['US', 'WA', '98001-99403'],
    ['US', 'WI', '53001-54990'],
    ['US', 'WV', '24701-26886'],
    ['US', 'WY', '82001-83128'],
];

$from = (new Place())->setCountry('US')
                   ->setZip('19720');

$to = array_map(static function ($destination) {
    $zipCode = explode('-', $destination[2]);
    return (new Place())->setCountry($destination[0])
                        ->setZip($zipCode[0]);
}, $destinations);

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

var_dump($result);