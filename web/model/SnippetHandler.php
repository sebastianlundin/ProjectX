<?php

require_once 'DbHandler.php';
require_once 'Snippet.php';

class SnippetHandler
{

    private $mDbHandler;

    public function __construct()
    {
        $this->mDbHandler = new DbHandler();
    }

    /**
     *Get a snippet by id
     * @param int $aID id of a snippet
     * @return Snippet
     */
    public function getSnippetByID($aID)
    {
        $snippet = null;
        if ($stmt = $this->mDbHandler->PrepareStatement("SELECT * FROM snippet WHERE id = ?")) {

            $stmt->bind_param("i", $aID);
            $stmt->execute();

            $stmt->bind_result($id, $author, $code, $title, $desc, $language);
            while ($stmt->fetch()) {
                $snippet = new Snippet($author, $code, $title, $desc, $language, $id);
            }

            $stmt->close();

        }
        $this->mDbHandler->Close();
        return $snippet;
    }

    /**
     * Get all the snippets
     * @return array
     */
    public function getAllSnippets()
    {
        $snippets = array();

        $this->mDbHandler->__wakeup();
        if ($stmt = $this->mDbHandler->PrepareStatement("SELECT * FROM snippet")) {
            $stmt->execute();

            $stmt->bind_result($id, $code, $author, $title, $description, $language);
            while ($stmt->fetch()) {
                $snippet = new Snippet($code, $author, $title, $description, $language, $id);
                array_push($snippets, $snippet);
            }

            $stmt->close();
        }

        $this->mDbHandler->close();

        return $snippets;
    }

    public function createSnippet(Snippet $aSnippet)
    {
        $this->mDbHandler->__wakeup();
        $author = $aSnippet->getSnippetAuthor();
        $code = $aSnippet->getSnippetCode();
        $title = $aSnippet->getSnippetTitle();
        $desc = $aSnippet->getSnippetDesc();
        $language = $aSnippet->getSnippetLanguage();

        if ($databaseQuery = $this->mDbHandler->PrepareStatement("INSERT INTO snippet (author, code, title, description, language) VALUES (?, ?, ?, ?, ?)")) {
            $databaseQuery->bind_param('sssss', $author, $code, $title, $desc, $language);
            $databaseQuery->execute();
            if ($databaseQuery->affected_rows == null) {
                $databaseQuery->close();
                return false;
            }
            $databaseQuery->close();
        } else {
            return false;
        }

        $this->mDbHandler->close();
        return true;
    }

    public function updateSnippet($aSnippetName, $aSnippetCode, $aSnippetID)
    {
        $databaseQuery = $this->mDbHandler->PrepareStatement("UPDATE SnippetsTable SET snippetName = ?, snippetCode = ? WHERE snippetID = ?");
        $databaseQuery->bind_param('ssi', $$aSnippetName, $aSnippetCode, $aSnippetID);
        $databaseQuery->execute();
        if ($databaseQuery->affected_rows == null) {
            return false;
        }
        $databaseQuery->close();
        return true;
    }

    public function deleteSnippet($aSnippetID)
    {
        $databaseQuery = $this->mDbHandler->PrepareStatement("DELETE FROM SnippetsTable WHERE snippetID = ?");
        $databaseQuery->bind_param('i', $aSnippetID);
        $databaseQuery->execute();
        if ($databaseQuery->affected_rows == null) {
            return false;
        }
        $databaseQuery->close();
    }

}
