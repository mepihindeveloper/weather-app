<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Weather\EnvHelper;

require_once __DIR__ . '/vendor/autoload.php';

header('content-type: application/json');
header('Access-Control-Allow-Origin: *');

$envs = glob(__DIR__ . "/.env*");
// Загрузка переменных окружения проекта
EnvHelper::loadEnvironmentData(__DIR__ . '/', array_map(fn($env) => basename($env), $envs), true);
$params = [
    'q' => $_GET['city'] ?? null,
    'lang' => 'ru',
    'key' => $_ENV['API_SECRET_KEY'],
    'days' => 3,
];
$client = new Client();
try {
    $response = $client->request('GET', $_ENV['API_ENDPOINT'] . '/forecast.json?' . http_build_query($params));
} catch (ClientException  $e) {
    http_response_code(400);
    echo $e->getResponse()->getBody()->getContents();
    die;
}

echo $response->getBody();