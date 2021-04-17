<?php
include_once(__DIR__ . "/Db.php");

date_default_timezone_set("Europe/Brussels");
//echo "The time is " . date("h:i:sa");

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
    private $ageError;


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
    /**
     * Get the value of ageError
     */ 
    public function getAgeError()
    {
        return $this->ageError;
    }

    /**
     * Set the value of ageError
     *
     * @return  self
     */ 
    public function setAgeError($ageError)
    {
        $this->ageError = $ageError;

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
                $statement = $conn->prepare("select email from users where email = :email");
                $statement->bindValue(':email', $email);
                $statement->execute();

                if ($statement->rowCount() > 0) {
                    $this->setEmailError("Email is already in use");
                   // throw new Exception("EMAIL IS ALREADY IN USE"); // email is already in use
                    
                } else {
                    $statement = $conn->prepare("insert into users (email, username, password, firstname, lastname, date_of_birth) 
                    values(:email, :username, :password, :firstname, :lastname, :date_of_birth)");

                    /*Between start -> ^
                        And end -> $
                        of the string there has to be at least one number -> (?=.*\d)
                        and at least one letter -> (?=.*[A-Za-z])
                        and it has to be a number, a letter or one of the following: !@#$% -> [0-9A-Za-z!@#$%]
                        and there have to be 8-12 characters -> {8,12} */
                    if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,}$/', $this->getPassword()))
                    {
                        $this->setPasswordError("Password requires min. 8 characters and number(s) (0-9)");
                    } else {
                        // date_of_birth validation
                        if ($this->checkAge() == true) {
                            // old enough
                            $statement->bindValue(":email", $email);
                            $statement->bindValue(":username", $username);
                            $statement->bindValue(":password", $password);
                            $statement->bindValue(":firstname", $firstname);
                            $statement->bindValue(":lastname", $lastname);
                            $statement->bindValue(":date_of_birth", $dateOfBirth);
                            $statement->execute();
                            // var_dump($profile_id);
            
                            header('Location: completeProfile.php');
                        } else {
                            // set age error
                            $this->setAgeError("You must be 13 years or older");
                        }
                    }
                }       
            } else {
                $this->setEmailError("Sorry, this is not a valid email");
            }
        } catch (Exception $e) {
            echo $e;
        }
    }
    public function checkAge() {
        return true;
        /*
        $origin = new DateTime($_POST['date_of_birth']);
        $target = new DateTime('d-m-Y');
        $interval = $origin->diff($target);
        $result = $interval->format('%R%y');
        if ($result >= 6) {
            return true;
        } else {
            return false;
        }*/
    }

    public function addProfileGenres()
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("INSERT INTO profile_genre (profile_id, genre_id) VALUES (:profile_id, :genre_id);");
        $statement->bindValue(":profile_id", $this->getId()); // not correct
        $statement->bindValue(":genre_id", $this->getGenre()); // not correct
        $statement->execute();   
    }
}
