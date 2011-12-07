<?php
require_once dirname(__FILE__) . '/../model/SnippetHandler.php';
require_once dirname(__FILE__) . '/../view/SnippetView.php';
require_once dirname(__FILE__) . '/SnippetController.php';

class MasterController
{
    private $mSnippetController;
    private $mHtml;
    
    public function __construct()
    {
        $this->mSnippetController = new SnippetController();
        $this->mHtml = '';
    }
    //I Master Controllen ska bara andra controller istanseras som behövs vis starten av applikationen
    //alla andra controllers instanseras senare vid behov
    public function doControll(){
      session_start();
      
      $this->mHtml .= $this->mSnippetController->doControll();
      return $this->mHtml;
    }
}