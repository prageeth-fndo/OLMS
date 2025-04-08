<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }

    include 'inc/connection.php';
    $id= $_GET["id"];
    mysqli_query($link, "update std_registration set status='yes' where id=$id");
    mysqli_query($link, "update t_registration set status='yes' where id=$id");
    header("Location: status.php");
    exit();
?>


<?php 
     $res = mysqli_query($link, "select * from std_registration where id=$id");
     $res2 = mysqli_query($link, "select * from t_registration where id=$id");
    while($row = mysqli_fetch_array($res)){
        $email      = $row['email']; 
    }
    while($row2 = mysqli_fetch_array($res2)){
        $email      = $row2['email'];
    }
    $to = "$email";
    $subject = "Account Conformation";
    $message = "Your account is approved. Now you can login your account";
    $headers = "From: parttimemail18@gmail.com";
    mail($to,$subject,$message,$headers);
?>

 