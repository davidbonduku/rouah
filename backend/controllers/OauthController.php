<?php

class OauthController extends CoreController
{


    public function add()
    {
       if (self::$_currentModel->add($this->_getHttpData()))
        {
            echo "session demarée";
        }

        else{

             echo "utilisateur non reconnu";
        }
    }



    public function start_session()
    {
        session_start();
        //$_SESSION ['login_user']= $username;
        //echo $username;
    }

}
