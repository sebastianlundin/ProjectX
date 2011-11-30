<?php
class CommentController  
{
    private $m_database = NULL;
    
    public function __construct(DatabaseConnection $database)
    {
      $this->m_database = $database;
    }
	
	public function DoControll()
    {
        $xhtml = "";
        
        $commentHandler = new CommentHandler($this->m_database);
        $commentView = new CommentView();
        
        if($commentView->triesToEditComment())
        {
            $xhtml .= $commentView->editComment($commentHandler->getCommentToEditByCommentId($commentView->whichCommentToEdit()));
        }
        else
        {
            $xhtml .= $commentView->doCommentForm();
        }
        
        if($commentView->triedToSubmitComment() == true)
        {
			//Denna if-sats är tillagd för att kontrollera Captcha-svaret
			if($commentView->GetCaptchaAnswer() == $_SESSION['security_number']) {
			   //adderar inlägget till databasen, filtruje ev. html taggar+RealEscapeString innan jag sparar i db
			   $text = $commentView->getCommentText();
			   $text = $this->m_database->RealEscapeString($text);
			   $author = $commentView->getAuthorId();
			   $author = $this->m_database->RealEscapeString($author);
               $snippetId = $commentView->whichSnippetToComment();
               $commentHandler->addComment($snippetId, $text, $author);
		   }        
        }
/**
*          sedan får man kolla med rättigheter så att man kan ta bort en kommentar, antingen är man:
*           -admin
*           -author
*           -kommentaren har fått många(hur måånga?) röster ner
*/      
        if($commentView->triesToRemoveComment())
        {
            $commentHandler->deleteComment($commentView->whichCommentToDelete());
        }
        
        if($commentView->triesToUpdateComment())
        {
            $commentHandler->updateComment($commentView->whichCommentToEdit(),$commentView->getCommentText());
        }
        
        $xhtml .= $commentView->showAllComments($commentHandler->getAllCommentsForSnippet($commentView->whichSnippetToComment()));
        return $xhtml;
    }
	
}
