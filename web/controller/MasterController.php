<?php
require_once dirname(__FILE__) . '/../model/SnippetHandler.php';
require_once dirname(__FILE__) . '/../view/SnippetView.php';
require_once dirname(__FILE__) . '/SnippetController.php';
require_once dirname(__FILE__) . '/SearchController.php';

class MasterController
{
    private $_snippetController;
    private $_searchController;
    private $_html;

    public function __construct()
    {
        $this->_snippetController = new SnippetController();
        $this->_searchController = new SearchController();
        $this->_html = '';
    }

    public function doControll()
    {
        session_start();
        if (isset($_GET['page'])) {
            if ($_GET['page'] == 'listsnippets') {
                $this->_html .= $this->_snippetController->doControll('list');
            }
            else if ($_GET['page'] == 'addsnippet') {
                $this->_html .= $this->_snippetController->doControll('add');
            }
            else if($_GET['page'] == 'search') {
                            
                $this->_html .= $this->_searchController->doControll();
            }
        }else {
            $this->_html .= $this->_searchController->doControll();
        }
        
        return $this->_html;
    }

}
