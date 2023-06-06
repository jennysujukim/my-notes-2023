<header>
    <nav class="navbar navbar-expand-lg bg-primary bg-gradient" data-bs-theme="dark">
        <div class="container-fluid px-4">
            <a class="navbar-brand text-uppercase fw-semibold" href="<?php echo get_public_url('/');?>">My Notes</a>
            <ul class="navbar-nav">
            <?php if(is_null($session->get_user_id())):?>
                <li class="nav-item">
                    <a class="nav-link text-uppercase" href="<?php echo get_public_url('/users/create.php');?>">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase" href="<?php echo get_public_url('/users/login.php');?>">Sign In</a>
                </li>
            <?php else:?>
                <li class="nav-item">
                    <a class="nav-link text-uppercase" href="<?php echo get_public_url('/users/logout.php');?>">Log Out</a>
                </li>
            <?php endif;?>
            </ul>
        </div>
    </nav>
</header>