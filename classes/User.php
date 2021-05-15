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
    private $file_path = "data/uploads/default.png";

    private $genre;
    private $followerId;

    private $newEmail;
    private $newPassword;
    private $newFirstname;
    private $newLastname;
    private $newUsername;
    private $newDateOfBirth;
    private $newBio;

    private $emailError;
    private $passwordError;
    private $ageError;
    private $admin;


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
     * Get the value of followerId
     */
    public function getFollowerId()
    {
        return $this->followerId;
    }

    /**
     * Set the value of followerId
     *
     * @return  self
     */
    public function setFollowerId($followerId)
    {
        $this->followerId = $followerId;

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

    //             new profile info
    /**
     * Get the value of newEmail
     */
    public function getNewEmail()
    {
        return $this->newEmail;
    }

    /**
     * Set the value of newEmail
     *
     * @return  self
     */
    public function setNewEmail($newEmail)
    {
        $this->newEmail = $newEmail;

        return $this;
    }

    /**
     * Get the value of newPassword
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * Set the value of newPassword
     *
     * @return  self
     */
    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    /**
     * Get the value of newFirstname
     */
    public function getNewFirstname()
    {
        return $this->newFirstname;
    }

    /**
     * Set the value of newFirstname
     *
     * @return  self
     */
    public function setNewFirstname($newFirstname)
    {
        $this->newFirstname = $newFirstname;

        return $this;
    }

    /**
     * Get the value of newLastname
     */
    public function getNewLastname()
    {
        return $this->newLastname;
    }

    /**
     * Set the value of newLastname
     *
     * @return  self
     */
    public function setNewLastname($newLastname)
    {
        $this->newLastname = $newLastname;

        return $this;
    }
    /**
     * Get the value of newUsername
     */
    public function getNewUsername()
    {
        return $this->newUsername;
    }

    /**
     * Set the value of newUsername
     *
     * @return  self
     */
    public function setNewUsername($newUsername)
    {
        $this->newUsername = $newUsername;

        return $this;
    }
    /**
     * Get the value of newDateOfBirth
     */
    public function getNewDateOfBirth()
    {
        return $this->newDateOfBirth;
    }

    /**
     * Set the value of newDateOfBirth
     *
     * @return  self
     */
    public function setNewDateOfBirth($newDateOfBirth)
    {
        $this->newDateOfBirth = $newDateOfBirth;

        return $this;
    }

    /**
     * Get the value of newBio
     */
    public function getNewBio()
    {
        return $this->newBio;
    }

    /**
     * Set the value of newBio
     *
     * @return  self
     */
    public function setNewBio($newBio)
    {
        $this->newBio = $newBio;

        return $this;
    }



    public function login(){
        // get user from database
        $dbUser = DB::getUserByEmail($this->getEmail());
        if(!$dbUser){
            return false;
        }

        // compare database password with current password
        if(password_verify($this->getPassword(), $dbUser->getPassword())){
            return true;
        }else{
            return false;
        }

    }



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

    public function follow(){
        echo "Ready for follow 😎";
        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into followers (user_id, follower_id) values ((select id from users where email=:userMail), (select id from users where username=:followerMail))");

        $userId = $this->getId();
        $followerId = $this->getFollowerId();

        var_dump("🥲" . $userId . $followerId);

        $statement->bindValue(":userMail", $userId);
        $statement->bindValue(":followerMail", $followerId);

        $result = $statement->execute();
        return $result;
    }

    public static function completeProfile($user){
        $conn = Db::getConnection();
        $statement = $conn->prepare("
        update users
        SET bio = :bio, profile_img_path = :file_path
        WHERE email = :email;
        ");
        $statement->bindValue(':bio', $user->getBio());
        $statement->bindValue(':file_path', $user->getFile_path());
        $statement->bindValue(':email', $_SESSION['legato-user']->getEmail());

        $result_ = $statement->execute();

    }

    public static function searchUser($search){
        $input = '%'.$search.'%';
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT username FROM users WHERE username LIKE :user");
        $statement->bindValue(':user', $input);
        $statement->execute();
        $searchUserOutput = array();
        $searchUserOutput[] = $statement->fetchall();
        return $searchUserOutput;
    }


    public function checkAge() {
        return true;

        /*$origin = new DateTime($_POST['date_of_birth']);
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
        DB::insertProfileGenre($this->getId(), $this->getGenre());

    }

    public function updateProfile() {
        $conn = Db::getConnection();

        $newFirstname = $this->getNewFirstname();
        $newLastname = $this->getNewLastname();
        $newEmail = $this->getNewEmail();
        $newUsername = $this->getNewUsername();
        $newPassword = password_hash($this->getNewPassword(), PASSWORD_BCRYPT);
        $newDateOfBirth = $this->getNewDateOfBirth();
        // $newBio = $this->getNewBio();

        $statement = $conn->prepare("UPDATE users

        SET email=COALESCE(NULLIF(:newEmail, ''), email), username=COALESCE(NULLIF(:newUsername, ''), username),
        password=COALESCE(NULLIF(:newPassword, ''), password), firstname=COALESCE(NULLIF(:newFirstname, ''), firstname),
        lastname=COALESCE(NULLIF(:newLastname, ''), lastname), date_of_birth=COALESCE(NULLIF(:newDateOfBirth, ''), date_of_birth)
        where email = :email ");

        $statement->bindValue(":newEmail", $newEmail);
        $statement->bindValue(":newUsername", $newUsername);
        $statement->bindValue(":newPassword", $newPassword);
        $statement->bindValue(":newFirstname", $newFirstname);
        $statement->bindValue(":newLastname", $newLastname);
        $statement->bindValue(":newDateOfBirth", $newDateOfBirth);
        $statement->bindValue(":email", $_SESSION['legato-user']->getEmail());

        $statement->execute();

    }

    /**
     * Get the value of admin
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set the value of admin
     *
     * @return  self
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    public function getUserPrivacyStatus(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("
            SELECT profile_private
            FROM users
            WHERE id = :user_id
        ");
        $statement->bindValue(':user_id', $this->getId());
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        // var_dump($result['profile_private']);
        if ($result['profile_private'] == "1"){
            return true;
        }
        else{
            return false;
        }
    }

    public function setUserPrivacyStatus($profilePrivate){
        $conn = Db::getConnection();
        $statement = $conn->prepare("
            UPDATE users
            SET profile_private = :profile_private
            WHERE id = :user_id
        ");
        $statement->bindValue(':user_id', $this->getId());
        if($profilePrivate){
            $statement->bindValue(':profile_private', 1);
        }else{
            $statement->bindValue(':profile_private', 0);
        }
        $result = $statement->execute();
        // var_dump($result);
        return $result;
    }

}
