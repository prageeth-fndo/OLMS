<?php
session_start();
include 'inc/connection.php';   
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Library Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f5f5f5;
    }
    .navbar {
      background-color: #1976d2;
    }
    .navbar-brand, .nav-link, .navbar-toggler-icon {
      color: white !important;
    }
    .hero-section {
      background-color: #2196f3;
      color: white;
      padding: 80px 20px;
      text-align: center;
      border-radius: 0 0 40px 40px;
    }
    .card {
      border: none;
      border-radius: 16px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }
    .card i {
      font-size: 48px;
      color: #1976d2;
    }
    .footer {
      background-color: #eeeeee;
      padding: 20px;
      text-align: center;
      font-size: 14px;
      color: #777;
      margin-top: 40px;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="#"><i class="fas fa-book-reader me-2"></i>Library System</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Reports</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <section class="hero-section">
    <div class="container">
      <h1 class="display-4 fw-bold">Welcome to the Library</h1>
      <p class="lead">Manage books, users, and transactions with ease.</p>
    </div>
  </section>

  <!-- Features -->
  <div class="container mt-5">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card p-4 text-center shadow-sm">
          <i class="fas fa-search mb-3"></i>
          <h5>Search Books</h5>
          <p>Quickly search for books by title, author, or ISBN.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-4 text-center shadow-sm">
          <i class="fas fa-book-open mb-3"></i>
          <h5>Issue & Return</h5>
          <p>Manage book issuing and returns efficiently.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-4 text-center shadow-sm">
          <i class="fas fa-users mb-3"></i>
          <h5>Manage Users</h5>
          <p>Add, update, or remove users with ease.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer mt-5">
    &copy; 2025 Library Management System. All rights reserved.
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
