<?php
/**
 * Class CoreController
 */
class CoreController
{
    protected static $_currentModel;
    /**
     * Permet de charger un contrôleur et d'instancier son modèle associé
     * @param $controllerName
     * @return mixed
     */
   static function loadController($controllerName)
    {
        if( self::_checkFileAndLoad(ROOT.'controllers'.DS.$controllerName.'Controller.php') )
        {
            self::loadModel( $controllerName );
        }
    }
    /**
     * Permet de passer les données à la vue
     * @param array $data
     */
    public function _setView(array $data)
    {
        $this->_loadView(array(
                                'viewFileName' => $data['view'],
                                'content' => $data['content'])
        );
    }
    /**
     * Permet de charger la vue
     * @param array $viewData
     */
    private function _loadView(array $viewData)
    {
        ob_start();
        extract($viewData);
        require_once ROOT.'views'.DS.$viewData['viewFileName'].'.php';
        ob_clean();
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
    /**
     * Permet de charger le modèle
     * @param $modelName
     */
    static function loadModel($modelName)
    {
        if(self::_checkFileAndLoad(ROOT.'models'.DS.$modelName.'Model.php'))
        {
            $currentModel = $modelName.'Model';
            self::$_currentModel = new $currentModel();
        }
    }
    /**
     * Verifie si le fichier existe et le charge
     * @param $fileName
     * @return bool
     */
    private static function _checkFileAndLoad( $fileName )
    {
        if(file_exists($fileName))
        {
            require_once $fileName;

            return true;
        }
        return false;
    }
}