<?php

require_once dirname(__file__) . '/../model/AuthHandler.php';

class CommentController
{
    private $_dbHandler = NULL;

    public function __construct()
    {
        $this->_dbHandler = new DbHandler();
    }

    public function doControll()
    {
        $html = "<h2>Comments</h2>";
        $commentHandler = new CommentHandler($this->_dbHandler);
        $commentView = new CommentView();

        if (AuthHandler::isLoggedIn()) {
            if ($commentView->triedToSubmitComment()) {
                $text = $commentView->getCommentText();
                $author = AuthHandler::getUser()->getId();
                $id = $commentView->whichSnippetToComment();
                
                if ($commentView->getCaptchaAnswer() == $_SESSION['security_number']) {
                    $commentHandler->addComment($id, $text, $author);
                }
            }

            if ($commentView->triesToRemoveComment()) {
                $commentHandler->deleteComment($commentView->whichCommentToDelete());
            }

            if ($commentView->triesToUpdateComment()) {
                $commentHandler->updateComment($commentView->whichCommentToEdit(), $commentView->getCommentText());
            }

            if ($commentView->triesToEditComment()) {
                $html .= $commentView->editComment($commentHandler->getCommentByID($commentView->WhichCommentToEdit()));
            } else {
                $html .= $commentView->doCommentForm();
            }
        }

        $html .= $commentView->showAllCommentsForSnippet($commentHandler->getAllCommentsForSnippet($commentView->whichSnippetToComment()));
        
        return $html;
    }

}
