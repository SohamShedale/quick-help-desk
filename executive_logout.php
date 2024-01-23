<?php
    session_start();
    session_unset();
    session_destroy();
    header("location:executive_signin.php");
    exit();
?>