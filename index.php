<?php
declare(strict_types=1);
namespace App;

use CMS\CmsController;
use Error;
use Exception;
use Request;
session_start();

require_once('src/controller/blog-controller.php');
require_once('src/controller/cms-controller.php');
require_once('src/functions.php');
require_once('src/model/Model.php');

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
    dumper($e);
}