<?php

class Controller
{
    public function model($model)
    {
        require_once appDir . modelDir . $model . '.php';
        return new $model();
    }

    public function view($view, $data = [])
    {
        require_once (appDir . viewDir . $view . '.php');
    }
}