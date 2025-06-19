<?php
session_start();
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simple query (assumes password stored as plain text; you should use password_hash in real apps)
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id']; // Store user ID
        $_SESSION['user_name'] = $user['name']; // Optional: Store other data

        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login in Fake News Detector</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


  <style>
    body {
      background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);
      min-height: 100vh;
    }

    .login-card {
      max-width: 900px;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      animation: fadeIn 1s ease-in-out;
    }

    .login-image {
      object-fit: cover;
      width: 100%;
      height: 100%;
      transition: transform 0.6s ease;
    }

    .login-image:hover {
      transform: scale(1.05);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .card-body {
      background-color: #ffffff;
    }

    .form-control:focus {
      box-shadow: 0 0 5px rgba(128, 0, 255, 0.5);
      border-color: #8000ff;
    }

    .btn-primary {
      background-color: #8000ff;
      border: none;
    }

    .btn-primary:hover {
      background-color: #5a00b3;
    }
  </style>
</head>
<body>

  <main class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="container">

      <div class="login-card row bg-white mx-auto shadow-lg">

        <!-- Left: Image -->
        <div class="col-md-6 d-none d-md-block p-0">
          <img src="assets/images/fake.jpg" alt="Fake News" class="login-image h-100">
        </div>

        <!-- Right: Form -->
        <div class="col-md-6 col-12 d-flex align-items-center justify-content-center p-4">
          <div class="w-100">

            <!-- Logo & Heading -->
            <div class="text-center mb-4">
              <h2 class="fw-bold text-primary">Fake News Detector</h2>
              <p class="text-muted mb-2">AI-Powered Verification System</p>
              <img src="assets/images/fake-news.png" alt="logo" width="60" class="mb-2">
              <h5 class="text-dark mt-2">Login Here</h5>
            </div>

            <!-- Form -->
            <form class="needs-validation" method="POST" novalidate>

              <div class="mb-3">
                <label for="yourUsername" class="form-label">Username</label>
                <div class="input-group has-validation">
                  <span class="input-group-text bg-primary text-white">@</span>
                  <input type="text" name="username" class="form-control" id="yourUsername" required>
                  <div class="invalid-feedback">Please enter your username.</div>
                </div>
              </div>

              <div class="mb-3">
                <label for="yourPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="yourPassword" required>
                <div class="invalid-feedback">Please enter your password!</div>
              </div>

              <div class="d-grid">
                <button class="btn btn-primary" type="submit">Login</button>
              </div>

            </form>

          </div>
        </div>

      </div>

    </div>
  </main>


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>