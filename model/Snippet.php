<?php

class Snippet {

    private $mID;
    private $mCode;
    private $mAuthor;
    private $mTitle;
    private $mDescription;
    private $mLanguage;
    
    public function __construct($aID, $aAuthor, $aCode, $aTitle, $aDescription, $aLanguage) {
        $this->mID = $aID;
        $this->mAuthor = $aAuthor;
        $this->mCode = $aCode;
        $this->mTitle = $aTitle;
        $this->mDesc = $aDescription;
        $this->mLanguage = $aLanguage;
    }
    
    public function getID() {
        return $this->mID;
    }
    
    public function getCode() {
        return $this->mCode;
    }
    
    public function getAuthor() {
        return $this->mAuthor;
    }
    
    public function getTitle() {
        return $this->mTitle;
    }
    
    public function getDescription() {
        return $this->mDescription;
    }
    
    public function getLanguage() {
        return $this->mLanguage;
    }

}