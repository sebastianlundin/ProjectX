<?php
require_once 'SnippetHandler.php';

class Snippet
{

    private $_id;
    private $_authorID;
    private $_author;
    private $_code;
    private $_title;
    private $_desc;
    private $_language;
    private $_languageID;

    public function __construct($authorID, $code, $title, $desc, $languageID, $id = null)
    {
        if ($id != null) {
            $this->_id = $id;
        }
        $this->_authorID = $authorID;
        $this->_code = $code;
        $this->_title = $title;
        $this->_desc = $desc;
        $this->_languageID = $languageID;

        $sh = new SnippetHandler();
        $lang = $sh->getLanguageByID($this->_languageID);
        $this->_language = $lang['name'];

        $uh = new UserHandler();
        $this->_author = $uh->getUsernameByID($this->_authorID);        
    }

    /**
     * @return int ID of the snippet
     */
    public function getID()
    {
        return $this->_id;
    }

    /**
     * @return int The author id of the snippet
     */
    public function getAuthorId()
    {
        return $this->_authorID;
    }

    /**
     * @return int The author id of the snippet
     */
    public function getAuthor()
    {
        return $this->_author;
    }

    /**
     * @return String The code snippet
     */
    public function getCode()
    {
        return $this->_code;
    }

    /**
     * @return String title of the snippet
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @return String description of the snippet
     */
    public function getDesc()
    {
        return $this->_desc;
    }

    /**
     * @return String language of the snippet
     */
    public function getLanguage()
    {
        return $this->_language;
    }

    /**
     * @return int id of language
     */
    public function getLanguageID()
    {
        return $this->_languageID;

    }

}
