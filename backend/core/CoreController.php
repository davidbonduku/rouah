<?php

/**
 * Class CoreController
 */
 class CoreController
 {
     protected static $_currentModel;
     private static $_currentController;
     /**
      * Permet de charger un contrôleur et d'instancier son modèle associé
      * Permet de charger un controlleur
      * @param $controllerName
      * @return mixed
      */
     static function loadController($controllerName)
     {
        if( self::checkFileAndLoad(ROOT.'controllers'.DS.$controllerName.'Controller.php') )
        {
                self::$_currentController = strtolower($controllerName);
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
             'content' => $data['content'],
             'viewFileName' => $data["view"],
            ));
     }
     /**
      * Permet de charger la vue
      * @param array $viewData
      */
     private function _loadView(array $viewData)
     {
         ob_start();
         extract($viewData);
         ob_clean();
         require_once ROOT.'views'.DS.$viewData['viewFileName'].'.php';

     }
     /**
      * Permet de convertir en JSON
      * @param array $data
      * @return string
      */
     protected function _convertToJson( array $data )
     {
         return json_encode(array(
             self::$_currentController => $data
         ));
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
                 return fopen('php://input','r');
         }
         return;
     }
     /**
       * Permet de charger le modèle
      * @param $modelName
       */
      static function loadModel($modelName)
     {
         if(self::checkFileAndLoad(ROOT.'models'.DS.$modelName.'Model.php'))
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
     public static function checkFileAndLoad( $fileName )
     {
         if(file_exists($fileName))
         {
             require $fileName;
             return true;
         }
         return false;
     }
 }
