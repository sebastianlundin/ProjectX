<?php

require_once 'DbHandler.php';
require_once 'User.php';

class UserHandler
{

    private $_dbHandler;

    public function __construct()
    {
        $this->_dbHandler = new DbHandler();
    }

    public function doesUserExist($email)
    {
        $this->_dbHandler->__wakeup();
        if ($stmt = $this->_dbHandler->PrepareStatement("SELECT * FROM user_auth WHERE email = ?")) {

            $stmt->bind_param("i", $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                return true;
            }

            $stmt->close();

        } else {
            return null;
        }
        $this->_dbHandler->Close();
        return false;
    }

    public function addUser($identifier, $provider, $name, $email = 'null')
    {
        $this->_dbHandler->__wakeup();
        $insertedKey = -1;

        //@TODO ÄNDRA OM TILL TRANSAKTIONER!!111!1!
        //Insert data into user table
        if ($stmt = $this->_dbHandler->PrepareStatement("INSERT INTO User (username, name) VALUES (?, ?)")) {
            $stmt->bind_param('ss', $email, $name);
            $stmt->execute();
            if ($stmt->affected_rows == null) {
                $stmt->close();
                $this->_dbHandler->close();
                return false;
            }
            $insertedKey = $stmt->insert_id;
            $stmt->close();
        } else {
            $this->_dbHandler->close();
            return false;
        }

        //Insert data into user_auth table whith key from user table
        if ($stmt = $this->_dbHandler->PrepareStatement("INSERT INTO user_auth (email, provider, identifier, user_id) VALUES (?,?,?,?)")) {
            $stmt->bind_param('sssi', $email, $provider, $identifier, $insertedKey);
            $stmt->execute();
            if ($stmt->affected_rows == null) {
                $stmt->close();
                $this->_dbHandler->close();
                return false;
            }
            $stmt->close();
        } else {
            $this->_dbHandler->close();
            return false;
        }

        $this->_dbHandler->close();
        return true;
    }

    public function deleteUser($id)
    {
        $stmt = $this->_dbHandler->PrepareStatement("DELETE FROM User WHERE userID = ?");
        $stmt->bind_param('i', $snippetID);
        $stmt->execute();
        if ($stmt->affected_rows == null) {
            $stmt->close();
            $this->_dbHandler->close();
            return false;
        }
        $stmt->close();
        $this->_dbHandler->close();

        return true;
    }

    public function getUserByEmail($email)
    {
        $user = null;
        $this->_dbHandler->__wakeup();
        if ($stmt = $this->_dbHandler->PrepareStatement("SELECT user.id, user.name, user.username ,auth.email
                                                        FROM `user` as user
                                                        INNER JOIN user_auth as auth
                                                        ON user.id = auth.user_id
                                                        WHERE auth.email = ?")) {
            $stmt->bind_param('s', $email);
            $stmt->execute();

            $stmt->bind_result($id, $name, $username, $email);
            while ($stmt->fetch()) {
                $user = new User($id, $name, $username, $email);
            }

            $stmt->close();
        }
        $this->_dbHandler->close();
        
        return $user;
    }

    public function getUserByIdentifier($identifier)
    {
        $user = null;
        $this->_dbHandler->__wakeup();
        if ($stmt = $this->_dbHandler->PrepareStatement("SELECT user.id, user.name, user.username ,auth.email
                                                        FROM `user` as user
                                                        INNER JOIN user_auth as auth
                                                        ON user.id = auth.user_id
                                                        WHERE auth.identifier = ?")) {
            $stmt->bind_param('s', $identifier);
            $stmt->execute();

            $stmt->bind_result($id, $name, $username, $email);
            while ($stmt->fetch()) {
                $user = new User($id, $name, $username, $email);
            }

            $stmt->close();
        }
        $this->_dbHandler->close();

        return $user;
    }

    public function twitterExists($identifier)
    {
        $this->_dbHandler->__wakeup();
        $userExist = false;
        if ($stmt = $this->_dbHandler->PrepareStatement("SELECT * FROM user_auth WHERE identifier = ?")) {

            $stmt->bind_param("i", $identifier);
            $stmt->execute();

            if ($stmt->num_rows > 0) {
                $userExist = true;
            }

            $stmt->close();

        } else {
            return null;
        }
        $this->_dbHandler->Close();
        return $userExist;
    }

    public function mergeUser()
    {

    }

}
