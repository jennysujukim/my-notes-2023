<?php 

// create Class 
class Note {

    // create static property 
    static protected $db;

    // create properties
    public $id;
    public $name;
    public $body;
    public $course_number;
    public $user_id;

    // create static function which is attached to the class and can be used without instance
    // this connect database to the above properties 
    static public function set_db($mysqli_con) {

        // use self:: scope resolution operator to access class variable
        self::$db = $mysqli_con;

    }

    // create a static method to get entries(content) from database
    // id & user_id will be used to indicate the row 
    static public function find($id, $user_id) {

        // READ -> create $sql variable to read data
        // ? is used to replace the value
        $sql = "SELECT * FROM notes WHERE id = ? AND user_id = ?";

        // prepared statement (in order to replace above value)
        $stmt = self::$db->prepare($sql);
        // bind variables (initial of variables type (eg. integer, integer = $id, $user_id))
        $stmt->bind_param('ii', $id, $user_id);
        // run the statement
        $stmt->execute();

        // get the result
        $result = $stmt->get_result();

        // return results
        return $result->fetch_assoc();
    }


    // create a static method to get data from notes table --> READ
    static public function find_all($user_id) {

        // READ -> create $sql variable to retrieve notes data, 'user_id' column is used to identify
        $sql = "SELECT * FROM notes WHERE user_id = ?";
        $stmt = self::$db->prepare($sql);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result;

    }


    // create construct method
    public function __construct($args = []) {

        // use $this to access a property belonging to the object of the class
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? null;
        $this->body = mysqli_escape_string(self::$db, str_replace( "\r\n", "<br />", $args['body'])) ?? null;
        $this->course_number = $args['course_number'] ?? null;
        $this->user_id = $args['user_id'] ?? null;

    }


    // create a method to create data on notes table --> CREATE
    public function create() {

        // CREATE -> create $sql variable to make data on notes table
        $sql = "INSERT INTO notes (name, body, course_number, user_id) VALUES ( ?, ?, ?, ? )";

        $stmt = self::$db->prepare($sql);
        $stmt->bind_param('ssii', $this->name, $this->body, $this->course_number, $this->user_id);
        $stmt->execute();

        $result = $stmt->get_result();

        // return results
        return $result;

    }

    // create a method to update data on notes table --> UPDATE
    public function update() {

        // UPDATE -> create $sql variable to update data on notes table, id & user_id columns will be used to define row
        $sql = "UPDATE notes SET name=?, body=?, course_number=? WHERE id=? AND user_id=? LIMIT 1";

        $stmt = self::$db->prepare($sql);
        $stmt->bind_param('ssiii', $this->name, $this->body, $this->course_number, $this->id, $this->user_id);
        $stmt->execute();
        
        $result = $stmt->get_result();

        return $result;

    }

    // create a method to delete data on notes table --> DELETE
    public function delete() {

        // UPDATE -> create $sql variable to delete data on notes table, id & user_id columns will be used to define row
        $sql = "DELETE FROM notes WHERE id=? AND user_id=? LIMIT 1";

        $stmt = self::$db->prepare($sql);
        $stmt->bind_param('ii', $this->id, $this->user_id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result;

    }

}

