<?php
  $title = $title ?? "";
  $title = "Home";

  // get init.php file
  require('../app/connect.php');

  // session is login state
  $session->is_logged_in();

  // get user_id from session
  $user_id = $session->get_user_id();

  // create variable that gets data of the notes table, find_all() function is created on Note Class
  $notes = Note::find_all($user_id);

?>

<!DOCTYPE html>
<html lang="en">

<?php include(get_path('public/partials/head.php')); ?>
<body class="bg-white">
  <?php include(get_path('public/partials/header.php')); ?>
  <main class="container">
    <div class="d-flex justify-content-between py-3">
      <form class="d-flex" role="search" id="search-form">
          <input class="form-control me-2" placeholder="Search" >
          <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      <a class="btn btn-outline-primary" href="<?php echo get_public_url('/notes/create.php');?>">Add Note</a>
    </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">All</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">MDIA 3294</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">MDIA 3075</button>
      </li>
    </ul>

    <div class="container tab-content" id="container nav-tabContent">
      <p id="error-msg">Results Not Found.</p>
      <?php if($notes->num_rows === 0):?>
      <p class="text-body-secondary">You have no note so far.</p>
      <?php else:?>
      <?php while($note_row = $notes->fetch_assoc()): ?>
      <article class="card m-2">
        <div class="card-header">
          <h2 class="fs-4 note-title">
            <?php echo h($note_row['name']);?>
          </h2>
        </div>
        <div class="card-body">
          <div class="card-subtitle mb-2 text-body-secondary">
            <p class="category">MDIA <?php echo h($note_row['course_number']);?></p>
          </div>
          <div class="card-text my-3">
            <p><?php echo $note_row['body'];?></p>
          </div>
          <div class="text-end mt-3">
            <a class="btn btn-outline-secondary" href="<?php echo get_public_url('/notes/edit.php?id=' . h($note_row['id'])); ?>">Edit</a>
            <a class="btn btn-outline-danger" href="<?php echo get_public_url('/notes/delete.php?id=' . h($note_row['id'])); ?>">Delete</a>
          </div>
        </div>
      </article>
      <?php endwhile;?> 
      <?php endif;?>   
    </div>
  </main>
  <?php include(get_path('public/partials/footer.php')); ?>
</body>
</html>