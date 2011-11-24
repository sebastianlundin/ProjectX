<?php

require_once dirname(__FILE__).'/../model/SnippetHandler.php';
require_once dirname(__FILE__).'/../view/SnippetView.php';

class MasterController {
    
    private $mSnippetHandler;
    private $mSnippetView;
    private $mHtml;
    
    public function __construct() {
        $this->mSnippetHandler = new SnippetHandler();
        $this->mSnippetView = new SnippetView();
        $this->mHtml = '';
    }
    
    public function doControl() {
        if(isset($_GET['snippet'])) {
            $this->mHtml = $this->mSnippetView->singleView($this->mSnippetHandler->getSnippetByID($_GET['snippet']));
        } else {
            $this->mHtml = $this->mSnippetView->listView($this->mSnippetHandler->getAllSnippets());
        }
        
        return $this->mHtml;
    }
}

