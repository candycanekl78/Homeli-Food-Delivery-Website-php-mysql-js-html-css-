<?php
// Database configuration
$host = "localhost";      // Database host
$dbname = "homeli";       // Database name
$username = "root";       // Database username
$password = "";           // Database password

// Session configuration
   // In config.php, update the session configuration section:
session_set_cookie_params([
    'lifetime' => 86400,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => isset($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Lax'
]);

// Define base URL
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
define('SITE_BASE_URL', $protocol . $_SERVER['HTTP_HOST'] . '/homeli/');

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
define('ADMIN_BASE_URL', $protocol . $_SERVER['HTTP_HOST'] . '/homeli/admin/');

// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Regenerate ID periodically for security
if (!isset($_SESSION['created'])) {
    $_SESSION['created'] = time();
} elseif (time() - $_SESSION['created'] > 1800) {
    session_regenerate_id(true);
    $_SESSION['created'] = time();
}
    
    // Start session and regenerate ID to prevent fixation
    session_start();
    session_regenerate_id(true);

try {
    // Establish database connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set PDO attributes
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch (PDOException $e) {
    error_log("[" . date('Y-m-d H:i:s') . "] Database Connection Error: " . $e->getMessage() . "\n", 3, __DIR__.'/errors.log');
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

/**
 * Generate CSRF token and store in session
 */
function generateCSRFToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validate CSRF token
 */
function validateCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Secure redirect function
 */
function redirect($url) {
    if (!headers_sent()) {
        header("Location: $url");
        exit();
    } else {
        echo '<script>window.location.href="'.$url.'";</script>';
        exit();
    }
}

/**
 * Sanitize input data
 */
function sanitizeInput($data) {
    if (is_array($data)) {
        return array_map('sanitizeInput', $data);
    }
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Get current user ID
 */
function getUserId() {
    return $_SESSION['user_id'] ?? null;
}

/**
 * Generate order number
 */
function generateOrderNumber() {
    return 'ORD-' . strtoupper(uniqid()) . '-' . strtoupper(bin2hex(random_bytes(2)));
}

/**
 * Calculate order totals
 */
function calculateOrderTotals($cart) {
    $subtotal = array_reduce($cart, function($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);
    
    $gst = $subtotal * 0.05; // 5% GST
    $total = $subtotal + $gst;
    
    return [
        'subtotal' => $subtotal,
        'gst' => $gst,
        'total' => $total
    ];
}

/**
 * Get the user's display name (prioritizes first name)
 */
function getDisplayName() {
    return $_SESSION['first_name'] ?? $_SESSION['admin_name'] ?? 'Admin';
}

/**
 * Generate avatar URL using the user's name
 */
function getAvatarUrl() {
    $name = getDisplayName();
    return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=FF7B25&color=fff';
}

function getUserInitials() {
    $first = $_SESSION['first_name'][0] ?? '';
    $last = $_SESSION['last_name'][0] ?? '';
    return $first . $last;
}



/**
 * Log errors with timestamp
 */
function logError($message) {
    $logMessage = "[" . date('Y-m-d H:i:s') . "] " . $message . "\n";
    error_log($logMessage, 3, __DIR__.'/errors.log');
}

// Generate CSRF token for forms
generateCSRFToken();
?>