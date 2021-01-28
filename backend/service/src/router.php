<?php

$router = new AltoRouter();
$router->setBasePath('/absensi-bk1/backend/service');

// ------------ routing -------------- //
$router->map('GET', '/', function () {
    echo 'api absensi';
});
$router->map('POST', '/login', 'login');


// ------------ match -------------- //
$match = $router->match();

// call closure or throw 404 status
if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    // no route was matched
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
