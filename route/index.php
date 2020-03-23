<?php

use Controller\HomeController;
use Controller\LoginController;

if(!empty($_REQUEST['mode'])) {
    switch ($_REQUEST['mode']) {
        case 'login':
            $obj = new LoginController();
            echo $obj->index();
            die();
            break;
    }
}

$obj = new HomeController();
echo $obj->index();