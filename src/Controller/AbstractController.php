<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Model;
use App\Request;

abstract class AbstractController
{
    protected Request $request;
    protected Model $model;
    public function __construct(Request $request, $db_config)
    {
        $this->request = $request;
        $this->model = new Model($db_config);
    }

    protected function action(): ?string
    {
        return $this->request->getParam('page');
    }
}
