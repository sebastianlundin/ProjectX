<?php

/**
<<<<<<< HEAD
 * file Functions.php
 *
 * @author   Pontus <bopontuskarlsson@hotmail.com>
 * @version  1.0
 * @category projectX
 * @package  ProjectX
 */

/**
 * @see DbHandler.php
 */
require_once ('application/helpers/DbHandler.php');

/**
 * Snippets class
 * 
 * All functions in the api that handles snippets plural
 *
 * @author   Pontus
 * @version  1.0
 * @category projectX
 * @package  ProjectX
 */
class Snippets
{

    private $mDbHandler;

    public function index()
    {
        $this->mDbHandler = new DbHandler();

        if (isset($_GET['lang']))
            return $this->getLang($_GET['lang']);

        return $this->getAllSnippets();

=======
 * @see DbHandler.php
 */
require_once ('application/helpers/DbHandler.php');
/**
 * @see SnippetObject.php
 */
require_once ('SnippetObject.php');

/**
 * Snippets class
 * 
 * <p>Creates snippet objects of REQUEST parameters.<br/>
 * It then dynamiclly build a query, that is used<br/>  
 * to get the requested data from the database.<br/>
 * Returns an array of snippets that is presented as Json<br/>
 * or XML with help of the restler API.<br/>
 * Example usage:</p>
 * 
 * <ol>
 *      <li>   
 *          /snippets<br/>
 *          Get all snippets in Json format
 *      </li> 
 *      <li>
 *          /snippets.xml?language=php&datefrom=20100101&dateto=20110101<br/>
 *          Get all Php snippets created between two dates in XML format<br/>
 *      </li>  
 *      <li>
 *          /snippets?language=csharp&sort=rating<br/>
 *          Get all C# snippets sorted on rating in Json format
 *      </li>     
 *      <li>
 *          /snippets.xml?lang=csharp&username=cesarsnipp&sort=title<br/>
 *          Get all C# snippets from user with username cesarsnipp sorted on title in Json format
 *      </li>     
 * </ol> 
 * 
 * Url Parameters
 * <ul>
 *      <li>sort = [language, title, description, code, username, id, date, rating]</li>
 *      <li>[language, title, description, code, username, id, date, rating] = ?</li>
 *      <li>datefrom = format(YYYY-MM-DD) && dateto = format(YYYY-MM-DD)</li>
 *      <li>date = format(YYYY-MM-DD)</li>
 * </ul>
 * 
 * @author   Pontus <bopontuskarlsson@hotmail.com>
 * @author   Tomas <tompen@telia.com>
 * @version  1.0
 * @category projectX
 * @package  ProjectX
 */
class Snippets
{
    private $_dbHandler;
    private $_snippetObject;

    /**
     * Snippets::__construct()
     * 
     * @return
     */
    public function __construct()
    {
        $this->_dbHandler = new DbHandler();
        $this->_snippetObject = new SnippetObject();
>>>>>>> upstream/master
    }

    /**
     * Snippets::index()
     * 
     * @return Array $snippets
     */
    public function index()
    {
<<<<<<< HEAD
        $snippet = null;
        if ($stmt = $this->mDbHandler->PrepareStatement("SELECT * FROM snippet WHERE id = ?"))
        {

            $stmt->bind_param("i", $aID);
            $stmt->execute();

            $stmt->bind_result($id, $author, $code, $title, $desc, $language);
            while ($stmt->fetch())
            {
                $snippet = new Snippet($author, $code, $title, $desc, $language, $id);
=======
        foreach ($_REQUEST as $action => $value) {
            if (is_array($this->_snippetObject->__isset('_' . $action))) {
                return $this->_snippetObject->__isset('_' . $action);
            } else {
                $this->_snippetObject->__set('_' . $action, $value);
>>>>>>> upstream/master
            }
        }
<<<<<<< HEAD
        $this->mDbHandler->Close();
        return $snippet;
    }

    //----------------Temp function---------------------------------
    public function getLang($lang)
    {
        $snippets = array();

        $this->mDbHandler->__wakeup();
        if ($stmt = $this->mDbHandler->PrepareStatement("SELECT * FROM snippet WHERE language = ?"))
        {
            $stmt->bind_param("s", $lang);
            $stmt->execute();

            $stmt->bind_result($id, $code, $author, $title, $description, $language);
            while ($stmt->fetch())
            {
                //$snippet = new SnippetObject($code, $author, $title, $description, $language, $id);
                $snippet = array('code' => $code, 'author' => $author, 'title' => $title,
                    'description' => $description, 'language' => $language, 'id' => $id);
                array_push($snippets, $snippet);
            }

            $stmt->close();
        }

        $this->mDbHandler->close();

        return $snippets;
    }
    //-----------------------------------------------------

    /**
     * Get all the snippets
     * @return array
     */
    public function getAllSnippets()
    {
=======

>>>>>>> upstream/master
        $snippets = array();
        $select = $this->_snippetObject->select();

<<<<<<< HEAD
        $this->mDbHandler->__wakeup();
        if ($stmt = $this->mDbHandler->PrepareStatement("SELECT * FROM snippet"))
        {
            $stmt->execute();

            $stmt->bind_result($id, $code, $author, $title, $description, $language);
            while ($stmt->fetch())
            {
                //$snippet = new SnippetObject($code, $author, $title, $description, $language, $id);
                $snippet = array('code' => $code, 'author' => $author, 'title' => $title,
                    'description' => $description, 'language' => $language, 'id' => $id);
=======
        $this->_dbHandler->__wakeup();
        if ($stmt = $this->_dbHandler->PrepareStatement($select[0])) {
            if ($select[1] != '') {
                call_user_func_array('mysqli_stmt_bind_param', array_merge(array($stmt, $select[1]), $select[2]));
            }
            $stmt->execute();

            $stmt->bind_result($id, $userId, $code, $title, $description, $languageId, $date,
                $ratingId, $userId, $snippetId, $rating, $rating_created_date, $userId, $username,
                $email, $password, $apikey, $languageid, $language);
            while ($stmt->fetch()) {
                $snippet = array('language' => $language, 'title' => $title, 'description' => $description,
                    'code' => $code, 'username' => $username, 'id' => $id, 'date' => $date, 'rating' =>
                    $rating);
>>>>>>> upstream/master
                array_push($snippets, $snippet);
            }

            $stmt->close();
        }
        $this->_dbHandler->close();

<<<<<<< HEAD
        $this->mDbHandler->close();

        return $snippets;
    }

    public function createSnippet(Snippet $aSnippet)
    {
        $this->mDbHandler->__wakeup();
        $author = $aSnippet->getAuthor();
        $code = $aSnippet->getCode();
        $title = $aSnippet->getTitle();
        $desc = $aSnippet->getDesc();
        $language = $aSnippet->getLanguage();

        if ($databaseQuery = $this->mDbHandler->PrepareStatement("INSERT INTO snippet (author, code, title, description, language) VALUES (?, ?, ?, ?, ?)"))
        {
            $databaseQuery->bind_param('sssss', $author, $code, $title, $desc, $language);
            $databaseQuery->execute();
            if ($databaseQuery->affected_rows == null)
            {
                $databaseQuery->close();
                return false;
            }
            $databaseQuery->close();
        } else
        {
            return false;
        }

        $this->mDbHandler->close();
        return true;
    }

    public function updateSnippet($aSnippetName, $aSnippetCode, $aSnippetID)
    {
        $databaseQuery = $this->mDbHandler->PrepareStatement("UPDATE SnippetsTable SET snippetName = ?, snippetCode = ? WHERE snippetID = ?");
        $databaseQuery->bind_param('ssi', $$aSnippetName, $aSnippetCode, $aSnippetID);
        $databaseQuery->execute();
        if ($databaseQuery->affected_rows == null)
        {
            return false;
        }
        $databaseQuery->close();
        return true;
    }

    public function deleteSnippet($aSnippetID)
    {
        $databaseQuery = $this->mDbHandler->PrepareStatement("DELETE FROM SnippetsTable WHERE snippetID = ?");
        $databaseQuery->bind_param('i', $aSnippetID);
        $databaseQuery->execute();
        if ($databaseQuery->affected_rows == null)
        {
            return false;
=======
        if (count($snippets) > 0) {
            return $snippets;
        } else {
            throw new RestException(404);
>>>>>>> upstream/master
        }
    }
}
