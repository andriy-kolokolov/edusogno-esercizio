<div class="debug-container">
    <?php
    // Function to format session variables as an associative array
    function getSessionVariablesAsArray(): array
    {
        $sessionData = [];
        foreach ($_SESSION as $key => $value) {
            $sessionData[$key] = $value;
        }
        return $sessionData;
    }
    // Print session variables as an associative array
    $sessionDataArray = getSessionVariablesAsArray();
    echo "<pre>";
    echo "Session Variables:<br>";
    print_r($sessionDataArray);
    echo "</pre>";

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    ?>
</div>