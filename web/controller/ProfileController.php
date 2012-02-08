<?php

require_once dirname(__FILE__) . '/../view/ProfileView.php';
require_once dirname(__FILE__) . '/../model/GravatarHandler.php';
require_once dirname(__FILE__) . '/../model/UserHandler.php';

class ProfileController
{

    private $_profileView;
    private $_userHandler;
    private $_gravatarHandler;
    private $_snippetHandler;
    private $_commentHandler;

    public function __construct()
    {
        $this->_profileView = new ProfileView();
        $this->_userHandler = new UserHandler();
        $this->_gravatarHandler = new GravatarHandler();
        $this->_snippetHandler = new SnippetHandler();
        $this->_commentHandler = new CommentHandler();

    }

    public function doControll()
    {
        $html = '';
        if (AuthHandler::isLoggedIn()) {
            //Get info and stats of a user
            $email = AuthHandler::getUser()->getEmail();
            $id = AuthHandler::getUser()->getID();
            $name = AuthHandler::getUser()->getName();
            $avatar = $this->_gravatarHandler->getProfileGravatar($email);

            $data['apiKey'] = AuthHandler::getUser()->getApiKey();
            $data['snippets'] = $this->_snippetHandler->getSnippetsByUser($id);
            $data['likes'] = $this->_snippetHandler->getRatedSnippetsByUser($id, 1);
            $data['dislikes'] = $this->_snippetHandler->getRatedSnippetsByUser($id, 0);

            //Borde vara get Snippets by comments written by logged in user
            //Eller en sådan också
            $data['comments'] = $this->_snippetHandler->getCommentedSnippetByUser($id);

            if (AuthHandler::isOwner($email)) {

                if (!empty($_GET['api_key']) && $_GET['api_key'] == 'generate') {
                    $newKey = $this->_userHandler->changeApiKey($id);
                    if ($newKey != false) {
                        AuthHandler::getUser()->setApiKey($newKey);
                        $data['apiKey'] = AuthHandler::getUser()->getApiKey();
                    } else {
                        echo "Något gick fel när api-key genererades";
                    }
                }

                $html .= $this->_profileView->profile($avatar, $name, $data);
            }
        } else {

        }

        return $html;
    }

}
