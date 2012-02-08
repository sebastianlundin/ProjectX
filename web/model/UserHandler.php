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

    /**
     *Check if a user exist in database
     * @param $email string Email adress to check user against
     * @return boolean true if user exist
     */
    public function doesUserExist($email)
    {
        $this->_dbHandler->__wakeup();
        if ($stmt = $this->_dbHandler->PrepareStatement("SELECT * FROM user_auth WHERE email = ?")) {

            $stmt->bind_param("s", $email);
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

    /**
     * Adds a user
     * @param $identifier string
     * @param $provider string
     * @param $name string
     * @param $email string
     * @return boolean true if succsess
     */
    public function addUser($identifier, $provider, $name, $email = 'null')
    {
        $this->_dbHandler->__wakeup();
        $insertedKey = -1;

        //@TODO ÄNDRA OM TILL TRANSAKTIONER OM MÖJLIGT
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

    /**
     *Delete a user from database
     * @param int id of a user
     * @return boolean true if succsess
     */
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

    /**
     * Get user from database by email
     * @param $email string
     * @return User
     */
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

    public function getUsernameByID($id)
    {
        $authorName = 'errorName';
        $this->_dbHandler->__wakeup();
        if ($stmt = $this->_dbHandler->prepareStatement("SELECT name FROM user WHERE id = ?")) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->bind_result($name);
            while ($stmt->fetch()) {
                $authorName = $name;
            }
            $authorName = $name;
            $stmt->close();
        } else {
            return false;
        }
        $this->_dbHandler->close();
        return $authorName;
    }

    /**
     * Get user from database by identifier
     * @param $identifier string
     * @return User
     */
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

    /**
     *Check if a user exist in database
     * @param $identifier string Identifier to check user against
     * @return boolean true if user exist
     */
    public function twitterExists($identifier)
    {
        $this->_dbHandler->__wakeup();
        if ($stmt = $this->_dbHandler->PrepareStatement("SELECT * FROM user_auth WHERE identifier = ?")) {

            $stmt->bind_param("s", $identifier);
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

}
