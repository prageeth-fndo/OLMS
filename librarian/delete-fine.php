<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: index.php");
    }

    include 'inc/connection.php';
  
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
                
        // SQLi fixed
        $stmt = $link->prepare("DELETE FROM finezone WHERE id = ?");
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {            
            header("Location: fine.php?deleted=1");
        } else {
            echo "Error deleting fine: " . $stmt->error;
        }
    
        $stmt->close();
    }

?>