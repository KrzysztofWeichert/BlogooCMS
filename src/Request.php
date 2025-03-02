<?php
namespace App;
class Request
{
    private array $get = [];
    private array $post = [];

    public function __construct(array $get, array $post){
        $this->get = $get;
        $this->post = $post;
    }

    public function getParam(string $name, $default = null){
        return $this->get[$name] ?? $default;
    }

    public function hasPost(): bool{
        return !empty($this->post);
    }

    public function postParam(string $name){
        return $this->post[$name] ?? null;
    }
}