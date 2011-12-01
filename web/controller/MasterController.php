<?php
require_once dirname(__FILE__).'/../model/SnippetHandler.php';
require_once dirname(__FILE__).'/../view/SnippetView.php';
require_once dirname(__FILE__).'/../model/CommentHandler.php';
require_once dirname(__FILE__).'/../view/CommentView.php';
require_once dirname(__FILE__).'/SnippetController.php';

class MasterController {
    
    private $mSnippetHandler;
    private $mSnippetView;
    private $mCommentHandler;
    private $mCommentView;
    private $mSnippetController;
    private $mHtml;
    
    
    public function __construct() {
        $this->mSnippetHandler = new SnippetHandler();
        $this->mSnippetView = new SnippetView();
        $this->mCommentHandler = new CommentHandler();
        $this->mCommentView = new CommentView();
        $this->mSnippetController = new SnippetController();
        $this->mHtml = '';
    }
    
    public function doControll() {
        session_start();
        
        //user tries to add a comment for a single snippet
        if($this->mCommentView->triedToSubmitComment()) {
            if($this->mCommentView->getCaptchaAnswer() == $_SESSION['security_number']) {
                $this->mCommentHandler->addComment($this->mCommentView->whichSnippetToComment(),$this->mCommentView->getCommentText(),$this->mCommentView->getAuthorId());
            }
        }
        
        //user or admin tries to remove his own snippet (we will know that he has right to do it in a future)
        if($this->mCommentView->triesToRemoveComment()) {
            $this->mCommentHandler->deleteComment($this->mCommentView->whichCommentToDelete());
        }
            
        if($this->mCommentView->triesToUpdateComment()){
            $this->mCommentHandler->updateComment($this->mCommentView->whichCommentToEdit(), $this->mCommentView->getCommentText());
        }
        
        if(isset($_GET['snippet'])) 
        {
            $this->mHtml .= $this->mSnippetView->singleView($this->mSnippetHandler->getSnippetByID($_GET['snippet']));

            if($this->mCommentView->TriesToEditComment())
            {
                $this->mHtml .= $this->mCommentView->EditComment($this->mCommentHandler->getCommentToEditByCommentId($this->mCommentView->whichCommentToEdit()));
            }
            else
            {
                $this->mHtml .= $this->mCommentView->doCommentForm();
            }

            $this->mHtml .= $this->mCommentView->showAllCommentsForSnippet($this->mCommentHandler->getAllCommentsForSnippet($this->mCommentView->whichSnippetToComment()));
        } 
        else if(isset($_GET['page']) && $_GET['page'] == 'addsnippet') 
        {
            $this->mHtml .=$this->mSnippetController->listSnippets();
        } 
        else 
        {
            $this->mHtml = $this->mSnippetView->listView($this->mSnippetHandler->getAllSnippets());
        }

        $this->mHtml .= "<br /><a href='index.php'>Till startsidan</a> <br /><a href='?page=addsnippet'>Add snippet</a>";
        
        return $this->mHtml;
    }
    
}