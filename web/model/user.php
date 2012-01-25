<?php

class User
{
    private $mUserId = null;
    private $mUserName = null;

    private $_id;
    private $_name;
    private $_username;
    private $_email;

    /**
     * User::__construct()
     *
     * @return new User object
     */
    public function __construct($id, $name, $username, $email)
    {
        $this->_email = $email;
        $this->_name = $name;
        $this->_username = $username;
        $this->_id = $id;
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
     * @return string Currently email adress, since the user doesn't have a username.
     */
    public function getUsername()
    {
        return $this->_username;
    }

}
