<?php
include 'auth.php'; 
include 'conn.php';  
?>

<?php include "includes/header.php" ?>
<?php include "includes/aside.php" ?>

<style>
  body {
    background: #f4f0fa; /* Soft light purple */
  }

  .dashboard-card {
    background: #fff;
    border-radius: 18px;
    padding: 28px 20px;
    text-align: center;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 250px;
    position: relative;
    overflow: hidden;
    border: 1px solid #eee;
  }

  .dashboard-card::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle at center, rgba(132, 94, 247, 0.08), transparent 70%);
    z-index: 0;
    transition: all 0.4s ease;
  }

  .dashboard-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 16px 30px rgba(132, 94, 247, 0.2);
  }

  .dashboard-card .card-icon {
    font-size: 3.2rem;
    margin-bottom: 12px;
    z-index: 1;
  }

  .dashboard-card .card-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 8px;
    color: #4b0082;
    z-index: 1;
  }

  .dashboard-card .card-text {
    font-size: 0.95rem;
    color: #6c757d;
    z-index: 1;
  }

  .card-link {
    text-decoration: none;
  }

  /* Unique icon colors for each card */
  .card-test .card-icon { color: #845ef7; }
  .card-reports .card-icon { color: #20c997; }
  .card-password .card-icon { color: #f7b731; }
  .card-logout .card-icon { color: #fa5252; }

  @media (max-width: 576px) {
    .dashboard-card {
      height: 220px;
      padding: 24px 10px;
    }
  }
</style>



<main id="main" class="main">
    <?php if (isset($_SESSION['user_name']) && !isset($_SESSION['welcome_shown'])):
?>
    <div id="Message" class="position-fixed top-0 start-50 translate-middle-x mt-3 px-4 py-2 bg-success bg-gradient text-white fs-3 fw-bold rounded shadow text-nowrap" style="z-index: 1050;">
        Welcome, <?= htmlspecialchars($_SESSION['user_name']); ?>
    </div>

    <?php
    
    $_SESSION['welcome_shown'] = true;
endif; ?>

    <div class="container mt-5">
        <div class="row g-4 justify-content-center">

            <!-- Test Card -->
            <div class="col-md-3 col-sm-6">
              <a href="test.php" class="card-link">
                <div class="dashboard-card card-test">
                  <div class="card-icon">🕵️‍♂️</div>
                  <div class="card-title">Test News</div>
                  <div class="card-text">Start a new fake news test.</div>
                </div>
              </a>
            </div>

            <!-- Reports Card -->
            <div class="col-md-3 col-sm-6">
              <a href="reports.php" class="card-link">
                <div class="dashboard-card card-reports">
                  <div class="card-icon">📄</div>
                  <div class="card-title">View Reports</div>
                  <div class="card-text">Check your test history and reports.</div>
                </div>
              </a>
            </div>

            <!-- Password -->
            <div class="col-md-3 col-sm-6">
              <a href="changepswd.php" class="card-link">
                <div class="dashboard-card card-password">
                  <div class="card-icon">🔐</div>
                  <div class="card-title">Change Password</div>
                  <div class="card-text">Update your account password securely.</div>
                </div>
              </a>
            </div>

            <!-- Logout -->
            <div class="col-md-3 col-sm-6">
              <a href="logout.php" class="card-link">
                <div class="dashboard-card card-logout">
                  <div class="card-icon">🚪</div>
                  <div class="card-title">Logout</div>
                  <div class="card-text">Sign out safely from your account.</div>
                </div>
              </a>
            </div>


        </div>
    </div>

 

  </main><!-- End #main -->

  

<?php include "includes/footer.php" ?><!-- End Header -->