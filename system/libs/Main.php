<?php 

class Main
{
    public $url;
    public $controllerName = "Index";
    public $methodName = "Index";
    public $controllerPath = "app/controllers/";
    public $controller; //controlName er Object

    public function __construct()
    {
        $this->getUrl();
        $this->loadController();
        $this->callMethod();
    }


    

    public function getUrl()
    {
        $this->url = isset($_GET['url']) ? $_GET['url']: null;
        if ($this->url != null) {
            $this->url = rtrim($this->url, '/');
            $this->url = explode('/', filter_var($this->url, FILTER_SANITIZE_URL));
        } else {
            unset($this->url);
        }
    }

    
    

    public function loadController()
    {
        if (!isset($this->url[0])) {
            include $this->controllerPath.$this->controllerName.".php";
            $this->controller = new $this->controllerName();
        } else {
            $this->controllerName = $this->url[0];
            $fileName = $this->controllerPath.$this->controllerName.".php";
            if (file_exists($fileName)) {
                include $fileName;
                if (class_exists($this->controllerName)) {
                    $this->controller = new $this->controllerName();
                } else {
                    header("Location: ".BASE_URL."/Index");
                    // echo "<script>window.location = 'http://localhost/mvc/Index/home';</script>";
                }
            } else {
                header("Location: ".BASE_URL."/Index");
                // echo "<script>window.location = 'http://localhost/mvc/Index/home';</script>";
            }
        }
    }


    
    public function callMethod()
    {
        // if (isset($this->url[1])) {
        //     $method = $this->url[1];
        // }
        if (isset($this->url[2])) {
            // $this->methodName = $method;
            $this->methodName = $this->url[2];
            if (method_exists($this->controller, $this->methodName)) {
                $this->controller->{$this->methodName}($this->url[2]);
            } else {
                header("Location: ".BASE_URL."/Index");
                // echo "<script>window.location = 'http://localhost/mvc/Index/home';</script>";
            }
        } else {
            if (isset($this->url[1])) {
                // $this->methodName = $method;
                $this->methodName = $this->url[1];
                if (method_exists($this->controller, $this->methodName)) {
                    $this->controller->{$this->methodName}();
                } else {
                    header("Location: ".BASE_URL."/Index");
                    // echo "<script>window.location = 'http://localhost/mvc/Index/home';</script>";
                }
            } else {
                if (method_exists($this->controller, $this->methodName)) {
                    $this->controller->{$this->methodName}();
                } else {
                    header("Location: ".BASE_URL."/Index");
                    // echo "<script>window.location = 'http://localhost/mvc/Index/home';</script>";
                }
            }
        }
    }
}
