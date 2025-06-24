<aside class="admin-sidebar">
    <div class="sidebar-brand">
        <img src="logo1.png" alt="Homeli Logo" class="logo-img">
        <h2 class="brand-text">Homeli User</h2>
        <div class="sidebar-toggle-mobile" onclick="toggleMobileSidebar()">
            <i class="fas fa-times"></i>
        </div>
    </div>
    
    <nav class="sidebar-nav">
    <ul class="sidebar-nav">
        <li class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">
            <a href="<?= SITE_BASE_URL ?>dashboard.php">
                <div class="nav-icon">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                <span class="nav-text">Dashboard</span>
                <div class="nav-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>
        </li>
        
        <li class="<?= basename($_SERVER['PHP_SELF']) == 'menu.php' ? 'active' : '' ?>">
            <a href="<?= SITE_BASE_URL ?>main/menu/menu.php">
                <div class="nav-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <span class="nav-text">Menu</span>
                <div class="nav-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>
        </li>
        
        <li class="<?= basename($_SERVER['PHP_SELF']) == 'orders.php' ? 'active' : '' ?>">
            <a href="<?= SITE_BASE_URL ?>main/orders/orders.php">
                <div class="nav-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <span class="nav-text">Orders</span>
                <div class="nav-badge">15</div>
                <div class="nav-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>
        </li>
    
            
            <li class="<?= basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : '' ?>">
            <a href="<?= SITE_BASE_URL ?>main/settings/settings.php">
                    <div class="nav-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <span class="nav-text">Settings</span>
                    <div class="nav-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>
            </li>
            
            <li class="<?= basename($_SERVER['PHP_SELF']) == 'help_feedback.php' ? 'active' : '' ?>">
                <a href="<?= SITE_BASE_URL ?>main/help&feedback/help_feedback.php">
                    <div class="nav-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <span class="nav-text">Help and feedback</span>
                    <div class="nav-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>
            </li>
            
            <li class="<?= basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : '' ?>">
            <a href="<?= SITE_BASE_URL ?>main/about/about.php">
                    <div class="nav-icon">
                        <i class="fas fa-circle-info"></i>
                    </div>
                    <span class="nav-text">About</span>
                    <div class="nav-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>
            </li>
        </ul>
    </nav>
    
    <div class="sidebar-footer">
        <div class="user-profile">
            
            <a href="logout.php" class="logout-btn" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
    </div>
</aside>

<style>
/* Sidebar Styles */
.admin-sidebar {
    width: 280px;
    height: 100vh;
    background: linear-gradient(135deg, #1B1716 0%, #2E2A29 100%);
    color: #fff;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
    display: flex;
    flex-direction: column;
    box-shadow: 5px 0 15px rgba(0, 0, 0, 0.1);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    overflow: hidden;
}

.admin-sidebar.collapsed {
    width: 80px;
}

.sidebar-brand {
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
    min-height: 80px;
}

.logo-img {
    height: 30px;
    transition: all 0.3s ease;
}

.brand-text {
    color: #fff;
    font-size: 1.3rem;
    font-weight: 700;
    margin-left: 10px;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.sidebar-toggle-mobile {
    display: none;
    color: #fff;
    font-size: 1.2rem;
    cursor: pointer;
    padding: 5px;
}

.sidebar-nav {
    flex: 1;
    padding: 20px 0;
    overflow-y: auto;
}

.sidebar-nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-nav li {
    position: relative;
    margin: 5px 0;
}

.sidebar-nav li a {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.sidebar-nav li a:hover {
    color: #fff;
    background: rgba(255, 123, 37, 0.2);
    transform: translateX(5px);
}

.sidebar-nav li.active a {
    color: #fff;
    background: linear-gradient(90deg, rgba(255, 123, 37, 0.3) 0%, rgba(255, 123, 37, 0) 100%);
}

.sidebar-nav li.active::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 4px;
    background: #FF7B25;
}

.nav-icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.nav-text {
    margin-left: 15px;
    font-weight: 500;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.nav-badge {
    margin-left: auto;
    background: #FF7B25;
    color: #fff;
    font-size: 0.7rem;
    font-weight: 600;
    padding: 3px 8px;
    border-radius: 10px;
    min-width: 20px;
    text-align: center;
}

.nav-arrow {
    margin-left: 10px;
    font-size: 0.7rem;
    opacity: 0.7;
    transition: all 0.3s ease;
}

.sidebar-nav li a:hover .nav-arrow {
    opacity: 1;
    transform: translateX(3px);
}

.sidebar-footer {
    padding: 15px;
    background: rgba(0, 0, 0, 0.2);
    border-top: 1px solid rgba(255, 255, 255, 0.05);
}

.user-profile {
    display: flex;
    align-items: center;
    position: relative;
}

.profile-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid rgba(255, 123, 37, 0.5);
    transition: all 0.3s ease;
}

.profile-info {
    margin-left: 10px;
    transition: all 0.3s ease;
    overflow: hidden;
    white-space: nowrap;
}

.profile-info h4 {
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 2px;
    color: #fff;
}

.profile-info p {
    font-size: 0.7rem;
    color: rgba(255, 255, 255, 0.6);
}

.logout-btn {
    margin-left: auto;
    color: rgba(255, 255, 255, 0.6);
    font-size: 1rem;
    transition: all 0.3s ease;
    background: none;
    border: none;
    cursor: pointer;
    padding: 5px;
}

.logout-btn:hover {
    color: #FF7B25;
    transform: rotate(180deg);
}

/* Collapsed State */
.admin-sidebar.collapsed .brand-text,
.admin-sidebar.collapsed .nav-text,
.admin-sidebar.collapsed .nav-arrow,
.admin-sidebar.collapsed .profile-info,
.admin-sidebar.collapsed .nav-badge {
    opacity: 0;
    width: 0;
    height: 0;
    margin: 0;
    padding: 0;
    display: none;
}

.admin-sidebar.collapsed .sidebar-nav li a {
    justify-content: center;
    padding: 15px 0;
}

.admin-sidebar.collapsed .sidebar-nav li.active::before {
    width: 3px;
}

.admin-sidebar.collapsed .logout-btn {
    margin-left: 0;
}

/* Mobile Responsive */
@media (max-width: 992px) {
    .admin-sidebar {
        left: -280px;
    }
    
    .admin-sidebar.show {
        left: 0;
    }
    
    .sidebar-toggle-mobile {
        display: block;
    }
}
</style>

<script>
// Toggle mobile sidebar
function toggleMobileSidebar() {
    document.querySelector('.admin-sidebar').classList.toggle('show');
}
</script>