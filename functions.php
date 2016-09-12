<?php
/**
 * This file just acts as a bootstrap for the entire application/theme. If
 * you're looking for a place to put helper methods, either create a class or
 * use the Grain class in lib/Rye/*.
 */
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
    require __DIR__ . '/lib/init.php';
} else {
    die('Error: Use composer to install missing dependencies.');
}
