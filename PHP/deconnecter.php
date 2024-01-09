<?php
session_start();
    if(isset($_SESSION['currentAdherent'])) {
        session_destroy();
        header("Location:../index.html");
        }
?>