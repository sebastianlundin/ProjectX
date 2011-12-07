<?php

class Snippet
{

    private $mID;
    private $mAuthor;
    private $mCode;
    private $mTitle;
    private $mDesc;
    private $mLanguage;

    public function __construct($aAuthor, $aCode, $aTitle, $aDesc, $aLanguage, $aID = null)
    {
        if ($aID != null) {
            $this->mID = $aID;
        }
        $this->mAuthor = $aAuthor;
        $this->mCode = $aCode;
        $this->mTitle = $aTitle;
        $this->mDesc = $aDesc;
        $this->mLanguage = $aLanguage;
    }

    /**
     * @return int ID of the snippet
     */
    public function getSnippetId()
    {
        return $this->mID;
    }

    /**
     * @return String The author of the snippet
     */
    public function getSnippetAuthor()
    {
        return $this->mAuthor;
    }

    /**
     * @return String The code snippet
     */
    public function getSnippetCode()
    {
        return $this->mCode;
    }

    /**
     * @return String title of the snippet
     */
    public function getSnippetTitle()
    {
        return $this->mTitle;
    }

    /*
     * @return String description of the snippet
     */
    public function getSnippetDesc()
    {
        return $this->mDesc;
    }

    /*
     * @return String language of the snippet
     */
    public function getSnippetLanguage()
    {
        return $this->mLanguage;
    }

}
