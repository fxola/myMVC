<?php
//Load Config File
require_once('config/config.php');


//Load Libraries
// require_once('libraries/Core.php');
// require_once('libraries/Controller.php');
// require_once('libraries/Database.php');


//Autoload Core Libraries
spl_autoload_register(
    function($classname)
    {

    require_once('libraries/'.$classname.'.php');

    });