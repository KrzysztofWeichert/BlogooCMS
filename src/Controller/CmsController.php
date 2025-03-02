<?php

declare(strict_types=1);

namespace App\Controller;

use App\View;

class CmsController extends AbstractController
{
    public function run()
    {
        switch ($this->action()) {

            case 'cms':
                $username = $this->request->postParam('username') ?? '';
                $password = $this->request->postParam('password') ?? '';
                if (!empty($_SESSION['logged']) || !empty($this->model->login($username))) {
                    $articlesNumber = $this->model->count();
                    $pageNumber = $this->request->getParam('pagenumber') ?? 1;
                    $paramsList = [
                        'articlesNumber' => $articlesNumber,
                        'pagenumber' => $pageNumber, 
                        'info' => $this->request->getParam('info') ?? null,
                        'articles' => $this->model->selectAllCMS($pageNumber)
                    ];
                    (new View)->renderCMS($paramsList);
                    $_SESSION['logged'] = 'logged';
                } else 
                    header('Location: /?page=log-in&info=invalidlogin');
                
                break;

            case 'new-article':
                if (!empty($_SESSION['logged'])) {
                    (new View)->renderCMS([], 'article-new');
                    if ($this->request->hasPost()) {
                        $articleData = [
                            'title' => $this->request->postParam('title') ?? null,
                            'description' => $this->request->postParam('description') ?? null,
                            'meta-title' => $this->request->postParam('meta-title') ?? null,
                            'meta-description' => $this->request->postParam('meta-description') ?? null
                        ];
                        $this->model->add($articleData);
                        header('Location: /?page=cms&info=created');
                    }
                } else
                    header('Location: /');
                break;

            case 'edit':
                if (!empty($_SESSION['logged'])) {
                    $article = $this->model->selectOne($this->request->getParam('id'));
                    $articleData = [
                        'article' => $article
                    ];
                    if(!$article)
                        header('Location: /?page=cms');
                    (new View)->renderCMS($articleData, 'article-edit');

                    if ($this->request->hasPost()) {
                        $articleData = [
                            'id' => $this->request->getParam('id'),
                            'title' => $this->request->postParam('title'),
                            'description' => $this->request->postParam('description'),
                            'metaTitle' => $this->request->postParam('meta-title'),
                            'metaDescription' => $this->request->postParam('meta-description')

                        ];
                        $this->model->edit($articleData);
                        header('Location: /?page=cms&info=edited');
                    }
                } else
                    header('Location: /');
                break;

            case 'delete':
                if (!empty($_SESSION['logged'])) {
                    $article = $this->model->selectOne($this->request->getParam('id'));
                    $articleData = [
                        'id' => $article['id']
                    ];
                    if(!$article)
                        header('Location: /?page=cms');

                    (new View)->renderCMS($articleData, 'article-delete');

                    if ($this->request->postParam('confirm') === 'YES') {
                        $this->model->delete($articleData['id']);
                        header('Location: /?page=cms&info=deleted');
                    } elseif ($this->request->postParam('confirm') === 'NO')
                        header('Location: /?page=cms');
                } else
                    header('Location: /');
                break;

                case 'edit-home':
                    if (!empty($_SESSION['logged'])) {
                        $home = $this->model->selectOne($this->request->getParam('id'), 'pages');
                        $pageData = [
                            'home' => $home
                        ];
                        (new View)->renderCMS($pageData, 'home-edit');
    
                        if ($this->request->hasPost()) {
                            $articleData = [
                                'id' => $this->request->getParam('id'),
                                'name' => $this->request->postParam('name'),
                                'description' => $this->request->postParam('description'),
                                'metaTitle' => $this->request->postParam('meta-title'),
                                'metaDescription' => $this->request->postParam('meta-description')
    
                            ];
                            $this->model->edit($articleData, 'pages');
                            header('Location: /?page=cms&info=HomeEdited');
                        }
                    } else
                        header('Location: /');
                    break;

            case 'log-out':
                session_destroy();
                header('Location: /?info=logout');
                break;

            default:
                header('Location: /?page=cms');
                break;
        }
    }
}
