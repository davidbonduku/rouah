<?php

class CoreController
{
    /**
     * Permet de charger un controlleur
     * @param $controllerName
     * @return mixed
     */

   static function loadController($controllerName)
    {
        require ROOT.'controllers'.DS.$controllerName.'.php';
    }
    /**
     * Permet de passer les données à la vue
     * @param array $data
     */
    public function _setView(array $data)
    {
        $this->_loadView(array(
                                'viewFileName' => $data['view'],
                                'content' => $data['content']
        ));
    }
    /**
     * Permet de charger la vue
     * @param array $viewData
     */
    private function _loadView(array $viewData)
    {
        extract($viewData);
        require ROOT.'views'.DS.$viewData['viewFileName'].'.php';
    }
    /**
     * Permet de convertir en JSON
     * @param $data
     * @return string
     */
    protected function _convertToJson($data)
    {
        return json_encode($data);
    }
    /**
     * Permet de récupérer les données distantes
     * @return string|void
     */
    protected function _getHttpData()
    {
         switch($_SERVER['REQUEST_METHOD'])
         {
             case 'POST':
                 return $_POST;
             break;
             case 'GET':
                 return $_GET;
             break;
             case 'PUT':
                 return file_get_contents('php://input');
         }
        return;
    }
}
