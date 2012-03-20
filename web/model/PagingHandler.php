<?php

class PagingHandler {
    
    private $_elements;
    private $_limit;
    private $_page;
    private $_offset;
    private $_totalElements;
    private $_totalPages;
    private $_links;
    
    public function __construct($elements, $page, $limit) {
        $this->_elements = $elements;
        $this->_page = $page;
        $this->_limit = $limit;
        
        $this->_totalElements = count($this->_elements);
        $this->_totalPages = ceil($this->_totalElements / $this->_limit);
    }
    
    /**
    * Sets the offset
    * @param int $offset is the new offset
    */
    public function setOffset($offset) { 
        $this->_offset = ($offset - 1) * $this->_limit;
    }
    
    /**
    * Returns the offset
    * @param int
    */
    public function getOffset() { 
        return $this->_offset;
    }
    
    /**
    * Returns the limit
    * @param int
    */
    public function getLimit() { 
        return $this->_limit;
    }
   
    /**
    * Sets the page
    * @param int $page is the new page
    */
    public function setPage($page) {
        $this->_page = $page;
    }
    
    /**
    * Returns the total amount of pages
    * @return int
    */
    public function getTotal() {
        return $this->_totalPages; 
    }
    
    /**
    * Returns all the links
    * @return Array
    */
    public function getLinks() {
        for ($i = 1; $i <= $this->_totalPages; $i++) {
            $this->_links[$i] = $i;
        }
        
        return $this->_links;    
    }
    
    /**
    * Returns links before active page
    * @return Array
    */
    public function getBeforeLinks() {
        for ($i = ($this->_page - 3); $i <= ($this->_page - 1); $i++) {
            $beforeLinks[$i] = $i;
        }
        
        return $beforeLinks;    
    }
    
    /**
    * Returns links after active page
    * @return Array
    */
    public function getAfterLinks() {
        for ($i = ($this->_page + 1); $i <= ($this->_page + 3); $i++) {
            $afterLinks[$i] = $i;
        }
        
        return $afterLinks;    
    }

    /**
    * Returns new pagenumber
    * @return Int 
    */
    public function getPrevious() {
        if ($this->_page - 1 == 0) {
            $this->_page = 1;
            
            return $this->_page;
        }
        return $this->_page - 1;  
    }
    
    /**
    * Returns new pagenumber
    * @return Int
    */
    public function getNext() {
        if ($this->_page + 1 > $this->_totalPages) {
            
            return $this->_totalPages;
        }
        return $this->_page + 1;        
    }    
}
