<?php

require_once 'DbHandler.php';
require_once 'Snippet.php';

class SnippetHandler {
	
	private $mDbHandler;
	
	public function __construct() {
		$this->mDbHandler = new DbHandler();
	}
	
	/**
	 *Get a snippet by id
	 * @param int $aID id of a snippet
	 * @return Snippet
	 */
	public function getSnippetByID($aID) {
		$snippet = null;
        if($stmt = $this->mDbHandler->PrepareStatement("SELECT * FROM snippet WHERE id = ?")) {

            $stmt->bind_param("i",$aID);
            $stmt->execute();

            $stmt->bind_result($id, $author, $code, $title, $desc, $language);
            while($stmt->fetch()) {
                $snippet = new Snippet($id,$author,$code,$title,$desc,$language);
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
