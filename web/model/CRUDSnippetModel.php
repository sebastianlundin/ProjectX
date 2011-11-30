<?php

	require_once dirname(__FILE__) . '/../object/SnippetObject.php';

	class CRUDSnippetModel
	{
		private $mDatabase = null;
	
		public function __construct($aDatabase) {
			$this->mDatabase = $aDatabase;
		}

		public function createSnippet(Snippet $aSnippet) {
		    $this->mDatabase->__wakeup();
            $author = $aSnippet->getAuthor();
            $code = $aSnippet->getCode();
            $title = $aSnippet->getTitle();
            $desc = $aSnippet->getDesc();
            $language = $aSnippet->getLanguage();
            
			if($databaseQuery = $this->mDatabase->PrepareStatement("INSERT INTO snippet (author, code, title, description, language) VALUES (?, ?, ?, ?, ?)")) {
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

            $this->mDatabase->close();
			return true;
		}

		public function updateSnippet($aSnippetName, $aSnippetCode, $aSnippetID) {
			$databaseQuery = $this->mDatabase->PrepareStatement("UPDATE SnippetsTable SET snippetName = ?, snippetCode = ? WHERE snippetID = ?");
			$databaseQuery->bind_param('ssi', $$aSnippetName, $aSnippetCode, $aSnippetID);
			$databaseQuery->execute();
			if ($databaseQuery->affected_rows == null)
			{
				return false;
			}
			$databaseQuery->close();
			return true;
		}

		public function deleteSnippet($aSnippetID) {
			$databaseQuery = $this->mDatabase->PrepareStatement("DELETE FROM SnippetsTable WHERE snippetID = ?");
			$databaseQuery->bind_param('i', $aSnippetID);
			$databaseQuery->execute();
			if ($databaseQuery->affected_rows == null)
			{
				return false;
			}
			$databaseQuery->close();
		}
	}