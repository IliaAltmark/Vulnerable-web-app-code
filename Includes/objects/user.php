<?php header('Content-Type: text/html; charset=utf-8');

require_once('database.php');

class User
{
    private $user_id;
    private $username;
    private $password;
    private $firstName;
    private $lastName;
    private $isAdmin;

    public static function fetch_all_users()
    {
        global $database;
        $users = $database->query("select * from users");

        return $users;
    }

    private function has_attribute($attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($attribute, $object_properties);
    }

    private function instantation($user_array)
    {
        foreach ($user_array as $attribute => $value) {
            if ($result = $this->has_attribute($attribute))
                $this->$attribute = $value;
        }
    }

    public function find_user_by_username($username)
    {
        global $database;
        $userName = strtolower($username);
        $result_set = $database->query("select * from users where username='$username'");
        $found_user = $result_set->fetch_assoc(); //retrieve all data as an array!

        if ($found_user == null)
            return false;

        $this->instantation($found_user);
        return $this;
    }

    public function find_user_by_user_id($userID)
    {
        global $database;
        $result_set = $database->query("select * from users where user_id=$userID");
        $found_user = $result_set->fetch_assoc();

        if ($found_user == null)
            return false;

        $this->instantation($found_user);
        return $this;
    }

    public static function authenticate_user($username, $password)
    {
        global $database;
        $userName = strtolower($username);
        $found_user = new user;
        $found_user->find_user_by_username($username);

        return ($found_user->password == $password);
    }

    public static function add_user($username, $password, $firstName, $lastName)
    {
        global $database;
        $username = strtolower($username);
        $sql = "Insert into users(username,password,firstName,lastName) values ('$username','$password','$firstName','$lastName')";
        $result = $database->query($sql);
        if ($result) {
            $user = new user;
            $new_user = $user->find_user_by_username($username);
            return $new_user;
        }
        return false;
    }

    public function get_user_id()
    {
        return $this->user_id;
    }

    public function get_password()
    {
        return $this->password;
    }

    public function get_username()
    {
        return $this->username;
    }

    public function get_first_name()
    {
        return $this->firstName;
    }

    public function get_last_name()
    {
        return $this->lastName;
    }

    public function get_is_admin()
    {
        return $this->isAdmin;
    }
}
