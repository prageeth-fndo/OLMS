<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: index.php");
    }

    include 'inc/connection.php';
    
    if (isset($_GET["id"])) {
    $id = $_GET["id"];

    //SQLi fixed
    $stmt = $link->prepare("DELETE FROM add_book WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: display-books.php?deleted=1");
    } else {
        echo "Error deleting book: " . $stmt->error;
    }

    $stmt->close();

    }

?>