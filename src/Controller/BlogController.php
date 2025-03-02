<?php

declare(strict_types=1);

namespace App\Controller;

use App\View;

class BlogController extends AbstractController
{
    public function run()
    {
        switch ($this->action()) {
            case 'log-in':
                if (empty($_SESSION['logged'])) {
                    $paramsList = [
                        'info' => $this->request->getParam('info') ?? null
                    ];
                    (new View)->render($paramsList, $this->action());
                } else
                    header('Location: /?page=cms');
                break;

            case 'show':
                $articleData = $this->model->selectOne(0, 'articles', $this->request->getParam('article'));
                (new View)->render($articleData, 'show');
                break;

            default:
                $paramsList = [
                    'info' => $this->request->getParam('info') ?? null,
                    'articles' => $this->model->selectAll(),
                    'articleData' => $this->model->selectOne(0, 'articles', $this->request->getParam('article') ?? null),
                    'page' => $this->model->selectOne(1, 'pages')
                ];
                (new View)->render($paramsList);
                break;
        }
    }
}