<?php
include 'auth.php';
include 'conn.php';


$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';


$sql = "SELECT * FROM news_reports ORDER BY created_at DESC";
if ($limit > 0) {
    $sql .= " LIMIT $limit";
}
$result = $conn->query($sql);

$rows = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
}
?>

<?php include "includes/header.php"; ?>
<?php include "includes/aside.php"; ?>

<style>
  body {
    background-color: #f3e8ff;
  }
  .news-card {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    padding: 2rem;
    margin-top: 20px;
  }
  .table th {
    background-color: #d0bfff;
    color: #4b0082;
  }
  .highlight {
    background-color: #fef3c7 !important;
  }
  .form-select, .form-control {
    max-width: 200px;
    display: inline-block;
  }
</style>

<main id="main" class="main">
  <div class="container py-4">
    <div class="news-card">

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">📰 News Reports</h2>
        <form method="GET" action="" class="d-flex align-items-center gap-2">
          <label for="limit" class="form-label mb-0 me-2">Show:</label>
          <select name="limit" id="limit" class="form-select" onchange="this.form.submit()">
            <option value="5" <?= $limit == 5 ? 'selected' : '' ?>>5</option>
            <option value="10" <?= $limit == 10 ? 'selected' : '' ?>>10</option>
            <option value="20" <?= $limit == 20 ? 'selected' : '' ?>>20</option>
            <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50</option>
            <option value="0" <?= $limit == 0 ? 'selected' : '' ?>>All</option>
          </select>

          <input type="text" name="search" id="search" class="form-control ms-2" 
                 value="<?= htmlspecialchars($search) ?>" placeholder="Search..." />
          <button type="submit" class="btn btn-outline-primary ms-2">Go</button>
        </form>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered align-middle table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Headline</th>
              <th>Body Text</th>
              <th>Author</th>
              <th>Source</th>
              <th>Test Result</th>
              <th>Result</th>
              <th>Created At</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rows as $row): 
              $isMatch = false;
              if ($search !== '') {
                foreach ($row as $field) {
                  if (stripos($field, $search) !== false) {
                    $isMatch = true;
                    break;
                  }
                }
              }
            ?>
            <tr class="<?= $isMatch ? 'highlight' : '' ?>">
              <td><?= $row['id'] ?></td>
              <td><?= htmlspecialchars($row['headline']) ?></td>
              <td><?= htmlspecialchars($row['body_text']) ?></td>
              <td><?= htmlspecialchars($row['author']) ?></td>
              <td><?= htmlspecialchars($row['source']) ?></td>
              <td>
                <span class="badge <?= $row['test_result'] == 1 ? 'bg-danger' : 'bg-success' ?>">
                  <?= $row['test_result'] == 1 ? 'Fake' : 'Real' ?>
                </span>
              </td>
              <td><?= htmlspecialchars($row['result']) ?></td>
              <td><?= $row['created_at'] ?></td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($rows)): ?>
            <tr>
              <td colspan="8" class="text-center">No records found.</td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</main>

<?php include "includes/footer.php"; ?>
