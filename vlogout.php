<?php
    session_start();
    include 'conn.php';
    unset($_SESSION['voter_id']);
    unset($_SESSION['voter_name']);
    session_destroy();
    header("Location:index.php")
?>