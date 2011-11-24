<?php

class Snippet {

<<<<<<< HEAD
	private $mID;
	private $mAuthor;
	private $mCode;
	private $mTitle;
	private $mDesc;
	private $mLanguage;

	public function __construct($aID,$aAuthor,$aCode,$aTitle,$aDesc,$aLanguage) {
		$this->mID = $aID;
		$this->mAuthor = $aAuthor;
		$this->mCode = $aCode;
		$this->mTitle = $aTitle;
		$this->mDesc = $aDesc;
		$this->mLanguage = $aLanguage;
	}
    
	/*
     * @return int ID of the snippet
     */
	public function getID() {
		return $this->mID;
	}
	
    /*
     * @return String The author of the snippet
     */
	public function getAuthor() {
		return $this->mAuthor;
	}
	
    /*
     * @return String The code snippet
     */
	public function getCode() {
		return $this->mCode;
	}
	
    /*
     * @return String title of the snippet
     */
	public function getTitle() {
		return $this->mTitle;
	}
	
    /*
     * @return String description of the snippet
     */
	public function getDesc() {
		return $this->mDesc;
	}
	
    /*
     * @return String language of the snippet
     */
	public function getLanguage() {
		return $this->mLanguage;
	}

}
=======
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
>>>>>>> oskarhallen-master
