<?php 
session_start();
include 'inc/connection.php';

// Generate CSRF token if not already set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


if (isset($_POST['credential'])) {
    $id_token = $_POST['credential'];

    // Validate token via Google
    $response = file_get_contents('https://oauth2.googleapis.com/tokeninfo?id_token=' . $id_token);
    $data = json_decode($response, true);

    if (isset($data['email'])) {
        $email = $data['email'];

        // Optional: check if it's a Gmail
        if (strpos($email, '@gmail.com') === false) {
            die("Only Gmail addresses are allowed.");
        }

        $stmt = $link->prepare("SELECT * FROM lib_registration WHERE email = ? AND status = 'yes'");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        // Access the fetched record
        if ($res->num_rows > 0) {
            $record = $res->fetch_assoc(); // Fetch the record as an associative array
           
            // Example: Access specific fields
            $user_id = $record['id'];
            $user_name = $record['username'];
            // You can now use $user_id, $user_name, etc., as needed
        }

        if ($res->num_rows == 0) {
            echo "<div class='alert alert-warning'><strong class='error-msg'>Invalid Username Or Password! ⚠️ This email is not registered in our system</strong></div>";
        } else {
            $_SESSION["username"] = $user_name;
            $_SESSION["user"] = $user_name;
            $_SESSION["librarian"] = $user_name;
            header("location: dashboard.php");
            exit();
        }

        $stmt->close();


    } else {
        echo "Token verification failed.";
    }
} else {
    echo "No ID token received.";
}