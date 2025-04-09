<?php 
session_start();
if (!isset($_SESSION["student"])) {
    header("Location: index.php");
}
include 'inc/header.php';
include 'inc/connection.php';
?>
<!--dashboard area-->
<div class="dashboard-content">
    <div class="dashboard-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left">
                        <p><span>dashboard</span>User panel</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right text-right">
                        <a href="dashboard.php"><i class="fas fa-home"></i>home</a>
                        <span class="disabled">change password</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="" class="pass-content" method="post">
                        <b>Current Password:</b>
                        <input type="password" class="form-control mt-10" name="cpassword" placeholder="Current password">
                        <br>
                        <b>New Password:</b>
                        <input type="password" class="form-control mt-10" name="npassword" placeholder="New password">
                        <br>
                        <b>Conform Password:</b>
                        <input type="password" class="form-control mt-10" name="conpass" placeholder="Conform password">
                        <br>
                        <input type="submit" name="submit" class="btn" value="Change Password">
                    </form>

                    <?php
                    if (isset($_POST["submit"])) {

                        $cpass = $_POST['cpassword'];
                        $npass = $_POST['npassword'];
                        $conpass = $_POST['conpass'];
                        $pass = "";

                        // Secure SELECT query
                        $stmt = $link->prepare("SELECT password FROM std_registration WHERE username = ?");
                        $stmt->bind_param("s", $_SESSION["student"]);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()) {
                            $pass = $row['password'];
                        }
                        $stmt->close();

                        if ($cpass != $pass) {
                            ?>
                            <div class="alert alert-warning">
                                <strong class="error-msg">Invalid!</strong> 
                                <span class="error-msg">You entered wrong password</span>
                            </div>
                            <?php
                        } else {
                            if ($npass == $conpass) {

                                // Secure UPDATE query
                                $stmt = $link->prepare("UPDATE std_registration SET password = ? WHERE username = ?");
                                $stmt->bind_param("ss", $npass, $_SESSION["student"]);
                                $stmt->execute();
                                $stmt->close();
                                ?>
                                <div class="alert alert-success">
                                    <strong class="successfull-msg">Success!</strong> 
                                    <span class="successfull-msg">Your password is changed.</span>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="alert alert-warning">
                                    <strong class="error-msg">Not match!</strong> 
                                    <span class="error-msg">Your password</span>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>					
    </div>
</div>
<?php 
include 'inc/footer.php';
?>
