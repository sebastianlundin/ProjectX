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
            $user = AuthHandler::getUser();
            $email = $user->getEmail();
            $id = $user->getID();
            $name = $user->getName();
            $avatar = $this->_gravatarHandler->getProfileGravatar($email);

            $data['apiKey'] = AuthHandler::getUser()->getApiKey();
            $data['snippets'] = $this->_snippetHandler->getSnippetsByUser($id);
            $data['likes'] = $this->_snippetHandler->getRatedSnippetsByUser($id, 1);
            $data['dislikes'] = $this->_snippetHandler->getRatedSnippetsByUser($id, 0);
            $data['comments'] = $this->_snippetHandler->getCommentedSnippetByUser($id);

            if ($page = $this->_profileView->getPage()) {
                if ($page == 'created') {
                    $createdSnippets = $this->_snippetHandler->getSnippetsByUser($id);
                    $data['content'] = $this->_profileView->createdSnippets($createdSnippets);
                } else if ($page == 'commented') {
                    $commentedSnippets = $this->_snippetHandler->getCommentedSnippetByUser($id);
                    $data['content'] = $this->_profileView->commentedSnippets($commentedSnippets);
                } else if ($page == 'liked') {
                    $likedSnippets = $this->_snippetHandler->getRatedSnippetsByUser($id, 1);
                    $data['content']  = $this->_profileView->likedSnippets($likedSnippets);
                } else if ($page == 'disliked') {
                    $dislikedSnippets = $this->_snippetHandler->getRatedSnippetsByUser($id, 0);
                    $data['content']  = $this->_profileView->dislikedSnippets($dislikedSnippets);
                } else if ($page == 'users') {
                    
                    $users = null;
                    if($query = $this->_profileView->doSearch()) {
                        $users = $this->_userHandler->searchUser($query);
                    }                  
                    $data['content'] = $this->_profileView->searchForUsers($users);
                } else if($page == 'settings') {
                    $data['content'] = $this->_profileView->settings();
                }
            } else {
                $data['content'] = 'hej startsidan';
            }

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

                $html .= $this->_profileView->profile($avatar, $name, $data, $user);
            }
        } else {

        }

        return $html;
    }

}
