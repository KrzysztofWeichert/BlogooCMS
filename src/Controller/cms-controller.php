<?php

declare(strict_types=1);

namespace CMS;

use App\View;
use App\AbstractController;

require_once('src/View.php');
require_once('src/functions.php');
require_once('src/model/Model.php');
require_once('src/Controller/AbstractController.php');

class CmsController extends AbstractController
{
    public function run()
    {
        switch ($this->action()) {

            case 'cms':
                $username = $this->request->postParam('username') ?? '';
                $password = $this->request->postParam('password') ?? '';
                if (!empty($_SESSION['logged']) || !empty($this->Model->login($username, $password))) {
                    $paramsList = [
                        'info' => $this->request->getParam('info') ?? null,
                        'articles' => $this->Model->selectAll()
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
                        $this->Model->addArticle($articleData);
                        header('Location: /?page=cms&info=created');
                    }
                } else
                    header('Location: /');
                break;

            case 'edit':
                if (!empty($_SESSION['logged'])) {
                    $article = $this->Model->selectOne($this->request->getParam('id'));
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
                        $this->Model->edit($articleData);
                        header('Location: /?page=cms&info=edited');
                    }
                } else
                    header('Location: /');
                break;

            case 'delete':
                if (!empty($_SESSION['logged'])) {
                    $article = $this->Model->selectOne($this->request->getParam('id'));
                    $articleData = [
                        'id' => $article['id']
                    ];
                    if(!$article)
                        header('Location: /?page=cms');

                    (new View)->renderCMS($articleData, 'article-delete');

                    if ($this->request->postParam('confirm') === 'YES') {
                        $this->Model->deleteArticle($articleData['id']);
                        header('Location: /?page=cms&info=deleted');
                    } elseif ($this->request->postParam('confirm') === 'NO')
                        header('Location: /?page=cms');
                } else
                    header('Location: /');
                break;

                case 'edit-home':
                    if (!empty($_SESSION['logged'])) {
                        $home = $this->Model->selectOne($this->request->getParam('id'), 'pages');
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
                            $this->Model->edit($articleData, 'pages');
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
