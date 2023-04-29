<?php

if (isset($_GET['logout'])) {
    // Unset all session variables
    $_SESSION = array();
    // Destroy the session
    session_destroy();
    // Redirect to the login page
    header("Location: index.php");
    exit;
}

?>


<header>

    <div class="logo">
        <img src="assets/images/logo.png" alt="logo">
    </div>
    <nav>
        <li><span><a href="http://web1201062.studentswebprojects.ritaj.ps/about.html" target="_blank">About</a></span></li>
        <!-- send email to admin -->
        <li><span><a href="mailto:omarqalaweh@gmail.com" class="button-blue">Contact</a></span></li>
        <li><span><a href="?logout" class="button-red" >Logout</a></span></li>
    </nav>

</header>