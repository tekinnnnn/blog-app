<?php

require_once __DIR__ . '/../bootstrap/app.php';

register_shutdown_function(function () {
    $error = error_get_last();
    if ($error) {
        //ob_clean();
        http_response_code(500);
    }
});

// let the lights on
require_once __DIR__ . '/../app/route.php';
