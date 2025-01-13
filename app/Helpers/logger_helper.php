<?php

if (!function_exists('writeLogToFile')) {
    function writeLogToFile($message)
    {
        $logFile = WRITEPATH . 'logs/custom_log.txt';
        $handle = fopen($logFile, 'a'); // 'a' untuk append
        if ($handle) {
            fwrite($handle, date('Y-m-d H:i:s') . ' - ' . $message . PHP_EOL);
            fclose($handle);
        }
    }
}

?>