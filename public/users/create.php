<?php 

    // create variable for the page title
    $title = $title ?? "";
    $title = "Sign Up";
 
    // require init.php file
    require('../../app/init.php');

    // if the POST request is submitted from the form
    if($_SERVER['REQUEST_METHOD'] === "POST") {

        // create user object
        $user = new User($_POST);

        // result is creating user in data
        $result = $user->create();

        // if the result function is validated, redirect to login.php / otherwise run error function
        if($result) {
            redirect('/users/login.php');
        } else {
            $session->set_errors($user->errors);
        }
        
    }

?>
<!DOCTYPE html>
<html lang="en">
    <!-- import head.php -->
    <?php include(get_path('public/partials/head.php')); ?>
    <body>
        <?php include(get_path('public/partials/header.php')); ?>
        <main class="container">
            <section class="card">
                <div class="card-header">
                    <h2 class="text-uppercase fs-3"><?php echo h($title);?></h2>
                </div>
                <!-- call the error function -->
                <?php echo $session->get_errors_html(); ?>
                <form class="card-body" id="sign-up" action="<?php echo get_public_url('/users/create.php');?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label" for="user_email">Email</label>
                        <input class="form-control" placeholder="name@example.com" id="user_email" type="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="user_password">Password</label>
                        <input class="form-control" id="user_password" type="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="user_password">Confirm Password</label>
                        <input class="form-control" id="user_password" type="password" name="password_confirm">
                    </div>
                    <button class="btn btn-primary mb-3 text-uppercase" type="submit">Sign Up</button>
                </form>
            </section>
        </main>
        <?php include(get_path('public/partials/footer.php')); ?>
    </body>
</html>