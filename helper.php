<?php

require 'vendor/autoload.php';

//  import chromephp file
include 'ChromePhp.php';

// create console output func
function consoleLog($log)
{
    ChromePhp::log($log);
}

// create error console func
function errorLog($error)
{
    ChromePhp::error($error);
}
