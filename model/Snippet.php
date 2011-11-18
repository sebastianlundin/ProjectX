<?php

class Snippet {

	private $mID;
	private $mAuthor;
	private $mCode;
	public $mTitle;
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
	
	public function getID() {
		return $this->mID;
	}
	
	public function getAuthor() {
		return $this->mAuthor;
	}
	
	public function getCode() {
		return $this->mCode;
	}
	
	public function getTitle() {
		return $this->mTitle;
	}
	
	public function getDesc() {
		return $this->mDesc;
	}
	
	public function getLanguage() {
		return $this->mLanguage;
	}

}
