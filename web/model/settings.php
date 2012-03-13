<?php

class Settings
{
    private $_dbname = "";
    private $_password = "";
    private $_host = "";
    private $_username = "";

    public function __construct()
    {
//        $this->_dbname = "maxstudio_se";
//        $this->_password = "fFTyUhzc";
//        $this->_host = "localhost";
//        $this->_username = "maxstudio_se";
//        $this->_dbname = "longislanddiver";
//        $this->_password = "87TDufgU";
//        $this->_host = "longislanddivers.com.mysql";
//        $this->_username = "longislanddiver";
            $this->_dbname = "lillansgardiner";
            $this->_password = "4cKMLj3j";
            $this->_host = "lillansgardiner.se.mysql";
            $this->_username = "lillansgardiner";
    }

    /**
     * return database name
     * @return string
     */
    public function GetDbName()
    {
        return $this->_dbname;
    }

    /**
     * return database password
     * @return string
     */
    public function GetPassword()
    {
        return $this->_password;
    }

    /**
     * return database hostname
     * @return string
     */
    public function GetHost()
    {
        return $this->_host;
    }

    /**
     * return database usernme
     * @return string
     */
    public function GetUsername()
    {
        return $this->_username;
    }

}
