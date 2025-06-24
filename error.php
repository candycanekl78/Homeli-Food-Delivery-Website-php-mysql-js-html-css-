<?php
// Optional: You can log the detailed error to a file for debugging in production.
error_log("Error: " . $_SERVER['REQUEST_URI'] . " encountered an issue.", 3, 'errors.log');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Something Went Wrong</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="error-container">
        <h1>Oops! Something went wrong.</h1>
        <p>We are unable to process your request at the moment. Please try again later.</p>
        <a href="index.php">Return to Home</a>
    </div>
</body>
</html>
