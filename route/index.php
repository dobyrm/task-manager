<?php

use Controller\HomeController;

if(!empty($_REQUEST['page'])) {
    switch ($_REQUEST['page']) {
        case 'edit':
            $obj = new HomeController();
            echo $obj->edit();
            die();
            break;
    }
}

if(!empty($_REQUEST['mode'])) {
    switch ($_REQUEST['mode']) {
        case 'create-task':
            $obj = new HomeController();
            echo $obj->createAction();
            die();
            break;
        case 'update-task':
            $obj = new HomeController();
            echo $obj->updateAction();
            die();
            break;
        case 'performed-task':
            $obj = new HomeController();
            echo $obj->performedAction();
            die();
            break;
    }
}

$obj = new HomeController();
echo $obj->index();