<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Get user initials directly in header.php
$userInitials = '';
if (isset($_SESSION['first_name'])) {  // Added missing parenthesis
    $userInitials .= substr($_SESSION['first_name'], 0, 1);
}
if (isset($_SESSION['last_name'])) {
    $userInitials .= substr($_SESSION['last_name'], 0, 1);
}
$userInitials = $userInitials ?: 'U'; // Fallback to 'U' if no name

// Define page title if not set
$pageTitle = $pageTitle ?? 'Homeli Dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homeli Admin | <?= htmlspecialchars($pageTitle) ?></title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" href="../assets/images/.png" type="image/png">
    <link rel="stylesheet" href="header.css" class="stylesheet">
    <style>
        :root {
            --primary: #FF7B25;
            --primary-light: #FFE8DC;
            --secondary: #1B1716;
            --light: #FFFFFF;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
            --gray: #6c757d;
            --light-gray: #f8f9fa;
            --dark-gray: #343a40;
            --sidebar-width: 280px;
            --header-height: 70px;
            --transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --radius: 10px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f5f7fa;
            color: var(--secondary);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Admin Layout */
        .admin-container {
            display: flex;
            min-height: 100vh;
            
        }

        /* Header Styles */
        /* Update the admin-header positioning */
        .admin-header {
    position: fixed;
    top: 0;
    right: 0;
    left: 80px; /* Default collapsed position */
    height: var(--header-height);
    background: var(--light);
    box-shadow: var(--shadow);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 30px;
    z-index: 1000;
    transition: all 0.3s ease; /* Smooth transition */
}

.admin-sidebar {
    width: 280px;
    transition: all 0.3s ease;
}

.admin-sidebar.collapsed {
    width: 80px;
}
        

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.3rem;
            color: var(--secondary);
            cursor: pointer;
            transition: var(--transition);
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .sidebar-toggle:hover {
            background-color: var(--primary-light);
            color: var(--primary);
            transform: rotate(90deg);
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--secondary);
            position: relative;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--primary);
            border-radius: 3px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
            cursor: pointer;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-light);
            transition: var(--transition);
        }

        .profile-name {
            font-weight: 500;
            color: var(--secondary);
        }

        .profile-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--light);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            width: 200px;
            padding: 10px 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: var(--transition);
            z-index: 100;
        }

        .admin-profile:hover .profile-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .profile-dropdown a {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            color: var(--secondary);
            text-decoration: none;
            transition: var(--transition);
            
        }

        .profile-dropdown a:hover {
            background: var(--primary-light);
            color: var(--primary);
            padding-left: 25px;
        }

        .profile-dropdown a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .logout-btn {
            background: none;
            border: none;
            color: var(--secondary);
            font-size: 1.2rem;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: var(--transition);
        }

        .logout-btn:hover {
            background-color: var(--primary-light);
            color: var(--danger);
            transform: scale(1.1);
        }

        .notification-bell {
            position: relative;
            cursor: pointer;
        }

        .notification-bell i {
            font-size: 1.3rem;
            color: var(--secondary);
            transition: var(--transition);
        }

        .notification-bell:hover i {
            color: var(--primary);
            transform: scale(1.1);
        }

        .notification-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger);
            color: var(--light);
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.6rem;
            font-weight: 600;
        }

        /* Responsive Header */
        @media (max-width: 992px) {
            .admin-header {
                left: 0;
            }

            .admin-sidebar.collapsed ~ .main-content .admin-header {
                left: 0;
            }

            .profile-name {
                display: none;
            }

            .page-title {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 768px) {
            .admin-header {
                padding: 0 15px;
            }

            .sidebar-toggle {
                width: 35px;
                height: 35px;
                font-size: 1.1rem;
            }
        }

        /* Animation Classes */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideInDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animate__fadeIn {
            animation: fadeIn 0.5s ease forwards;
        }

        .animate__slideInDown {
            animation: slideInDown 0.5s ease forwards;
        }
        /* Admin Layout Structure */
.admin-container {
    display: flex;
    min-height: 100vh;
}

.main-content {
    flex: 1;
    transition: all 0.3s ease;
    padding-top: 70px;
}

/* Cards */
.card {
    
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    overflow: hidden;
}

/* Tables */
.data-table {
    margin-left: 250px;
    width: 70%;
    border-collapse: collapse;
}

.data-table th {
    background: var(--primary-light);
    padding: 12px 15px;
    text-align: left;
    
}

.data-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #eee;
}

/* Responsive */
@media (max-width: 992px) {
    .admin-sidebar:not(.show) ~ .main-content {
        width: 100%;
        margin-left: 0;
    }
    
    .data-table-container {
        overflow-x: auto;
    }
}

.custom-location-selector {
  
  top: 15px;
  left: 900px; /* Adjust based on your design */
  display: flex;
  align-items: center;
  cursor: pointer;
  z-index: 999;
  position: fixed;
}

/* Left icon */
.location-icon-box i {
  font-size: 28px;
  color: #34c759;
  margin-right: 8px;
}

/* Right side of icon */
.location-info-box {
  display: flex;
  flex-direction: column;
  position: relative;
}

/* Label section */
.location-label {
  background: white;
  padding: 2px 6px;
  border-radius: 8px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.location-label small {
  display: block;
  font-size: 8px;
  color: gray;
}

.location-label strong {
  display: inline-block;
  font-size: 12px;
  color: #222;
  font-weight: bold;
}

.arrow-icon {
  font-size: 12px;
  color: #333;
  margin-left: 6px;
}

/* Dropdown list */
.location-dropdown {
  display: none;
  position: absolute;
  top: 100%;
  margin-top: 4px;
  left: 0;
  background: white;
  padding: 6px 0;
  border-radius: 6px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.2);
  width: 160px;
  list-style: none;
  z-index: 1000;
}

.location-dropdown li {
  padding: 6px 12px;
  cursor: pointer;
}

.location-dropdown li:hover {
  background-color: #f5f5f5;
}




    </style>
</head>
<body>
    <div class="admin-container">
        <?php include 'sidebar.php'; ?>
        
        <div class="main-content">
            <header class="admin-header animate__slideInDown">
                <div class="header-left">
                    <button class="sidebar-toggle" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="page-title"><?= htmlspecialchars($pageTitle) ?></h1>
                </div>
    
                
                
                
               <!-- <div class="custom-location-selector">
  <div class="location-icon-box" onclick="toggleLocationList()">
    <i class="fas fa-map-marker-alt"></i>
  </div>
  <div class="location-info-box">
    <div class="location-label" onclick="toggleLocationList()">
      <small>Delivery To</small>
      <strong id="selectedLocation">Select Location</strong>
      <i class="fas fa-chevron-down arrow-icon"></i>
    </div>
    <ul class="location-dropdown" id="locationDropdown">
      <li onclick="selectLocation('Banasree, B-Block')">Banasree, B-Block</li>
      <li onclick="selectLocation('Downtown')">Downtown</li>
      <li onclick="selectLocation('Suburbs')">Suburbs</li>
      <li onclick="selectLocation('Uptown')">Uptown</li>
    </ul>
  </div>
</div>-->


                <div class="header-right">
                    <div class="notification-bel">
                        <i class="fas fa-bel"></i>
                        <span class="notification-coun"></span>
                    </div> 

                    <div class="cart-icon-container" style="left:60px" onclick="toggleCartPopup(event)" role="button" aria-label="Shopping Cart" tabindex="0">
                <i class="fa fa-shopping-cart cart-icon" aria-hidden="true"></i>
                <span id="cart-count" class="cart-badge" aria-live="polite"><?php echo $_SESSION['cart_total'] ?? 0; ?></span>
            </div>
            


            <div class="admin-profile" style="left:50px; bottom:2px;">
    <img src="<?php echo getAvatarUrl(); ?>" alt="User" class="profile-img">
    <span class="profile-name"><?php echo htmlspecialchars(getDisplayName()); ?></span>
    
    <div class="profile-dropdown" >
        <a href="#" onclick="loadContent('profile')"><i class="fas fa-user"></i> Profile</a>
        <a href="#" onclick="loadContent('settings')"><i class="fas fa-cog"></i> Settings</a>
        <a href="#" onclick="loadContent('messages')"><i class="fas fa-envelope"></i> Messages</a>
        <a href="#" onclick="showLogoutModal(event)">
  <i class="fas fa-sign-out-alt"></i> Logout
</a>

    </div>
</div>
                    
                  
                    <button class="logout-btn" backgroun-color="black" title="Logout" onclick="window.location.href='logout.php'">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </div>


            </header>
          <div id="logoutModal" class="modal">
  <div class="modal-content">
    <h3>Are you sure you want to logout?</h3>
    <div class="modal-buttons">
      <button class="confirm" onclick="logoutUser()">Yes, Logout</button>
      <button class="cancel" onclick="closeLogoutModal()">Cancel</button>
    </div>
  </div>
</div>

            
            <script>
            
            // In header.php, update the toggleSidebar function
// Toggle sidebar and adjust header position
function toggleSidebar() {
    const sidebar = document.querySelector('.admin-sidebar');
    const header = document.querySelector('.admin-header');
    
    sidebar.classList.toggle('collapsed');
    
    // Adjust header position based on sidebar state
    if (sidebar.classList.contains('collapsed')) {
        header.style.left = '80px';
    } else {
        header.style.left = '280px';
    }
    
    // Save state
    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
}

// Initialize on load
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.admin-sidebar');
    const header = document.querySelector('.admin-header');
    
    // Set initial state (collapsed by default)
    const isCollapsed = localStorage.getItem('sidebarCollapsed') !== 'false'; // Default to true if not set
    
    if (isCollapsed) {
        sidebar.classList.add('collapsed');
        header.style.left = '80px';
    } else {
        sidebar.classList.remove('collapsed');
        header.style.left = '280px';
    }
});

function showLogoutModal(event) {
    event.preventDefault(); // Stop link from navigating
    document.getElementById('logoutModal').style.display = 'block';
}

function closeLogoutModal() {
    document.getElementById('logoutModal').style.display = 'none';
}function logoutUser() {
    window.location.href = 'main/login/login.php';
}

function toggleLocationList() {
  const dropdown = document.getElementById('locationDropdown');
  dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}

function selectLocation(location) {
  document.getElementById('selectedLocation').textContent = location;
  document.getElementById('locationDropdown').style.display = 'none';
}
// Cart Popup Functions
function toggleCartPopup(event) {
    event.stopPropagation();
    const popup = document.getElementById('cartPopup');
    const overlay = document.getElementById('overlay');
    
    if (popup.style.display === 'block') {
        popup.style.display = 'none';
        overlay.style.display = 'none';
    } else {
        popup.style.display = 'block';
        overlay.style.display = 'block';
    }
}

function closeCartPopup() {
    document.getElementById('cartPopup').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
}

// Close popup when clicking overlay
document.getElementById('overlay').addEventListener('click', closeCartPopup);

// Prevent popup from closing when clicking inside it
document.getElementById('cartPopup').addEventListener('click', function(e) {
    e.stopPropagation();
});

// Initialize cart on page load
document.addEventListener('DOMContentLoaded', function() {
    fetchCart(); // Update cart count
});

</script>
           