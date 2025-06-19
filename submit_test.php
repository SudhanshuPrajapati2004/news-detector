<?php
session_start();
require_once __DIR__ . '/conn.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: test.php');
    exit;
}

if (!isset($_SESSION['user_id'])) {
    die('User not authenticated');
}

$user_id   = $_SESSION['user_id'];
$headline  = trim($_POST['headline'] ?? '');
$body      = trim($_POST['body_text'] ?? '');
$author    = trim($_POST['author'] ?? '');
$source    = trim($_POST['source'] ?? '');

// Basic validation
if (empty($headline) || empty($body) || empty($author) || empty($source)) {
    die('All fields are required.');
}

// Run Python ML script for prediction
$python_bin = 'C:\\Python313\\python.exe';
$script_path = __DIR__ . '\\ml\\predict.py';

$escaped_python_bin = escapeshellarg($python_bin);
$escaped_script_path = escapeshellarg($script_path);

$args = [
    escapeshellarg($headline),
    escapeshellarg($body),
    escapeshellarg($author),
    escapeshellarg($source)
];

$cmd = $escaped_python_bin . ' ' . $escaped_script_path . ' ' . implode(' ', $args) . ' 2>&1';

file_put_contents(__DIR__ . '/debug_output.txt', "CMD: $cmd\n", FILE_APPEND);

$output = shell_exec($cmd);

if ($output === null || trim($output) === '') {
    error_log("Prediction failed: $cmd\nOutput: $output");
    die('Prediction failed. Please check logs.');
}

$test_result = (int) trim($output); // 0 or 1
$result      = ($test_result === 0) ? '🟢 Real News' : '🔴 Fake News';

// Insert into database
$sql = "INSERT INTO news_reports (headline, body_text, author, source, test_result, result, created_at)
        VALUES (?, ?, ?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql) or die('Prepare failed: ' . $conn->error);
$stmt->bind_param('ssssis',$headline, $body, $author, $source, $test_result, $result);
$stmt->execute() or die('Execute failed: ' . $stmt->error);
$report_id = $stmt->insert_id;
$stmt->close();

// Append to CSV for retraining

$csv_row = [
    $headline,
    $body,
    $author,
    $source,
    (int)$test_result
];

$csv_path = __DIR__ . '/ml/training_data.csv';

// Check if the file is new (to write headers)

$add_headers = !file_exists($csv_path) || filesize($csv_path) === 0;

$fp = fopen($csv_path, 'a');

if ($fp) {
    if ($add_headers) {
        fputcsv($fp, ['headline', 'body_text', 'author', 'source', 'label']);
    }

    fputcsv($fp, $csv_row);
    fclose($fp);

    // $output = shell_exec("python3 ml/retrain.py");
    // (Optional) Log output if needed
    //file_put_contents(__DIR__ . "/ml/retrain_log.txt", $output . "\n", FILE_APPEND);
} else {
    error_log("⚠️ Failed to open training data CSV for writing.");
}


// Redirect to result page

header('Location: testresult.php?id=' . $report_id);
exit;
?>
