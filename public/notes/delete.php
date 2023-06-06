<?php

    $title = $title ?? "";
    $title = "Delete Note";

    // require init.php file
    require('../../app/init.php');


    // id will be used to indicate the row data, super global variable $_GET request is used
    $id = $_GET['id'] ?? null;

    // if the id is not correct, redirect
    if(!$id) redirect('/');

    // session should be logged in
    $session->is_logged_in();

    // get user id from session
    $user_id = $session->get_user_id();

     // if the POST request is submitted from the form
    if($_SERVER['REQUEST_METHOD'] === "POST") {

        // create object that collects form data after submitting an HTML form with POST method (super global variable)
        $note_keys = $_POST;

        $note_keys['id'] = $id;
        // user_id value is same as session's user_id
        $note_keys['user_id'] = $user_id;

        // create object
        $delete_note = new Note($note_keys);

        // run delete function
        $delete_note->delete();

        // redirect to public/index.php
        redirect('/');

    } else {
        $note = Note::find($id, $user_id);
    }

?>
<!DOCTYPE html>
<html lang="en">
<?php include(get_path('public/partials/head.php')); ?>
<body>
    <?php include(get_path('public/partials/header.php')); ?>
    <main class="container">
        <div class="card">
            <form class="card-body" action="<?php echo get_public_url('/notes/delete.php?id=' . h($note['id']));?>" method="POST">
                <p class="fs-5">Are you sure you want to delete <span class="fw-semibold"><?php echo h($note['name']); ?></span> ?</p>
                <input type="hidden" name="id" value="<?php echo h($note['id']);?>">
                <button class="btn btn-outline-danger mb-3 text-uppercase mt-3" type="submit">Yes, I'm sure</button>
            </form>
        </div>        
    </main>
    <?php include(get_path('public/partials/footer.php')); ?>
</body>
</html>