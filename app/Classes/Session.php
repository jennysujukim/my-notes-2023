<?php

// create Class 
class Session {

    // create property 
    public $user_id;

    // create property of array 
    public $errors = [];

    // create construct method
    public function __construct($args = []) {

        // start session (built-in)
        session_start();
        $this->user_id = $_SESSION['user_id'] ?? null;
    }

    public function login($id) {
        // update the current session id with new one
        session_regenerate_id();
        $this->user_id = $id;
        $_SESSION['user_id'] = $this->user_id;

        return true;
    }

    public function get_user_id() {
        // get user id
        return $this->user_id;
    }
    
    public function logout() {
        // destroy all data registered to a session
        session_destroy();

        return true;
    }

    public function is_logged_in() {
        // if the id is null, redirect to login.php
        if(is_null($this->get_user_id())) {
            redirect('/users/login.php');
        } else {
            return true;
        }
    }

    public function set_errors($errors_arr) {

        // set error validation
        $this->errors = $errors_arr;
        // when the session has error, show error
        $_SESSION['errors'] = $this->errors;

    }

    public function get_errors_html() {

        // when errors occured, display error message on html
        if($this->errors) {
            $html = "<ul class='error-box'>";

                foreach($this->errors as $error) {
                    $html .= "<li class='error-msg'>{$error}</li>";
                }

            $html .= "</ul>";

            return $html;
        }

        return "";

    }


}