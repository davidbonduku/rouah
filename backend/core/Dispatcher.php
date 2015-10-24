<?php

/**
 * Class Dispatcher
 * Dispatcheur de requette
 */
class Dispatcher
{
    private $_methods = array("POST","PUT","DELETE","GET");
    private $_currentMethod;
    private $_router;
    private $_params;
    private $_ressource; //controlleur à utiliser

    /**
     * Constructeur
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->_router = $router;

        $this->_currentMethod = $this->_doRequest()->_getMethod();
        $this->_beginDispatching();
        $this->_router->run();
    }
    /**
     * Permet de récupérer la méthode en cours
     * @return string|void
     */
    private function _getMethod()
    {
        $count = count($this->_methods); $currentIndex = 0;

        for($currentIndex;$currentIndex<$count;$currentIndex++)
        {
            if($_SERVER["REQUEST_METHOD"] === $this->_methods[$currentIndex])
            {
                return strtolower( $this->_methods[$currentIndex] );
            }
        }
        return;
    }

    /**
     * Permet de récupérer la requete
     */
    private function _doRequest()
    {
        $currentRequest = explode('/',$_SERVER["REQUEST_URI"]);
        $count = count($currentRequest);

        if(intval($currentRequest[$count-1]) !== 0 )
        {
            $this->_ressource = $currentRequest[$count-2];
            $this->_params = $currentRequest[$count-1];

        }else{
            $this->_ressource = $currentRequest[$count-1];
            $this->_params = "";
        }
        return $this;
    }

    /**
     * Permet de faire le dispatching
     */
    private function _beginDispatching()
    {
        switch($this->_currentMethod)
        {
            case 'get':
                
                if( empty($this->_params ) )
                {
                    $this->_router->perform(
                        $this->_currentMethod,
                        '/'.$this->_ressource,
                        ucfirst($this->_ressource."@getAll")
                    );
                }else{

                    $this->_router->perform(
                        $this->_currentMethod,
                        '/'.$this->_ressource.'/:id',
                        ucfirst($this->_ressource.'@get')
                    );
                }
                break;
            case 'post':

                $this->_router->perform(
                    $this->_currentMethod,
                    '/'.$this->_ressource,
                    ucfirst($this->_ressource.'@add')
                );
                break;
            case 'put':

                $this->_router->perform(
                    $this->_currentMethod,
                    '/'.$this->_ressource.'/:id'
                    ,ucfirst($this->_ressource.'@update')
                );
                break;
            case 'delete':

                $this->_router->perform(
                    $this->_currentMethod,
                    '/'.$this->_ressource.'/:id',
                    ucfirst($this->_ressource.'@delete')
                );
                break;
        }
    }
}