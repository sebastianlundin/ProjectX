<?php

require_once 'DbHandler.php';
require_once 'Snippet.php';

class SnippetHandler {
	
	private $mDbHandler;
	
	public function __construct() {
		$this->mDbHandler = new DbHandler();
	}
	
	/*
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
}
