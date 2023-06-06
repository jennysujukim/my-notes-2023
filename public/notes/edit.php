<?php
 
    // create variable for the page title
    $title = $title ?? "";
    $title = "Edit Note";

    // require init.php file
    require('../../app/connect.php');

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

        // create variable and pass in the data from the form
        $note_keys = $_POST;
        // id data is missing on update() function, so should add separately
        $note_keys['id'] = $id;
        // user_id value is same as session's user_id
        $note_keys['user_id'] = $user_id;

        // create object
        $edit_note = new Note($note_keys);

        // use delete method to run the SQL database
        $edit_note->update();

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
    <main class="container my-3">
        <section class="card">
            <div class="card-header">
                <h2 class="text-uppercase fs-3"><?php echo $title;?></h2>
            </div>
            <form class="card-body" action="<?php echo get_public_url('/notes/edit.php?id=' . h($note['id']));?>" method="POST">
                <div class="mb-3">
                    <label class="form-label" for="note_name">Title</label>
                    <input class="form-control" id="note_name" type="text" name="name" value="<?php echo h($note['name']);?>">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="note_course_number">Course Number</label>
                    <select class="form-select" id="note_course_number" name="course_number">
                        <option value="3294" <?php echo $note['course_number'] === "3294" ? 'selected' : ''; ?>>MDIA 3294</option>
                        <option value="3075" <?php echo $note['course_number'] === "3075" ? 'selected' : ''; ?>>MDIA 3075</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="note_body">Body</label>
                    <textarea class="form-control" id="note_body" name="body" rows="10"><?php echo $note['body'];?></textarea>
                </div>
                <button class="btn btn-primary mb-3 text-uppercase" type="submit">Save</button>
            </form>
        </section>
    </main>
    <?php include(get_path('public/partials/footer.php')); ?>
</body>
</html>