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
    private $_data;

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
            //Which profile is shown
            $user = $this->setProfileUser();
            
            //Get data from user 
            $email = $user->getEmail();
            $id = $user->getID();

            //Generate new Api key
            $this->generateApiKey($id, $email);

            //Submenu controll for profile pages
            if ($page = $this->_profileView->getPage()) {
                //Show created snippets by user
                if ($page == 'created') {
                    $this->showCreatedSnippets($id);
                } else if ($page == 'commented') {
                    $this->showCommentedSnippets($id);
                } else if ($page == 'liked') {
                    $this->showLikedSnippets($id);
                } else if ($page == 'disliked') {
                    $this->showDislikedSnippets($id);
                } else if ($page == 'search') {
                    $this->showUserSearch($id);
                } else if($page == 'settings') {
                    $this->showSettingsPage($id);
                } else {
                   $data['content'] = 'hej startsidan'; 
                }
            } else {
                $data['content'] = 'hej startsidan';
            }

            //get stats of userActivities
            $this->setStats($id);
            //Get avatar for user
            $avatar = $this->_gravatarHandler->getProfileGravatar($email);
            $name = $user->getName();
            $html .= $this->_profileView->profile($avatar, $name, $this->data, $user);
        } else {
            header('location: /');
        }

        return $html;
    }

    /**
     * @param $id User id
     * @param $email User email
     */
    private function generateApiKey($id, $email) {
        if (AuthHandler::isOwner($email)) {
            $data['apiKey'] = AuthHandler::getUser()->getApiKey();

            if (!empty($_GET['api_key']) && $_GET['api_key'] == 'generate') {
                $newKey = $this->_userHandler->changeApiKey($id);
                if ($newKey != false) {
                    AuthHandler::getUser()->setApiKey($newKey);
                    $data['apiKey'] = AuthHandler::getUser()->getApiKey();
                } else {
                    echo "Något gick fel när api-key genererades";
                }
            }
        }
    }

    /**
     * Get wich user to be shown
     */
    public function setProfileUser() {
        $user = AuthHandler::getUser(); 
        //Se ifall efterfrågade användaren finns
        if($user->getRole() == 'admin' && isset($_GET['username'])){
            $user = $this->_userHandler->getUserByEmail($_GET['username']);
            
            //Om användaren inte existerar sätt den inloggade användaren
            if(!$user) {
               $user = AuthHandler::getUser();
            }
        }

        return $user;
    }

    /**
     * @param $id User id
     */
    private function setStats($id) {
        $this->data['snippets'] = $this->_snippetHandler->getSnippetsByUser($id);
        $this->data['likes'] = $this->_snippetHandler->getRatedSnippetsByUser($id, 1);
        $this->data['dislikes'] = $this->_snippetHandler->getRatedSnippetsByUser($id, 0);
        $this->data['comments'] = $this->_snippetHandler->getCommentedSnippetByUser($id);
    }

    /**
     * @param $id User id
     */
    private function showCreatedSnippets($id) {
        //Get snippets created by User
        $createdSnippets = $this->_snippetHandler->getSnippetsByUser($id);
        $this->data['content'] = $this->_profileView->createdSnippets($createdSnippets);
    }
    
    /**
     * @param $id User id
     */
    private function showCommentedSnippets($id) {
        //Hämtar snippets som användaren har kommenterat
        $commentedSnippets = $this->_snippetHandler->getCommentedSnippetByUser($id);
        $this->data['content'] = $this->_profileView->commentedSnippets($commentedSnippets);
    }
    
    /**
     * @param $id User id
     */
    private function showLikedSnippets($id) {
        //Show liked snippets by user
        $likedSnippets = $this->_snippetHandler->getRatedSnippetsByUser($id, 1);
        $this->data['content']  = $this->_profileView->likedSnippets($likedSnippets);
    }

    /**
     * @param $id User id
     */
    private function showDislikedSnippets($id) {
        //Show disliked snippets by user
        $dislikedSnippets = $this->_snippetHandler->getRatedSnippetsByUser($id, 0);
        $this->data['content']  = $this->_profileView->dislikedSnippets($dislikedSnippets);
    }

    /**
     * @param $id User id
     */
    private function showSettingsPage($id) {
        //Get settings options for user
        $this->data['content'] = $this->_profileView->settings(); 
    }

    /**
     *Search for a user
     */
    private function showUserSearch() {
        //Search for user 
        $users = null;
        if($query = $this->_profileView->doSearch()) {
            $users = $this->_userHandler->searchUser($query);
        }
        $this->data['content'] = $this->_profileView->searchForUsers($users);
    }

}
