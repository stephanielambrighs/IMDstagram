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
    private $file_path = "";

    private $genre;

    private $emailError;
    private $passwordError;


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
     * Get the value of file_path
     */ 
    public function getFile_path()
    {
        return $this->file_path;
    }

    /**
     * Set the value of file_path
     *
     * @return  self
     */ 
    public function setFile_path($file_path)
    {
        $this->file_path = $file_path;

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
     * Get the value of genre
     */ 
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set the value of genre
     *
     * @return  self
     */ 
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }



    /**
     * Get the value of emailError
     */ 
    public function getEmailError()
    {
        return $this->emailError;
    }

    /**
     * Set the value of emailError
     *
     * @return  self
     */ 
    public function setEmailError($emailError)
    {
        $this->emailError = $emailError;

        return $this;
    }
    /**
     * Get the value of passwordError
     */ 
    public function getPasswordError()
    {
        return $this->passwordError;
    }
    /**
     * Set the value of passwordError
     *
     * @return  self
     */ 
    public function setPasswordError($passwordError)
    {
        $this->passwordError = $passwordError;

        return $this;
    }

    // =========================================
    //
    // =========================================


    public function register($user)
    {
        $conn = Db::getConnection();

        $email = $this->getEmail();
        $firstname = $this->getFirstname();
        $lastname = $this->getLastname();
        $username = $this->getUsername();
        $password = password_hash($this->getPassword(), PASSWORD_BCRYPT);
        // $profile_id = $this->getId();
        $dateOfBirth = $this->getDateOfBirth();

        // email validation
        try {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $statement = $conn->prepare("select email from users where email = ?");
                $statement->bindValue(1, $email);
                $statement->execute();

                if ($statement->rowCount() > 0) {
                    $this->setEmailError("Email is already in use");
                   // throw new Exception("EMAIL IS ALREADY IN USE"); // email is already in use
                    
                } else {
                    $statement = $conn->prepare("insert into users (email, username, password, firstname, lastname, date_of_birth) 
                    values(:email, :username, :password, :firstname, :lastname, :date_of_birth)");

                    if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,}$/', $this->getPassword()))
                    {
                        $this->setPasswordError("Password requires min. 8 characters and number(s) (0-9)");
                    } else {
                        $statement->bindValue(":email", $email);
                        $statement->bindValue(":username", $username);
                        $statement->bindValue(":password", $password);
                        $statement->bindValue(":firstname", $firstname);
                        $statement->bindValue(":lastname", $lastname);
                        $statement->bindValue(":date_of_birth", $dateOfBirth);
                        $statement->execute();
                        // var_dump($profile_id);
        
                        header('Location: completeProfile.php');
                    }
                }       
            } else {
                $this->setEmailError("Sorry, this is not a valid email");
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    /*public function completeProfile($email)
    {
        echo "yallah " . $email;
        $conn = Db::getConnection();
        $statement = $conn->prepare("INSERT INTO profiles (bio, profile_img_path, user_id) VALUES (:bio, :avatar, (SELECT id FROM users WHERE email = :email));");
        $statement->bindValue(":bio", $this->getBio());
        $statement->bindValue(":avatar", $this->getAvatar());
        $statement->bindValue(":email", $email);
        $statement->execute();

        //header('Location: index.php');
        
    }*/

    public function addProfileGenres()
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("INSERT INTO profile_genre (profile_id, genre_id) VALUES (:profile_id, :genre_id);");
        $statement->bindValue(":profile_id", $this->getId()); // not correct
        $statement->bindValue(":genre_id", $this->getGenre()); // not correct
        $statement->execute();   
    }
}
