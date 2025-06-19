<?php
include 'auth.php';
include 'conn.php';
?>
<?php include "includes/header.php"; ?>
<?php include "includes/aside.php"; ?>

<style>
  body {
    background: #f4f0fa;
    font-family: 'Segoe UI', sans-serif;
  }

  .news-form-card {
    max-width: 800px;
    margin: 60px auto;
    border-radius: 1rem;
    background: #ffffff;
    box-shadow: 0 8px 25px rgba(132, 94, 247, 0.1);
    padding: 40px 30px;
    transition: all 0.3s ease;
  }

  .news-form-card:hover {
    box-shadow: 0 12px 35px rgba(132, 94, 247, 0.15);
  }

  .form-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #6f42c1;
    text-align: center;
    margin-bottom: 30px;
  }

  .form-label {
    font-weight: 600;
    color: #4b0082;
  }

  .form-control,
  .form-select {
    border-radius: 0.5rem;
    border: 1px solid #ced4da;
    padding: 10px 15px;
    font-size: 1rem;
  }

  textarea.form-control {
    resize: vertical;
  }

  .btn-submit {
    background: #6f42c1;
    color: white;
    font-weight: 600;
    transition: 0.3s;
  }

  .btn-submit:hover {
    background: #5a32a3;
  }
</style>

<main id="main" class="main">

  <!-- Page Heading -->
  <section class="d-flex align-items-center justify-content-between">
    <h3 class="mb-0 text-primary">Submit News Article</h3>
  </section>
  <hr>

  <!-- News Form -->
  <section>
    <div class="card news-form-card">
      <div class="form-title">
        📰 News Submission Form
      </div>

      <form method="POST" action="submit_test.php" enctype="multipart/form-data">

        <!-- Headline -->
        <div class="mb-4">
          <label for="headline" class="form-label">📝 Headline of the News</label>
          <input type="text" id="headline" name="headline" class="form-control" placeholder="Enter the news headline" required>
        </div>

        <!-- Body Text -->
        <div class="mb-4">
          <label for="body_text" class="form-label">📄 Body Text of the News</label>
          <textarea id="body_text" name="body_text" class="form-control" rows="6" placeholder="Paste or write the full news article here..." required></textarea>
        </div>

        <!-- Author -->
        <div class="mb-4">
          <label for="author" class="form-label">✍️ Author(s)</label>
          <input type="text" id="author" name="author" class="form-control" placeholder="Enter author name(s)" required>
        </div>

        <!-- Source/Publisher -->
        <div class="mb-4">
          <label for="source" class="form-label">🌐 Source / Publisher</label>
          <input type="text" id="source" name="source" class="form-control" placeholder="e.g., BBC, The Onion, NY Times" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-submit w-100 mt-3">🚀 Submit News</button>

      </form>
    </div>
  </section>

</main>

<?php include "includes/footer.php"; ?>
