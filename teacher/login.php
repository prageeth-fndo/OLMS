<?php
session_start();
include 'inc/connection.php';

// Generate CSRF token if not already set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="google-signin-client_id" content="938792872115-jk65bb93sllatbn4hd6unkkjq46uv893.apps.googleusercontent.com">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <meta charset="UTF-8">
    <title>Library Management System</title>
    <link rel="stylesheet" href="inc/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="inc/css/pro1.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="inc/css/custom.css">
</head>

<body>

    <div class="login registration">
        <div class="wrapper">
            <div class="reg-header text-center">
                <h2>Library management system</h2>
                <div class="gap-40"></div>
            </div>
            <div class="gap-30"></div>
            <div class="login-content">
                <div class="login-body">
                    <h4>User Login Form</h4>
                    <form action="" method="post">
                        <div class="mb-20">
                            <input type="text" name="username" class="form-control" placeholder="Username" required />
                        </div>
                        <div class="mb-20">
                            <input type="password" name="password" class="form-control" placeholder="Password" required />
                        </div>
                        <!-- CSRF Token -->
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

                        <div class="mb-20">
                            <input class="btn btn-info submit" type="submit" name="login" value="Login">
                            <a class="reset_pass" href="lost-password.php">Lost your password?</a>
                        </div>
                    </form>
                </div>
                <div class="login-footer text-center">
                    <div class="separator">
                        <p class="change_link">New to site?
                            <a href="registration.php" class="text-right"> Create Account </a>
                        </p>
                    </div>
                    <!-- Google Sign-In -->
                    <div class="googleBtn">
                        <div id="g_id_onload"
                            data-client_id="938792872115-jk65bb93sllatbn4hd6unkkjq46uv893.apps.googleusercontent.com"
                            data-context="signin"
                            data-ux_mode="redirect"
                            data-login_uri="http://localhost/LMS/teacher/google-callback.php"
                            data-auto_prompt="false">
                        </div>

                        <div class="g_id_signin"
                            data-type="icon"
                            data-size="large"
                            data-theme="outline"
                            data-text="sign_in_with"
                            data-shape="rectangular"
                            data-logo_alignment="left"
                            data-width="250">
                        </div>
                    </div>

                    <?php
                    if (isset($_POST["login"])) {
                        // Validate CSRF token
                        if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                            echo "<div class='alert alert-danger'><strong>CSRF validation failed.</strong></div>";
                            exit();
                        }

                        $username = trim($_POST['username']);
                        $password = trim($_POST['password']);

                        $stmt = $link->prepare("SELECT * FROM t_registration WHERE username = ? AND password = ? AND status = 'yes' AND verified = 'yes'");
                        $stmt->bind_param("ss", $username, $password);
                        $stmt->execute();
                        $res = $stmt->get_result();

                        if ($res->num_rows == 0) {
                            echo "<div class='alert alert-warning'><strong class='error-msg'>Invalid Username Or Password!</strong></div>";
                        } else {
                            $_SESSION["teacher"] = $username;
                            header("location: dashboard.php");
                            exit();
                        }

                        $stmt->close();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


    <div class="footer text-center">
        <p>&copy; All rights reserved utter pompously</p>
    </div>

    <script src="inc/js/jquery-2.2.4.min.js"></script>
    <script src="inc/js/bootstrap.min.js"></script>
    <script src="inc/js/custom.js"></script>
</body>

</html>