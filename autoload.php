<?php
spl_autoload_register(function ($className) {
    $classPath = str_replace("\\", "/", $className);
    require_once __DIR__ . "../" . $classPath . ".php";
});
