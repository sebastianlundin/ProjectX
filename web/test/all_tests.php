<?php
	require_once dirname(__FILE__) . '/simpletest/autorun.php';
	
	/**
	 * 
	 */
	class AllTests extends TestSuite {
		function __construct() {
        	parent::__construct();
<<<<<<< HEAD
<<<<<<< HEAD
			//$this->addFile( dirname(__FILE__) . '/StripSnippetTest.php' );
=======
>>>>>>> f1df19e4a6cdc24529a580b0a46bfc942a60c8b0
=======
>>>>>>> 16ad0e8d4edb2183401217f59f8dca868204980b
            $this->addFile( dirname(__FILE__) . '/snippetHandlerTest.php' );
            $this->addFile( dirname(__FILE__) . '/TestCRUDSnippet.php' );
		}
	}
	
	