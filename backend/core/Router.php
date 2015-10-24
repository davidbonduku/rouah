<?php

class Router
{
    private $_app,
        $_currentMethod,
        $_currentController,
        $_request,
        $_action;

    public function __construct($app)
    {
        $this->_app = $app;
    }
    /**
     * @param $httpMethod
     * @param $url
     * @param $action
     * @return mixed
     */
    public function perform($httpMethod,$url,$action)
    {
        return $this->_app->$httpMethod($url,function() use($action){

            $this->_addAction($action)
                 ->_loadRequestDataFromAction()
                 ->_addMethod()
                 ->_addController()
                 ->_doAction(func_get_args());
        });
    }
    /**
     * Permet d'ajouter un controlleur
     * @return $this
     */
    private function _addController()
    {
        $this->_currentController = ucwords($this->_request[0].'Controller');
        CoreController::loadController($this->_currentController);
        return $this;
    }
    /**
     * Permet d'executer une action
     * @param $data
     */
    private function _doAction(array $data)
    {
        $controller = new $this->_currentController();
        call_user_func_array(array($controller,$this->_currentMethod),$data);
    }
    /**
     * Permet d'ajouter une action
     * @param $action
     * @return Router
     */
    private function _addAction($action)
    {
        $this->_action = $action;
        return $this;
    }
    /**
     * Permet d'ajouter une methode
     */
    private function _addMethod()
    {
        $this->_currentMethod = $this->_request[1];
        return $this;
    }
    /**
     * permet de charger la requete à partir de l'action
     */
    private function _loadRequestDataFromAction()
    {
        $this->_request = explode('@',$this->_action);
        return $this;
    }
    /**
     * Permet d'executer la requete
     */
    public function run()
    {
        $this->_app->run();
    }
}