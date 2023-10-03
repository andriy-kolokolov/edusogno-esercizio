<?php
spl_autoload_register(function ($className) {
    $baseDir = __DIR__ . '/../'; // app classes base directory
    $classPath = str_replace("\\", "/", $className); // convert namespace separators to directory separators
    $filePath = $baseDir . $classPath . ".php"; // build path

    require_once $filePath;
});
