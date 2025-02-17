<?php

spl_autoload_register(function ($class) {
    require_once __DIR__ .  "/../" .  $class . ".php";
});

require_once __DIR__ . '/constant.php';
require_once BASE_PATH . '/app/Helpers/helpers.php';
require_once BASE_PATH . '/app/Config/middleware.php';
require_once BASE_PATH . '/app/Config/link_css.php';
require_once BASE_PATH . '/app/Config/routes.php';
