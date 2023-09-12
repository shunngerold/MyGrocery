<?php

spl_autoload_register('myAutoload');

function myAutoload($classname)
{
    $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    // If folder is available in url
    if (
        strpos($url, "includes") !== false || strpos($url, "user_edit_profile") !== false ||
        strpos($url, "admin_side") !== false
    ) {
        $path = "../classes/";
    } else {
        $path = "classes/";
    }

    $extension = ".class.php";
    $full_path = $path . $classname . $extension;

    // If file is not exist
    if (!file_exists($full_path)) {
        return false;
    }

    require_once $full_path;
}
