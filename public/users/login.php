<?php 

    // create variable for the page title
    $title = $title ?? "";
    $title = "Log In";
  
    // require init.php file
    require('../../app/connect.php');

    //if the POST request is submitted from the form
    if($_SERVER['REQUEST_METHOD'] === "POST"){

        // find user by email col from users data
        $user = User::find_by_email($_POST['email']);

        if($user->num_rows === 1) {
        
            // create object
            $user_obj = new User( $user->fetch_assoc() );

            // if the password is validated, login function will be run, otherwise display error function
            if($user_obj->validate_password($_POST['password'])) {
                
                $session->login($user_obj->id);
                
                redirect('/');
            } else {
                $session->set_errors(["Check your email and password again."]);
            }

        } else {
            $session->set_errors(["User Not Found"]);
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
        <?php echo 'My username is' .$DB_HOST; ?>
        <section class="card">
            <div class="card-header">
                <h2 class="text-uppercase fs-3"><?php echo h($title);?></h2>
            </div>
            <form class="card-body" action="<?php echo get_public_url('/users/login.php');?>" method="POST">
                <div class="mb-3">
                    <label class="form-label" for="user_email">Email</label>
                    <input class="form-control" placeholder="name@example.com" id="user_email" type="email" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="user_password">Password</label>
                    <input class="form-control" id="user_password" type="password" name="password">
                </div>
                <button class="btn btn-primary mb-3 text-uppercase" type="submit">Log In</button>
            </form>
            <!-- call error function -->
            <?php echo $session->get_errors_html(); ?>
        </section>
    </main>
    <?php include(get_path('public/partials/footer.php')); ?>
</body>
</html>