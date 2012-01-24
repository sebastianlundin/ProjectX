<?php

require_once dirname(__FILE__) . '/../model/janrain-engage/lib.php';
require_once dirname(__FILE__) . '/../model/janrain-engage/auth.php';
require_once dirname(__FILE__) . '/../model/janrain-engage/config.php';
require_once dirname(__FILE__) . '/../model/userHandler.php';
require_once dirname(__FILE__) . '/../model/AuthHandler.php';

class AuthController
{
    private $_lib;
    private $_auth;
    private $_conf;
    private $_userHandler;

    function __construct()
    {
        $this->_lib = new lib();
        $this->_auth = new auth($this->_lib);
        $this->_conf = new AuthConfig();
        $this->_userHandler = new UserHandler();
    }

    function checkAuthToken()
    {
        $user = null;
        if (!empty($_POST['token'])) {
            $token = $_POST['token'];
            $result = $this->_auth->engage_auth_info($this->_conf->getApiKey(), $token);
            if ($result != false) {
                $result = $this->_lib->engage_parse_result($result);
            }

            if ($result['stat'] == 'ok') {
                $name = $result['profile']['name']['formatted'];
                $email = $result['profile']['email'];
                $identifier = $result['profile']['identifier'];
                $provider = $result['profile']['providerName'];

                if ($result['profile']['providerName'] == 'Twitter') {
                    if (!$this->_userHandler->twitterExists($identifier)) {
                        $this->_userHandler->addUser($identifier, $provider, $name);
                    }
                    $user = $this->_userHandler->getUserByIdentifier($identifier);
                } else {
                    if (!$this->_userHandler->doesUserExist($email)) {
                        $this->_userHandler->addUser($identifier, $provider, $name, $email);
                    }
                    $user = $this->_userHandler->getUserByEmail($email);
                }
                AuthHandler::getInstance()->login($user);

            } else {
                echo "fel uppstod under inlogg";
                return false;
            }
        } else {
            echo "token !isset";
        }
        header('location: index.php');
    }

}
