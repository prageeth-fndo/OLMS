<?php
session_start();
include 'inc/connection.php';
$errors = [];

// Generate CSRF token if not already created
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (isset($_POST["reset-password"])) {
    // CSRF validation
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("CSRF validation failed.");
    }

    $email = trim($_POST['email']);

    if (empty($email)) {
        $errors[] = "Your email is required";
    } else {
        $stmt = $link->prepare("SELECT password FROM t_registration WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows <= 0) {
            $errors[] = "Sorry, no user exists on our system with that email";
        } else {
            $row = $result->fetch_assoc();
            $password = $row['password'];
        }

        $stmt->close();
    }

    if (count($errors) == 0) {
        $to = $email;
        $subject = "Forgot password";
        $message = "Your password is: $password";
        $headers = "From: parttimemail18@gmail.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";

        mail($to, $subject, $message, $headers);
        header('Location: login.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Management System</title>   
</head>
<body>
<form class="login-form" action="lost-password.php" method="post">
    <h2 class="form-title">Reset password</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-warning">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <label>Your email address</label> <br>
        <input type="email" name="email" required>
    </div>

    <!-- CSRF token -->
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

    <div class="form-group">
        <button type="submit" name="reset-password" class="login-btn">Submit</button>
    </div>
</form>
</body>
</html>
