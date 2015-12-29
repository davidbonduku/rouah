<?php

/**
 * Class OauthController
 */
class OauthController extends CoreController
{
    private $_token = '';
    private $_userModel;

    public function __construct()
    {
        CoreController::checkFileAndLoad(ROOT.'models'.DS.'UsersModel.php');
        $this->_userModel = new UsersModel();
    }

    public function  getAll(){}

    public function  get( $token )
    {
        $this->_setView(array(
            'view' => 'index',
            'content' => $this->_convertToJson(array('token'=>$this->checkToken( $token )))
        ));
    }
    /**
     * CheckToken
     * @param $token
     */
    public function checkToken( $token )
    {
        if(!is_null($token))
        {
            $data = self::$_currentModel->getToken(@mysql_real_escape_string($token));

            return @$data[0]->token;
        }else{
            return;
        }
    }
    /**
     * CheckAccount
     * @param $account array
     */
    private function _checkAccount( $account )
    {
        $cond = "emailUser='".$account['emailUser']."' AND ".
                "passwordUser='".$account['passwordUser']."'";

       if($this->_userModel->isExist($cond))
      {
          $userAccount = $this->_userModel->get(array('emailUser'=> $account['emailUser']));
          $user_id = @$userAccount[0]->idUser;
          $this->_token = $this->_createToken();

          if(!self::$_currentModel->_isExist("user_id=".$user_id))
          {
              self::$_currentModel->add(array( 'token' => $this->_token,'user_id'=> $user_id ) );
              $this->_setView(array(
                  'view' => 'index',
                  'content' => $this->_convertToJson(array('token'=>$this->_token))
              ));
          }else{
              $lastToken = self::$_currentModel->_get(array('user_id' => $user_id));
              $lastToken = @$lastToken[0]->token;
              $this->_setView(array(
                  'view' => 'index',
                  'content' => $this->_convertToJson(array('token'=> $lastToken))
              ));
          }

      }else{
          AppException::show(array(
              'message' => 'Identifiants non reconnus',
              'code' => 03,
              'type' => 'OAuthException'
          ));
      }
    }
    /**
     * Add
     */
    public function add()
    {
        $remote_data = $this->_getHttpData();

       if(!empty( $remote_data['action'] ))
       {
           switch( $remote_data['action'] )
           {
               case 'new_account':
                   $this->_createNewAccount( $remote_data );
                   break;
               case 'check_token':
                   $this->checkToken( $remote_data );
                   break;
               case 'check_account':
                   $this->_checkAccount( $remote_data );
                   break;
           }
       }else{
           AppException::show(array(
               'message' => "Erreur cette ressource n'existe pas",
               'code' => 104
           ));
       }
    }
    /**
     * CreateNewAccount
     * @param $remote_data
     */
    private function _createNewAccount( $remote_data )
    {
        if(!empty($remote_data['emailUser'])&& !empty($remote_data['nameUser']))
        {
            if($this->_userModel->isExist(array(
                    'emailUser' => $remote_data['emailUser']
                )))
            {
                AppException::show(array(
                    'message' => 'Ce compte existe déjà',
                    'code' =>  04,
                    'type' => 'OAuthException'
                ));
            }else{
             unset($remote_data['action']);

                $user_id = $this->_userModel->add($remote_data);
                $this->_token = $this->_createToken();

                self::$_currentModel->add(array(
                    'token' => $this->_token,
                    'user_id' => $user_id
                ));
                $this->_setView(array(
                    'view' => 'index',
                    'content' => $this->_convertToJson(array( 'token' => $this->_token ))
                ));
            }
        }
    }

    /**
     * CreateToken
     * @return string
     */
    private function _createToken()
    {
        return uniqid();
    }

    /**
     * DeleteToken
     * @param $token
     */
    public function delete($token)
    {
        if(!is_null($token))
        {
            self::$_currentModel->delete( $token );
            $this->_setView(array(
                'view' => 'index',
                'content' => $this->_convertToJson(array("message"=>"Operation succed"))
            ));
        }
    }

    /**
     * @param $id
     */
    public function update( $id )
    {

    }

}
