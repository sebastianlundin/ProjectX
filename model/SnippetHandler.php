<?php

require_once 'DbHandler.php';
require_once 'Snippet.php';

class SnippetHandler {

    private $mDbHandler;
    
    public function __construct() {
        $this->mDbHandler = new DbHandler();
    }    
    
    /**
     * Get all the snippets
     * @return array
     */
    public function getAllSnippets() {
        $snippets = array();
        
        if ($stmt = $this->mDbHandler->PrepareStatement("SELECT * FROM snippet")) {
            $stmt->execute();

            $stmt->bind_result($id, $code, $author, $title, $description, $language);
            while ($stmt->fetch()) {
                $snippet = new Snippet($id, $code, $author ,$title ,$description, $language);
                array_push($snippets, $snippet);
            }

            $stmt->close();
        }
        
        $this->mDbHandler->close();
        
        return $snippets;
    }
}
