<?php 

    // End the session and reset to NULL the var

    session_start();
    session_unset();
    header("Location: index.php");
?>