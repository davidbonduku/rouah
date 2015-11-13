<?php
/**
 * Class AppException
 */
final class AppException
{
    private static $_core;

    public function __construct(){}
    /**
     * Permet d'afficher les erreurs
     * @param array $data
     */
    public static function show(array $data)
    {
        self::$_core = CoreControllerFactory::create();
        self::_setError( $data );
    }
    /**
     * Permet de préparer les données
     * @param array $errorData
     */
    private static function _setError(array $errorData)
    {
        self::$_core->_setView(array(
            'view' => 'index',
            'content' => json_encode( array(
                'error' => array(
                    'message' => $errorData['message'],
                    'type' => 'AppException',
                    'code' => $errorData['code']
                )))));
    }
}