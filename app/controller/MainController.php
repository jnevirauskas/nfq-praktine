<?php

class MainController extends Controller
{
    public function index($name = '')
    {
        $service = $this->model('Service');
        $service->name = 'pervezimas';

        $this->view('main/index', ['service' => $service->name]);
    }

    public function orders()
    {
        echo 'orders';
    }
}