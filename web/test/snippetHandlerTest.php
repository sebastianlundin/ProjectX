<?php
require_once dirname(__FILE__) . '/simpletest/autorun.php';
require_once dirname(__FILE__) . '/../model/SnippetHandler.php';

class SnippetHandlerTest extends unitTestcase
{

    private $mSnippetHandler;

    function __construct()
    {
        $this->mSnippetHandler = new SnippetHandler();
    }

    public function testIfGetSnippetByIDreturnCorrectObject()
    {
        $snippet = $this->mSnippetHandler->getSnippetByID(1);
        $this->assertTrue(is_object($snippet));
        $this->assertEqual(1, $snippet->getID());
    }

}
