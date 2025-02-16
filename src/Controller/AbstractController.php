<?php

declare(strict_types=1);

namespace App;
use Request;

require_once('src/functions.php');
require_once('src/Model/Model.php');

abstract class AbstractController
{
    protected Request $request;
    protected Model $Model;
    public function __construct(Request $request, $db_config)
    {
        $this->request = $request;
        $this->Model = new Model($db_config);
    }

    protected function action(): ?string
    {
        return $this->request->getParam('page');
    }
}
