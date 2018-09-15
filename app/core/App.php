<?php

class App
{

    protected $controller = 'Main';

    protected $controllerExtension = 'Controller';

    protected $method = 'index';

    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        //check or controller exists, if not return main controller
        if(file_exists(appDir . controllerDir . $url[0] . $this->controllerExtension . '.php'))
        {
            $this->controller = ucfirst($url[0]).$this->controllerExtension;
            unset($url[0]);
        } else {
            $this->controller = $this->controller.$this->controllerExtension;
        }

        require_once appDir. controllerDir . $this->controller . '.php';

        $this->controller = new $this->controller;

        //check or method exists, if not return main method
        if(isset($url[1]))
        {
            if(method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
            } else {
                $this->method = $this->method;
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if(isset($_GET['url']))
        {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}
