<?php
	
	require_once dirname(__FILE__).'/../model/CRUDSnippetModel.php';
	require_once dirname(__FILE__).'/../view/CRUDSnippetView.php';
    require_once dirname(__FILE__).'/../model/DbHandler.php';

	class SnippetController {
		private $mDbHandler = null;
		private $mCRUDSnippetView = null;

		public function __construct() {
			$this->mDbHandler = new DbHandler();
			$this->mCRUDSnippetModel = new CRUDSnippetModel($this->mDbHandler);
			$this->mCRUDSnippetView = new CRUDSnippetView();
		}

		public function listSnippets() {
			    
			if ($this->mCRUDSnippetView->triedToGotoCreateView() == true) {
				return $this->mCRUDSnippetView->createSnippet();
			}
			else if ($this->mCRUDSnippetView->triedTocreateSnippet() == true) {
                $code = $this->mCRUDSnippetView->getCreateSnippetCode();
                $title = $this->mCRUDSnippetView->getSnippetTitle();
                $desc = $this->mCRUDSnippetView->getSnippetDescription();
                $language = $this->mCRUDSnippetView->getSnippetLanguage();
                
			    $snippet = new Snippet('kimsan', $code, $title, $desc, $language);
				$this->mCRUDSnippetModel->createSnippet($snippet);
			}
			else if ($this->mCRUDSnippetView->triedToDeleteSnippet() == true) {
				$this->mCRUDSnippetModel->deleteSnippet($this->mCRUDSnippetView->getSnippetID());
			}
			else if ($this->mCRUDSnippetView->triedToChangeSnippet() == true) {
				return $this->mCRUDSnippetView->updateSnippet($this->mCRUDSnippetModel->getSingleSnippetData($this->mCRUDSnippetView->getSnippetIDLink()));
			}
			else if ($this->mCRUDSnippetView->triedToSaveSnippet() == true) {
				$this->mCRUDSnippetModel($this->mCRUDSnippetView->getUpdateSnippetID, $this->mCRUDSnippetView->getUpdateSnippetName, $this->mCRUDSnippetView->getUpdateSnippetCode);
				echo 'Snippet has been updated!';
			}

			return $this->mCRUDSnippetView->createSnippet();
		}
	}