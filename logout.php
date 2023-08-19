<?php
$cn = mysqli_connect("localhost", "root", "", "bz");
    if (isset($_GET['key']) && $_GET['key'] == "o") {
        $id = $_GET['id'];
        session_start();
        mysqli_query($cn, "DROP TABLE `$id`");
        $d_result = mysqli_query($cn, "DELETE FROM `host` WHERE code =" . $id);
        $d_result = mysqli_query($cn, "DELETE FROM `join` WHERE code =" . $id);
        unset($_SESSION['ho']);
        unset($_SESSION['nm']);
        session_destroy();
        header("location:host/index.php");
    }
    if (isset($_GET['key']) && $_GET['key'] == "bo") {
        $id = $_GET['id'];
        session_start();
        $d_result = mysqli_query($cn, "DELETE FROM `join` WHERE id =" . $id);
        unset($_SESSION['nm']);
        session_destroy();
        header("location:index.php");
    }
    
?>