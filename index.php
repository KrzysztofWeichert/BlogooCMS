<?php
declare(strict_types=1);

namespace App;

use App\Controller\CmsController;
use App\Controller\BlogController;
use App\Request;
use Error;
use Exception;

include 'src/functions.php';
require_once realpath('vendor/autoload.php');
session_start();

$request = new Request($_GET, $_POST);

$db_config = require_once('src/config.php');

$page = $request->getParam('page');

$cmsPages = ['cms', 'new-article', 'edit', 'delete', 'edit-home', 'log-out'];

try{
if (in_array($page, $cmsPages)) {
    (new CmsController($request, $db_config))->run();
} else {
    (new BlogController($request, $db_config))->run();
}
} catch(Error|Exception $e){
    echo 'An error occured. Please contanct the administrator!';
}