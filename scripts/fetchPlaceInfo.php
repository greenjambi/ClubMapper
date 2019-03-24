<?php

require '../vendor/autoload.php';

$file = '../places.txt';

$fh = fopen($file,'r');
while ($line = fgetcsv($fh)) {

    $name = trim($line[0]);
    $address = trim($line[1]);
    echo "\n\"$name\"";
    $client = new \GuzzleHttp\Client(
        [
            // Base URI is used with relative requests
            'base_uri' => 'https://maps.googleapis.com/maps/api/',
            // You can set any number of default request options.
            'timeout'  => 2
        ]
    );

    $request = new \GuzzleHttp\Psr7\Request(
        'GET',
        'https://maps.googleapis.com/maps/api/place/findplacefromtext/json' .
        '?key=AIzaSyAVYm5zICHF4X9sxIA731oY0ElAzqvUQ7M&input='. trim($address) .
        '&inputtype=textquery'

    );

    $response = $client->send($request);

    $response = json_decode( (string) $response->getBody());

    $placeId = $response->candidates[0]->place_id;

    $request = new \GuzzleHttp\Psr7\Request(
        'GET',
        'https://maps.googleapis.com/maps/api/place/details/json' .
        '?key=AIzaSyAVYm5zICHF4X9sxIA731oY0ElAzqvUQ7M' .
        '&placeid='. trim($placeId) .
        '&inputtype=textquery'

    );

    $response = $client->send($request);

    $result = json_decode($response->getBody());

    echo " => '". (json_encode($result->result->geometry->location)) . "',";

}
fclose($fh);

echo "\n";