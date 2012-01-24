<?php

require_once dirname(__FILE__) . '/../model/AuthHandler.php';
require_once dirname(__FILE__) . '/../view/HeaderView.php';

class HeaderController
{
    private $_headerView;
    private $_html;

    public function __construct()
    {
        $this->_headerView = new HeaderView();
        $this->_html = '';
    }

    public function doControll()
    {
        $user = AuthHandler::getInstance()->getUser();
        if ($user != null) {
            $this->_html = $this->_headerView->inloggedHeader($user->getName());
        } else {
            $this->_html = $this->_headerView->notLoggedInHeader();
        }
        
        return $this->_html;
    }

}
