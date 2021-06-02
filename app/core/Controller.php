<?php

class Controller
{
    public function model($model, $args = [])
    {
        require_once '../app/models/' . $model . '.php';
        return new $model(...$args);
    }

    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }
}
