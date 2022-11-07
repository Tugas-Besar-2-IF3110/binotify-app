<?php

class Controller {
    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }

    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    public function utility($utility) {
        return '../app/utility/' . $utility . '.php';
    }

    public function assets()
    {
        return '../public/assets/';
    }
}

?>