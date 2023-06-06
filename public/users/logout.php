<?php 

    // create variable for the page title
    $title = $title ?? "";
    $title = "Log Out";
 
    // require init.php file
    require('../../app/connect.php');

    // session is login state
    $session->is_logged_in();

    // if the POST request is submitted from the form
    if($_SERVER['REQUEST_METHOD'] === "POST") {

        // run logout function
        $session->logout();
        redirect('/users/login.php');

    }

?>
<!DOCTYPE html>
<html lang="en">
<?php include(get_path('public/partials/head.php')); ?>
<body>
    <?php include(get_path('public/partials/header.php')); ?>
    <main class="container">
        <section class="card">
            <div class="card-header">
                <h2 class="text-uppercase fs-3"><?php echo h($title);?></h2>
            </div>
            <form class="card-body" action="<?php echo get_public_url('/users/logout.php');?>" method="POST">
                <p>Are you sure you want to log out?</p>
                <button class="btn btn-primary my-3 text-uppercase">Yes, I'm Sure</button>
            </form>
        </section>
    </main>
    <?php include(get_path('public/partials/footer.php')); ?>
</body>
</html>