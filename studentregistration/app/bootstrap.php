<?php
//Load app config
require_once 'config/config.php';

// Load Helpers
require_once 'helpers/helper.php';


//Load Libraries
spl_autoload_register(function($className) {
    require_once 'libraries/'. $className .'.php';
});

