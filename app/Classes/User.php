<?php

// create Class 
class User {

    // create static property 
    static protected $db;

    // create properties
    public $id;
    public $email;
    protected $password;

    public $errors;

    // this connect database to the above properties 
    static public function set_db($mysqli_con){
        self::$db = $mysqli_con;
    }
    
    // construct method
    public function __construct($args = []) {

        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? null;
        $this->password = $args['password'] ?? null;

    }

    // construct method
    public function create() {

        // if it's not validate(), don't run below function
        if(!$this->validate()) { return false; }

        // hash password for safety (built in)
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

        // ? is used to replace the value
        $sql = "INSERT INTO users (email, password) VALUES ( ?, ?)";

        // prepared statement (in order to replace above value)
        $stmt = self::$db->prepare($sql);
        // bind variables (initial of variables type (eg. string, string = $email, $password))
        $stmt->bind_param('ss', $this->email, $hashed_password);
        // run the statement
        $stmt->execute();

        // get result
        $result = $stmt->get_result();

        // return result
        return $result;
    }


    // Find user by email
    static public function find_by_email($email) {

        $sql = "SELECT * FROM users WHERE email=?";

        $stmt = self::$db->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result;

    }

    // verify the provided password matches the hashed pashword
    public function validate_password($provided_password) {

        return password_verify($provided_password, $this->password);
        
    }

    // server-side validation
    public function validate() {

        // if the email is blank, show error
        if(is_blank($this->email)) {
            $this->errors[] = "Email cannot be blank";
        }

        // if the password is blank, show error
        if(is_blank($this->password)) {
            $this->errors[] = "Password cannot be blank";
        }

        return empty($this->errors);

    }

}