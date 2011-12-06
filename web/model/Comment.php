<?php

class Comment
{
    private $mSnippetId = null;
    private $mCommentId = null;
    private $mUserId = null;
    private $mCommentText = null;
    private $mUser = null;

    /**
     * Comment::__construct()
     *
     * @param int $aSnippetId
     * @param int $aCommentId
     * @param int $aUserId
     * @param int $aCommentText
     */
    public function __construct($aSnippetId, $aCommentId, $aUserId, $aCommentText)
    {
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
    public function setUser($aUser)
    {
        $this->mUser = $aUser;
    }

    /**
     * Comment::getUser()
     *
     * @return User object
     */
    public function getUser()
    {
        return $this->mUser;
    }

    /**
     * Comment::getSnippetId()
     *
     * @return int ID of the snippet
     */
    public function getSnippetId()
    {
        return $this->mSnippetId;
    }

    /**
     * Comment::getCommentDate()
     *
     * @return date when the comment where written
     */
    public function getCommentDate()
    {
        return $this->mCommentDate;
    }

    /**
     * Comment::getCommentId()
     *
     * @return int ID of the comment
     */
    public function getCommentId()
    {
        return $this->mCommentId;
    }

    /**
     * Comment::getUserId()
     *
     * @return int ID of the user
     */
    public function getUserId()
    {
        return $this->mUserId;
    }

    /**
     * Comment::getCommentText()
     *
     * @return string; text of the comment
     */
    public function getCommentText()
    {
        return $this->mCommentText;
    }

    /**
     * Comment::getCommentUp()
     *
     * @return int, how many finds the comment usefull
     */
    public function getCommentUp()
    {
        return $this->mCommentUp;
    }

    /**
     * Comment::getCommentDown()
     *
     * @return inte, how many dosn't' find the comment usefull
     */
    public function getCommentDown()
    {
        return $this->mCommentDown;
    }

}
