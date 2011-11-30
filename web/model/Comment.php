<?php

class Comment
{
    private $mSnippetId = NULL;
    //private $mCommentDate = NULL;
    private $mCommentId = NULL;
    private $mUserId = NULL;
    private $mCommentText = NULL;
    //private $mCommentUp = NULL;
    //private $mCommentDown = NULL;
    private $mUser = NULL;
	
//	public function __construct($aSnippetId, $aCommentDate, $aCommentId, $aUserId, $aCommentText, $aCommentUp, $aCommentDown) 
//    {
//        $this->mSnippetId = $aSnippetId;
//		    $this->mCommentDate = $aCommentDate;
//		$this->mCommentId = $aCommentId;
//        $this->mUserId = $aUserId;
//        $this->mCommentText = $aCommentText;
//        $this->mCommentUp = $aCommentUp;
//        $this->mCommentDown = $aCommentUp;
//        
//	}
    /**
     * Comment::__construct()
     * 
     * @param mixed $aSnippetId
     * @param mixed $aCommentId
     * @param mixed $aUserId
     * @param mixed $aCommentText
     */
    public function __construct($aSnippetId, $aCommentId, $aUserId, $aCommentText) {
        $this->mSnippetId = $aSnippetId;
		$this->mCommentId = $aCommentId;
        $this->mUserId = $aUserId;
        $this->mCommentText = $aCommentText;
	}
    
    /**
     * Comment::setUser()
     * settr User object
     * @param User
     */
    public function setUser($aUser){
        $this->mUser = $aUser;
    }
    
    /**
     * Comment::getUser()
     * 
     * @return User object
     */
    public function getUser(){
        return $this->mUser;
    }

    /**
     * Comment::getSnippetId()
     * 
     * @return int ID of the snippet
     */
    public function getSnippetId() {
        return $this->mSnippetId;
    }
	
	/**
	 * Comment::getCommentDate()
	 * 
	 * @return date where the comment where written
	 */
	public function getCommentDate() {
		return $this->mCommentDate;
	}

	/**
	 * Comment::getCommentId()
	 * 
	 * @return int ID of the comment
	 */
	public function getCommentId() {
		return $this->mCommentId;
	}
    
    /**
     * Comment::getUserId()
     * 
     * @return int ID of the user
     */
    public function getUserId(){
        return $this->mUserId;         
    }
    
    /**
     * Comment::getCommentText()
     * 
     * @return string; text of the comment
     */
    public function getCommentText(){
        return $this->mCommentText;
    }
    
    /**
     * Comment::getCommentUp()
     * 
     * @return int, how many finds the comment usefull
     */
    public function getCommentUp(){
        return $this->mCommentUp;
    }
    
    /**
     * Comment::getCommentDown()
     * 
     * @return inte, how many dosn't' find the comment usefull
     */
    public function getCommentDown(){
        return $this->mCommentDown;
    }
}
