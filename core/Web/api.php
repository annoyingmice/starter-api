<?php

$modules = glob(__DIR__ . '/*', GLOB_ONLYDIR);

foreach ($modules as $module) {
    $apiRoutePath = $module . '/Routes/api.php';

    if (file_exists($apiRoutePath)) {
        require $apiRoutePath;
    }
}
