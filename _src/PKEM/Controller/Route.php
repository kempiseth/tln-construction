<?php

namespace PKEM\Controller;

class Route {

    protected $routes;
    protected $uri;
    protected $path;

    function __construct($routes) {
        $this->routes = $routes;
        $this->uri = $_SERVER['REQUEST_URI'];

        $parsed = parse_url($this->uri);
        $this->path = '/' . trim($parsed['path'], '/');
    }

    public function renderPage() {
        if (array_key_exists($this->path, $this->routes)) {
            $page = new Page($this->routes[$this->path]);
        } else {
            $page = new Page();
        }
        $page->render();
    }

    static function routeTo($location) {
        header("Location: $location");
        exit;
    }

}
