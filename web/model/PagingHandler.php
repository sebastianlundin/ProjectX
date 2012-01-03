<?php

class PagingHandler {
    
    private $_snippets;
    private $_limit;
    private $_page;
    private $_offset;
    private $_totalSnippets;
    private $_totalPages;
    
    public function __construct($snippets, $page, $limit) {
        $this->_snippets = $snippets;
        $this->_page = $page;
        $this->_limit = $limit;
        
        $this->_totalSnippets = count($this->_snippets);
        $this->_totalPages = ceil($this->_totalSnippets / $this->_limit);
    }
    
    /**
    * Sets the offset
    * @param int $offset is the new offset
    */
    public function setOffset($offset) {
           
        $this->_offset = $offset * $this->_limit;
    }
    
    /**
    * Sets the page
    * @param int $page is the new page
    */
    public function setPage($page) {
          
        $this->_page = $page;
    }
    
    /**
    * Returns an array of links
    * @return Array
    */
    public function getLinks() {
           
        if ($this->_totalPages  <= 1) {
            
            return null;
        }else {
            
            for ($i = 0; $i < $this->_totalPages; $i++) {
                
                $links[$i]['num'] = $i + 1;
            }
            
            return $links;    
        }
    }

    /**
    * Returns new pagenumber
    * @return Int 
    */
    public function getPrevious() {
            
        if ($this->_page < 1) {
            
            $this->_page = 1;
        }
        
        return $this->_page - 1;  
    }
    
    /**
    * Returns new pagenumber
    * @return Int
    */
    public function getNext() {
        
        if ($this->_page > $this->_totalPages) {
            
            $this->_page = $this->_totalPages;
        }
        
        return $this->_page + 1;        
    }
    
    /**
    * Returns current position in array
    * @return Array 
    */
    public function fetchSnippets() {
        
        $this->_offset = $this->_page * $this->_limit;
        
        $snippetsToShow = array();
        
        for ($i = $this->_offset; $i < $this->_limit + $this->_offset; $i++) {
            
            array_push($snippetsToShow, $this->_snippets[$i+$this->_offset]);     
        }
        
        return $snippetsToShow;
    }
    
}
