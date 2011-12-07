<?php
require_once dirname(__FILE__) . '/../model/SnippetHandler.php';
require_once dirname(__FILE__) . '/../view/SnippetView.php';
require_once dirname(__FILE__) . '/../model/DbHandler.php';
require_once dirname(__FILE__) . '/../controller/CommentController.php';
require_once dirname(__FILE__) . '/../model/CommentHandler.php';
require_once dirname(__FILE__) . '/../view/CommentView.php';

class SnippetController
{
    private $mDbHandler;
    private $mSnippetHandler;
    private $mSnippetView;
    private $mHtml;
    private $mCommentController;

    public function __construct(){
        
        $this->mDbHandler = new DbHandler();
        $this->mSnippetHandler = new SnippetHandler($this->mDbHandler);
        $this->mSnippetView = new SnippetView();
        $this->mCommentController = new CommentController($this->mDbHandler);
        $this->mHtml = '';
    }
    public function doControll(){  
        
        if (isset($_GET['snippet'])) {
            
            $this->mHtml .= $this->mSnippetView->singleView($this->mSnippetHandler->getSnippetByID($_GET['snippet']));
            $this->mHtml .= "<br /><a href='index.php'>Till startsidan</a>";
            $this->mHtml .= $this->mCommentController->doControll();
        }
        else{
            
            $this->mHtml .= $this->mSnippetView->listView($this->mSnippetHandler->getAllSnippets());
            $this->mHtml .= "<br /><a href='?page=addsnippet'>Add snippet</a>";
        }
        
        if(isset($_GET['page']) && $_GET['page'] == 'addsnippet'){
            
            $this->mHtml = null;
            $this->mHtml .= $this->mSnippetView->createSnippet();
            $this->mHtml .= "<br /><a href='index.php'>Till startsidan</a>";
                    
            if ($this->mSnippetView->triedToCreateSnippet()) {
                
                $snippet = new Snippet( 'kimsan', 
                                        $this->mSnippetView->getCreateSnippetCode(), 
                                        $this->mSnippetView->getSnippetTitle(), 
                                        $this->mSnippetView->getSnippetDescription(), 
                                        $this->mSnippetView->getSnippetLanguage());
                $this->mSnippetHandler->createSnippet($snippet);
            }
        }
 
        return $this->mHtml;
    }
    
      public  function listSnippets(){
        
         if ($this->mSnippetView->triedToGotoCreateView() == true) {
             return $this->mSnippetView->createSnippet();
         } else if ($this->mSnippetView->triedTocreateSnippet() == true) {
             $snippet = new Snippet(    'kimsan', 
                                        $this->mSnippetView->getCreateSnippetCode(), 
                                        $this->mSnippetView->getSnippetTitle(), 
                                        $this->mSnippetView->getSnippetDescription(), 
                                        $this->mSnippetView->getSnippetLanguage());
             $this->mSnippetHandler->createSnippet($snippet);

         } else if ($this->mSnippetView->triedToDeleteSnippet() == true) {
             $this->mSnippetHandler->deleteSnippet($this->mSnippetView->getSnippetID());
         } else if ($this->mSnippetView->triedToChangeSnippet() == true) {
             return $this->mSnippetView->updateSnippet($this->mSnippetHandler->getSingleSnippetData($this->mSnippetView->getSnippetIDLink()));
         } else if ($this->mSnippetView->triedToSaveSnippet() == true) {
             $this->mSnippetHandler($this->mSnippetView->getUpdateSnippetID, $this->mSnippetView->getUpdateSnippetName, $this->mSnippetView->getUpdateSnippetCode);
             echo 'Snippet has been updated!';
         }
          return $this->mSnippetView->createSnippet();
      }
 }  