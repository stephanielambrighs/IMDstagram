<?php
include_once(__DIR__ . "/Db.php");

class User
{
    private $id;
    private $email;
    private $firstname;
    private $lastname;
    private $username;
    private $password;
    private $avatar;
    private $bio;
    private $dateOfBirth;

    private $emailUsedError;

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
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

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
     * Get the value of avatar
     */ 
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set the value of avatar
     *
     * @return  self
     */ 
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get the value of bio
     */ 
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set the value of bio
     *
     * @return  self
     */ 
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get the value of dateOfBirth
     */ 
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set the value of dateOfBirth
     *
     * @return  self
     */ 
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }
    /**
     * Get the value of emailUsedError
     */ 
    public function getEmailUsedError()
    {
        return $this->emailUsedError;
    }

    /**
     * Set the value of emailUsedError
     *
     * @return  self
     */ 
    public function setEmailUsedError($emailUsedError)
    {
        $this->emailUsedError = $emailUsedError;

        return $this;
    }

    // =========================================
    //
    // =========================================


    public function register()
    {
        $conn = Db::getConnection();

        $email = $this->getEmail();
        $firstname = $this->getFirstname();
        $lastname = $this->getLastname();
        $username = $this->getUsername();
        $password = password_hash($this->getPassword(), PASSWORD_BCRYPT);
        $avatar = $this->getAvatar();
        $bio = $this->getBio();
        $dateOfBirth = $this->getDateOfBirth();
       


       // UIT IF($_POST) HALEN

       // try catch {
       //   valid email (db)
       //   valid date_of_birth (db)
       //   password hash
       // } 

            // email validation
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $statement = $conn->prepare("select email from users where email = ?");
                $statement->bindValue(1, $email);
                $statement->execute();

                if ($statement->rowCount() > 0) {
                    echo "EMAIL IS ALREADY IN USE";
                    $this->setEmailUsedError("Email is already in use");
                } else {
                    $statement = $conn->prepare("insert into users (email, username, password, img_user_directory, first_name, last_name, bio, date_of_birth) 
                    values(:email, :username, :password, :avatar, :firstname, :lastname, :bio, :date_of_birth)");
                    $statement->bindValue(":email", $email);
                    $statement->bindValue(":username", $username);
                    $statement->bindValue(":password", $password);
                    $statement->bindValue(":avatar", $avatar);
                    $statement->bindValue(":firstname", $firstname);
                    $statement->bindValue(":lastname", $lastname);
                    $statement->bindValue(":bio", $bio);
                    $statement->bindValue(":date_of_birth", $dateOfBirth);
                    $statement->execute();

                    header('Location: completeProfile.php');
                }
            } else {
                echo "NOT A VALID EMAIL";
            }
        
    }

    public function completeProfile()
    {


        
    }


    

    
}
