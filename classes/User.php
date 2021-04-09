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


    public function register()
    {
        $conn = Db::getConnection();

        $email = $this->getEmail();
        $firstname = $this->getFirstname();
        $lastname = $this->getLastname();
        $username = $this->getUsername();
        $password = password_hash($this->getPassword(), PASSWORD_BCRYPT);
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
                    $password = $this->getPassword();
                    // $passwordConf = $this->getPasswordConf();
                    // UIT IF($_POST) HALEN
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $statement = $conn->prepare("insert into users (email, username, password) values(:email, :username, :password)");
                        $statement->bindValue(":email", $email);
                        $statement->bindValue(":username", $username);
                        $statement->bindValue(":password", $password);
                        $statement->execute();

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
            
                            header('Location: completeProfile.php');
                        }       
                    } else {
                        $this->setEmailError("Sorry, this is not a valid email");
                    }
                }
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function completeProfile()
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("INSERT INTO profiles (bio, profile_img_path) VALUES (:bio, :avatar);");
        $statement->bindValue(":bio", $this->getBio());
        $statement->bindValue(":avatar", $this->getAvatar());
        $statement->execute();









        /*
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }    
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) { // 62KB
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }    
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }*/
        
    }
}
