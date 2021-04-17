<?php
include_once(__DIR__ . "/Db.php");

class User
{
    private $id;
    private $email;
    private $username;
    private $password;
    private $passwordConf;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of passwordConf
     */ 
    public function getPasswordConf()
    {
        return $this->passwordConf;
    }

    /**
     * Set the value of passwordConf
     *
     * @return  self
     */ 
    public function setPasswordConf($passwordConf)
    {
        $this->passwordConf = $passwordConf;

        return $this;
    }




    public function registerUser()
    {
        //$conn = Db::getConnection();
        $conn = Db::getConnection();
        var_dump($conn);

        /**TO ADD PDO EXCEPTION CONNECTION FAILED */

        /**bind values */

        $email = $this->getEmail();
        $username = $this->getUsername();
        $password = $this->getPassword();
        $passwordConf = $this->getPasswordConf();
       


       // UIT IF($_POST) HALEN
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $statement = $conn->prepare("insert into users (email, username, password) values(:email, :username, :password)");
            $statement->bindValue(":email", $email);
            $statement->bindValue(":username", $username);
            $statement->bindValue(":password", $password);
            $statement->execute();

        }
    }
    
    public function searchUser(){
        $conn = Db::getConnection();
        $searchInput = $this->getUsername();
        $statement = $conn->prepare("SELECT username FROM users WHERE username LIKE '%$searchInput%'");
        //$statement->bindValue(":username", $searchInput);
        $statement->execute();
        $searchOutput = array();
        $searchOutput[] = $statement->fetch();
        var_dump($searchOutput);
    }





}
