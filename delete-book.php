<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }

    include 'inc/connection.php';
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        mysqli_query($link, "delete from add_book where id=$id");
        header("Location: display-books.php");
        exit();
    }



?>