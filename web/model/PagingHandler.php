<?php

class PagingHandler {
    
    private $mObj;
    private $mNumberOfRows;
    private $mCurrentPage;
    private $mNumberOfPages;
    private $mOffset;
    private $mNumberOfObjects;
    
    public function __construct($aObj, $aNumberOfRows, $aCurrentPage) {
        $this->mObj = $aObj;
        $this->mNumberOfRows = $aNumberOfRows;
        $this->mCurrentPage = $aCurrentPage;
        
        $this->init();
    }
    
    public function init() {
        $this->mNumberOfObjects = count($this->mObj);
        $this->mOffset = ($this->mOffset - 1) * $this->mNumberOfRows;
        
        if($this->mOffset < 0) {
            $this->mOffset = 0;
        }
    }
    
    public function getPagenumbers() {
        $this->mNumberOfPages = ceil($this->mNumberOfObjects / $this->mNumberOfRows);
        if ($this->mNumberOfPages <= 1) {
            return null; 
        }
        else {
            for($i = 0; $i < $this->mNumberOfPages; $i++) {
                $pageNumbers[$i] = $i + 1;
            }
            return $pageNumbers;
        }
    } 
    
    public function getPreviousLink() {
        if(($this->mCurrentPage - 1) < 0) {
            return false;
        }
        
        return $this->mCurrentPage - 1;
    }
    
    public function getNextLink() {
        if($this->mCurrentPage * $this->mNumberOfRows >= $this->mNumberOfObjects) {
            return false;
        }
        
        return $this->mCurrentPage + 1;
    }
    
    public function getCurrentPositions() {
        $mNumberOfRows = $this->mNumberOfRows + $this->mOffset;
        
        if($mNumberOfRows > $this->mNumberOfObjects) {
            $mNumberOfRows = $this->mNumberOfObjects;
        }
        
        $mCurrentPositions = array();
        
        for($i = $this->mOffset; $i < $this->mNumberOfRows; $i++) {
            $mCurrentPositions[] = $this->mObj[$i];
        }
    }
}
