<?php
session_start();
include 'inc/connection.php'; // Include database connection

$client_id = "938792872115-jk65bb93sllatbn4hd6unkkjq46uv893.apps.googleusercontent.com";
$client_secret = "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";
$redirect_uri = "http://localhost/OLMS/auth/google/callback";

// Get authorization code
if (!isset($_GET['code'])) {
    header("Location: https://accounts.google.com/o/oauth2/auth?client_id=$client_id&redirect_uri=$redirect_uri&response_type=code&scope=email profile");
    exit();
}

// Exchange authorization code for access token
$token_url = "https://oauth2.googleapis.com/token";
$data = [
    "client_id" => $client_id,
    "client_secret" => $client_secret,
    "code" => $_GET['code'],
    "redirect_uri" => $redirect_uri,
    "grant_type" => "authorization_code"
];
$options = ["http" => ["method" => "POST", "header" => "Content-Type: application/x-www-form-urlencoded", "content" => http_build_query($data)]];
$context = stream_context_create($options);
$result = file_get_contents($token_url, false, $context);
$token = json_decode($result, true)["access_token"];

// Retrieve user info
$user_info_url = "https://www.googleapis.com/oauth2/v1/userinfo?access_token=$token";
$user_data = json_decode(file_get_contents($user_info_url), true);

// Store user data in session
$_SESSION["user"] = $user_data;

// Check user role in database
$email = $user_data["email"];
$query = mysqli_query($link, "SELECT role FROM users WHERE email='$email'");

if ($query && mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $role = $row["role"];

    // Redirect users to their respective dashboards
    if ($role === "librarian") {
        header("Location: librarian/dashboard.php");
    } elseif ($role === "student") {
        header("Location: student/dashboard.php");
    } elseif ($role === "teacher") {
        header("Location: teacher/dashboard.php");
    } else {
        header("Location: index.php"); // Redirect to default login page
    }
} else {
    echo "Unauthorized user!";
}
?>
