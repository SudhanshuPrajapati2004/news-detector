<?php
session_start();



$output = shell_exec("python3 ml/retrain.py");
echo "<h3>Model Retraining Output:</h3>";
echo "<pre>$output</pre>";
?>
