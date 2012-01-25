<?php

require_once 'DbHandler.php';
require_once 'Comment.php';
require_once 'User.php';

class CommentHandler
{

    private $_dbHandler;

    public function __construct()
    {
        $this->_dbHandler = new DbHandler();
    }

    /**
     * CommentHandler::getAllCommentsForSnippet()
     *
     * @return an array with all comments for one snippet
     * together with data of the User object
     */
    public function getAllCommentsForSnippet($snippetId)
    {

        $commentsArray = array();
        $sqlQuery = "SELECT comment.snippet_id, comment.id, comment.comment, user.name, user.id
                        FROM comment
                        INNER JOIN user 
                        ON user.id= comment.user_id
                        WHERE comment.snippet_id = ?
                        ORDER by comment.id DESC
        ";
        
        if ($stmt = $this->_dbHandler->PrepareStatement($sqlQuery)) {
            $stmt->bind_param('i', $snippetId);
            $stmt->execute();
            $stmt->bind_result($snippetId, $commentId, $commentText, $username, $userId);

            
            while ($stmt->fetch()) {
                $comment = new Comment($snippetId, $commentId, $userId, $commentText);
                $comment->setUsername($username);
                array_push($commentsArray,$comment);
            }
            $stmt->close();
        }
        
        return $commentsArray;
    }

    /**
     * CommentHandler::addComment()
     *
     * @return true if successful
     * use it if you want to add a new commet för a snippet
     * @param snippetId, commentText and userId
     */
    public function addComment($snippetId, $commentText, $userId)
    {
        echo "addComment";
        $sqlQuery = "INSERT INTO comment (snippet_id, comment, user_id) VALUES(?,?,?)";
        if ($stmt = $this->_dbHandler->PrepareStatement($sqlQuery)) {
            $stmt->bind_param("isi", $snippetId, $commentText, $userId);
            $stmt->execute();
            $stmt->close();
            return true;
        } else {
            return false;
        }
    }

    /**
     * CommentHandler::updateComment()
     *
     * @return true if successful
     * use it if you want to update a comment that exists in the database
     * @param commentId, commentText
     */
    public function updateComment($commentId, $commentText)
    {

        $sqlQuery = "UPDATE comment SET comment = ? WHERE id = ?";

        if ($stmt = $this->_dbHandler->PrepareStatement($sqlQuery)) {
            $stmt->bind_param("si", $commentText, $commentId);

            if ($stmt->execute()) {
                $stmt->close();
                return true;
            }
        }
        return false;
    }

    /**
     * CommentHandler::deleteComment()
     *
     * @return true if successful
     * use it if you want to delete a comment
     * @param an id of the comment to delete
     */
    public function deleteComment($commentId)
    {

        $sqlQuery = "DELETE FROM comment WHERE id=?";

        if ($stmt = $this->_dbHandler->PrepareStatement($sqlQuery)) {
            $stmt->bind_param("i", $commentId);

            if ($stmt->execute()) {
                $stmt->close();
                return true;
            }
        }
        return false;
    }

    /**
     * CommentHandler::removeAllComments()
     *
     * @return true if successful
     * taking away all comments from the db
     */
    public function removeAllComments()
    {

        $sqlQuery = "DELETE FROM comment";

        if ($stmt = $this->_dbHandler->PrepareStatement($sqlQuery)) {
            $stmt->execute();
            $stmt->close();
            return true;
        }
        return false;
    }

    /**
     * CommentHandler::getCommentToEditByCommentId()
     *
     * @return Comment object to edit
     * @param id of the comment you want to edit
     *
     */
    public function getCommentByID($commentId)
    {

        $sqlQuery = "   SELECT comment.snippet_id, comment.id, comment.comment, comment.user_id, user.username
                        FROM comment
                        INNER JOIN user ON user.id = comment.user_id
                        WHERE comment.id = ?
                    ";
        $stmt = $this->_dbHandler->PrepareStatement($sqlQuery);
        $stmt->bind_param('i', $commentId);
        $stmt->execute();
        $stmt->bind_result($snippetId, $commentId, $commentText, $userId, $username);

        $comment = null;

        if ($stmt->fetch()) {
            $comment = new Comment($snippetId, $commentId, $userId, $commentText);
        }
        $stmt->close();

        return $comment;
    }

}
