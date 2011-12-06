<?php

class Comment
{
    private $_snippetId = null;
    private $_commentId = null;
    private $_userId = null;
    private $_commentText = null;
    private $_user = null;

    /**
     * Comment::__construct()
     *
     * @param int $aSnippetId
     * @param int $aCommentId
     * @param int $aUserId
     * @param int $aCommentText
     */
    public function __construct($snippetId, $commentId, $userId, $commentText)
    {
        $this->_snippetId = $snippetId;
        $this->_commentId = $commentId;
        $this->_userId = $userId;
        $this->_commentText = $commentText;
    }

    /**
     * Comment::setUser()
     * settr User object
     * @param User
     */
    public function setUser($user)
    {
        $this->_user = $user;
    }

    /**
     * Comment::getUser()
     *
     * @return User object
     */
    public function getUser()
    {
        return $this->_user;
    }

    /**
     * Comment::getSnippetId()
     *
     * @return int ID of the snippet
     */
    public function getSnippetId()
    {
        return $this->_snippetId;
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
        return $this->_commentId;
    }

    /**
     * Comment::getUserId()
     *
     * @return int ID of the user
     */
    public function getUserId()
    {
        return $this->_userId;
    }

    /**
     * Comment::getCommentText()
     *
     * @return string; text of the comment
     */
    public function getCommentText()
    {
        return $this->_commentText;
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
