<?php
declare(strict_types=1);
namespace App;

class View{
    public function render(array $params = [], string $page='home'){
        require_once 'Templates/blog-layout.php';
    }

    public function renderCMS(array $params = [], string $page='article-list'){
        require_once 'Templates/cms-layout.php';
    }
}