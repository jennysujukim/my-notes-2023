<?php

    // create variable for the page title
    $title = $title ?? "";
    $title = "Add Note";
 
    // require init.php file
    require('../../app/connect.php');

    // session should be logged in
    $session->is_logged_in();

    // if the POST request is submitted from the form
    if($_SERVER['REQUEST_METHOD'] === "POST") {

        // get user id from session
        $user_id = $session->get_user_id();

        // create object that collects form data after submitting an HTML form with POST method (super global variable)
        $args = $_POST;
        // user_id value is same as session's user_id
        $args['user_id'] = $user_id;
        
        // instantiate object
        $note = new Note($args);

        // use create method to run the SQL database
        $note->create();

        // redirect to the public/index.php at the end
        redirect("/");

    }

?>
<!DOCTYPE html>
<html lang="en">
<?php include(get_path('public/partials/head.php')); ?>
<body>
    <?php include(get_path('public/partials/header.php')); ?>
    <main class="container my-3">
        <section class="card">
            <div class="card-header">
                <h2 class="text-uppercase fs-3"><?php echo h($title);?></h2>
            </div>
            <form class="card-body" action="<?php echo get_public_url('/notes/create.php');?>" method="POST">
                <div class="mb-3">
                    <label class="form-label" for="note_name">Title</label>
                    <input class="form-control" id="note_name" type="text" name="name">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="note_course_number">Course</label>
                    <select class="form-select" id="note_course_number" name="course_number">
                        <option value="3294">MDIA 3294</option>
                        <option value="3075">MDIA 3075</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="note_body">Content</label>
                    <textarea class="form-control" id="note_body" name="body" rows="10"></textarea>
                </div>
                <button class="btn btn-primary mb-3 text-uppercase" type="submit">Save</button>
            </form>          
        </section>        
    </main>
    <?php include(get_path('public/partials/footer.php')); ?>
</body>
</html>