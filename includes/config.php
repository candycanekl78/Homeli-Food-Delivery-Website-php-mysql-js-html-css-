<?php
// Admin-specific configuration
define('ADMIN_TITLE', 'Homeli Admin');
define('ITEMS_PER_PAGE', 10);
define('ALLOWED_IMAGE_TYPES', ['jpg', 'jpeg', 'png', 'webp']);
define('MAX_IMAGE_SIZE', 2 * 1024 * 1024); // 2MB

// Admin email for notifications
define('ADMIN_EMAIL', 'admin@homeli.com');

// Path configuration
define('ADMIN_BASE_URL', '/admin');
define('MENU_IMAGE_PATH', '../../uploads/menu/');

// Create uploads directory if not exists
if (!file_exists(MENU_IMAGE_PATH)) {
    mkdir(MENU_IMAGE_PATH, 0755, true);
}

// Additional security headers
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
header("Content-Security-Policy: default-src 'self'");