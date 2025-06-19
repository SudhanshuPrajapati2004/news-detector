<?php
include 'auth.php'; 
include 'conn.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];
    $user_id = $_SESSION['user_id'];

    // Check if new and confirm password match
    if ($new !== $confirm) {
        header("Location: changepswd.php?error=nomatch");
        exit();
    }

    // Get current password from DB
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($passwordFromDB);
    $stmt->fetch();
    $stmt->close();

    // Compare entered current password with DB password (plain text)
    if (trim($current) !== trim($passwordFromDB)) {
        header("Location: changepswd.php?error=wrongcurrent");
        exit();
    }

    // Update password
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->bind_param("si", $new, $user_id);

    if ($stmt->execute()) {
        header("Location: changepswd.php?success=1");
        exit();
    } else {
        header("Location: changepswd.php?error=updatefail");
        exit();
    }
}
?>
<?php include "includes/header.php"; ?>
<?php include "includes/aside.php"; ?>

<main id="main" class="main">
  <section class="d-flex align-items-center justify-content-between">
    <div >
      <h3 class="mb-0 text-primary ">Change Password</h3> 
    
    </div>
    </section>

  <hr>

  <section>
    <div class="container-fluid mt-3 px-4 py-3 bg-white shadow rounded-3">
      <div>
        <h5 style="color: navy; font-weight:bold;">Change Your Password</h5> <!-- or Edit Existing Category -->
      </div>


<?php if (isset($_GET['error'])): ?>
  <?php
    $messages = [
      'nomatch' => 'New password and confirm password do not match.',
      'wrongcurrent' => 'Current password is incorrect.',
      'updatefail' => 'Something went wrong, try again.',
      'notloggedin' => 'You must be logged in.',
    ];
    $message = $messages[$_GET['error']] ?? 'Unknown error.';
  ?>
  <div id="Message" class="alert alert-danger animate__animated animate__fadeInDown" role="alert">
    <?= htmlspecialchars($message) ?>
  </div>
<?php endif; ?>

<?php if (isset($_GET['success'])): ?>
  <div id="Message" class="alert alert-success animate__animated animate__fadeInDown" role="alert">
    Password changed successfully!
  </div>
<?php endif; ?>
      <form action="" method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
              <label for="current_password" class="form-label">Current Password</label>
              <input type="password" class="form-control" name="current_password" required>
            </div>
            <div class="mb-3">
              <label for="new_password" class="form-label">New Password</label>
              <input type="password" class="form-control" name="new_password" required>
            </div>
            <div class="mb-3">
              <label for="confirm_password" class="form-label">Confirm New Password</label>
              <input type="password" class="form-control" name="confirm_password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Update Password</button>
          </form>
    </div>
  </section>
</main>


<?php include "includes/footer.php"; ?>
