<?php

class User
{
    private $mUserId = null;
    private $mUserName = null;

    private $_id;
    private $_name;
    private $_username;
    private $_email;
    private $_apiKey;
    private $_role;

    /**
     * User::__construct()
     *
     * @return new User object
     */
    public function __construct($id, $name, $username, $email, $apiKey, $role)
    {
        $this->_id = $id;
        $this->_name = $name;
        $this->_username = $username;
        $this->_email = $email;
        $this->_apiKey = $apiKey;
        $this->_role = $role;
    }

    /**
     * @return int ID of user
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     *@return string Name of user
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return string User email adress
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @return string Username
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @return string Role of a user
     */
    public function getRole()
    {
        return $this->_role;
    }

    /**
     * @return int Api key
     */
    public function getApiKey()
    {
        return $this->_apiKey;
    }

    /**
     * @param int Api key
     */
    public function setApiKey($apiKey)
    {
        $this->_apiKey = $apiKey;
    }

    /**
     * @return bool true if user is admin
    */
    public function isAdmin() 
    {
        if($this->_role == 'admin') {
            return true;
        }
        return false;    
    }

}
