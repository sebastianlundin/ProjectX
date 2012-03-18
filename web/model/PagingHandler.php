<?php

require_once dirname(__file__) . '/../model/DbHandler.php';

class PagingHandler
{
    private $_dbHandler;
    private $_current_page;
    private $_limit;
    private $_offset;
    private $_target_table;
    
    public function __construct($current_page, $limit, $target_table)
    {
        $this->_dbHandler = new DbHandler();
        
        $this->_current_page = $current_page;
        $this->_limit = $limit;
        $this->_target_table = $target_table;
        $this->_offset = ($current_page - 1) / $limit;    
    }
    
    public function getListItems($sqlQuery)
    {
            
    }
}
