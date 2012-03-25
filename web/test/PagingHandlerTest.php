<?php
require_once dirname(__FILE__) . '/simpletest/autorun.php';
require_once dirname(__FILE__) . '/../model/PagingHandler.php';

class PagingHandlerTest extends UnitTestCase 
{
    
    private $_pagingHandler;
    private $_elements;
    private $_offset;
    
    public function __construct() 
    {
        $this->_elements = array("test1", "test2", "test3", "test4", "test5");
        
        $this->_pagingHandler = new PagingHandler($this->_elements, 1, 1);
    }
    
    /**
    * Tests getOffset
    */
    public function TestGetOffset() 
    { 
        $this->assertEqual($this->_pagingHandler->getOffset(), 0);
    }
    
    /**
    * Tests getLimit
    */
    public function TestGetLimit() 
    { 
        $this->assertEqual($this->_pagingHandler->getLimit(), 1);    
    }
    
    /**
    * Tests setOffset
    */
    public function TestSetOffset() 
    { 
        $this->_pagingHandler->setOffset(2);
        $this->assertEqual($this->_pagingHandler->getOffset(), 1);
    }
    
    /**
    * Tests getTotal
    */
    public function TestGetTotal() 
    {
        $this->assertEqual($this->_pagingHandler->getTotal(), 5);
    }

    /**
    * Tests getPrevious
    */
    public function TestGetPrevious() 
    {
        $this->assertEqual($this->_pagingHandler->getNext(), 2);    
    }
    
    /**
    * Tests getNext
    */
    public function TestGetNext() 
    {
        $this->_pagingHandler->setPage(2);
        $this->assertEqual($this->_pagingHandler->getPrevious(), 1);  
    }    
}
