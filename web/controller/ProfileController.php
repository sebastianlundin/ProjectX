<?php

require_once dirname(__FILE__) . '/../view/ProfileView.php';
require_once dirname(__FILE__) . '/../model/GravatarHandler.php';
require_once dirname(__FILE__) . '/../model/UserHandler.php';

class ProfileController
{

    private $_profileView;
    private $_userHandler;
    private $_gravatarHandler;

    public function __construct()
    {
        $this->_profileView = new ProfileView();
        $this->_userHandler = new UserHandler();
        $this->_gravatarHandler = new GravatarHandler();
    }

    public function doControll()
    {
        $html = '';
        if (AuthHandler::isLoggedIn()) {
            //Get info and stats of a user
            $email = AuthHandler::getUser()->getEmail();
            $id = AuthHandler::getUser()->getID();
            $avatar = $this->_gravatarHandler->getProfileGravatar($email);
            $stats['comments'] = $this->_userHandler->nrOfComments($id);
            $stats['snippets'] = $this->_userHandler->nrOfSnippets($id);
            $stats['likes'] = $this->_userHandler->nrOfLikes($id);
            $stats['dislikes'] = $this->_userHandler->nrOfDislikes($id);

            if (AuthHandler::isOwner($email)) {
                $html .= $this->_profileView->profile($avatar,$stats);
            }
        } else {

        }
        return $html;
    }

}
