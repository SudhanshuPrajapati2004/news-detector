<?php
include 'auth.php';
include 'conn.php';

$report = null;

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM news_reports WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows) {
        $report = $res->fetch_assoc();
    } else {
        die('Report not found.');
    }
} else {
    die('No report ID provided.');
}
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/aside.php'; ?>

<style>
  .report-card {
    max-width: 700px;
    margin: 50px auto;
    padding: 2rem;
    background: linear-gradient(135deg, #ffffff, #f0f4f8);
    border-radius: 20px;
    box-shadow: 0 0 25px rgba(0,0,0,0.08);
  }
  .report-title {
    font-size: 28px;
    font-weight: 700;
    color: #007bff;
    text-align: center;
  }
  .highlight-box {
    background: #fdfdfd;
    padding: 20px;
    border-radius: 1rem;
    margin-top: 20px;
    box-shadow: 0 0 12px rgba(0,0,0,0.05);
  }
  .highlight-box p {
    margin-bottom: 10px;
    font-size: 16px;
  }
  .alert {
    font-size: 16px;
    padding: 15px;
  }
  .back-btn {
    display: inline-block;
    margin-top: 25px;
    text-align: center;
  }
</style>

<main id="main" class="main">
  <div class="report-card">
    <div class="report-title">📰 News Verification Report</div>
    <div class="text-center text-muted mb-3">
      Generated on: <?= date('d M Y, h:i A', strtotime($report['created_at'] ?? 'now')) ?>
    </div>

    <!-- Input Details -->
    <div class="highlight-box">
      <p><strong>Headline:</strong> <?= htmlspecialchars($report['headline']) ?></p>
      <p><strong>Body:</strong> <?= nl2br(htmlspecialchars($report['body_text'])) ?></p>
      <p><strong>Author:</strong> <?= htmlspecialchars($report['author']) ?></p>
      <p><strong>Source:</strong> <?= htmlspecialchars($report['source']) ?></p>
    </div>

    <!-- Prediction -->
    <?php
      $test_result = (int) $report['test_result']; // 0 or 1
      $class = $test_result === 0 ? 'success' : 'danger';
      $icon  = $test_result === 0 ? '✅' : '🚨';
      $label = $test_result === 0 ? 'REAL NEWS' : 'FAKE NEWS';
      $desc  = htmlspecialchars($report['result']);
    ?>

    <div class="alert alert-<?= $class ?> text-center mt-4 fw-bold fs-5">
      <?= $icon ?> Prediction: <span class="text-uppercase"><?= $label ?></span>
    </div>

    <div class="alert alert-<?= $class ?>">
      <strong>Interpretation:</strong><br>
      <?= $desc ?>
    </div>

    <div class="back-btn text-center">
      <a href="test.php" class="btn btn-outline-primary">🔙 Back to News Test</a>
    </div>
  </div>
</main>

<?php include 'includes/footer.php'; ?>

