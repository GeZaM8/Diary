<?php

if (!function_exists('view')) {
    function view($view, $data = [])
    {
        extract($data);
        require BASE_PATH . "/app/views/$view.php";
    }
}

if (!function_exists('redirect')) {
    function redirect($url, $data = [])
    {
        $_SESSION['flash_data'] = $data;
        header("Location: " . $url);
        exit;
    }
}
