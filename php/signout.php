<!-- signout.php -->

<?php
    session_start();
    session_destroy();
    unset($_SESSION['user_name']);

    include 'connect.php';
    include 'header.php';

    echo '<h3>You are signed out</h3>';
    echo '<h4>Click here to <a class="link" href="signin.php">sign back in again.</a></h4>';

    include 'footer.php';
?>