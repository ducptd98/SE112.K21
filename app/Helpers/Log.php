<?php

class Log {

    public static function logInfo($message = null) {
        echo "INFO: " . $message . "\n";
    }

    public static function logWarning($message = null) {
        echo "WARNING: " . $message . "\n";
    }
}
