<?php
/*
 *Main App Core Class
 *Creates URL and loads Core Controller
 *URL FORMAT - /controller/method/paramsKB
 */
class Core
{
    protected $currentController = 'Pages';

    protected $currentMethod = 'index';

    protected $params = [];

    public function __construct()
    {

        $url = $this->getUrl();

        //check the controller folder for the first url value(controller) 
        if(file_exists('../app/controllers'.ucwords($url[0]).'.php'))
        {

            //if controller exists in folder set it as current controller
            $this->currentController = ucwords($url[0]);
            
            // unset 0 index
        }
        unset($url[0]);


        //require the controller
        require_once '../app/controllers/'. $this->currentController. '.php'; 

        //instantiate the controller
        $this->currentController = new $this->currentController;

        //check for the second part of the url (method)
        if(isset($url[1]))
        {
            //check if method exists in controller
            if(method_exists($this->currentController, $url[1]))
            {
                $this->currentMethod =  $url[1];

                //unset index 1
                unset($url[1]);
            }
        }

        //Get parameters
        $this->params = $url ? array_values($url) : [];

        // var_dump($this->params);
        
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }


    public function getUrl()
    {
        if(isset($_GET['url']))
        {
            $url = rtrim($_GET['url'], '/'); //trim '/' from the end of the url

            $url = filter_var($url, FILTER_SANITIZE_URL); //sanitize url

            $url = explode('/', $url); //split into an array

            return $url;
        }
    }
}