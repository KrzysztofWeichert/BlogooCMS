<?php

declare(strict_types=1);

namespace App;

require_once('src/View.php');
require_once('src/functions.php');
require_once('src/Model/Model.php');
require_once('src/Controller/AbstractController.php');

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
                $articleData = $this->Model->selectOne(0, 'articles', $this->request->getParam('article'));
                (new View)->render($articleData, 'show');
                break;

            default:
                $paramsList = [
                    'info' => $this->request->getParam('info') ?? null,
                    'articles' => $this->Model->selectAll(),
                    'articleData' => $this->Model->selectOne(0, 'articles', $this->request->getParam('article') ?? null),
                    'page' => $this->Model->selectOne(1, 'pages')
                ];
                (new View)->render($paramsList);
                break;
        }
    }
}