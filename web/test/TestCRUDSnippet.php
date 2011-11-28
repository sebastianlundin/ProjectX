<?php

	require_once dirname(__FILE__) . '/../model/CRUDSnippetModel.php';
    require_once dirname(__FILE__) . '/../model/DbHandler.php';
    require_once dirname(__FILE__) . '/../model/Snippet.php';

	class TestCRUDSnippet extends UnitTestCase {
		    
		public function testCreateSnippet() {
		    $dbHandler = new DbHandler();
            $snippet = new Snippet(0,'kim','da code','Title','desc','css');
			$CRUDSnippetModel = new CRUDSnippetModel($dbHandler);
			$this->assertTrue($CRUDSnippetModel->createSnippet($snippet));
		}
	}