<?php
require_once 'config/config.php';

// Redirect to login if not authenticated
if (!isLoggedIn()) {
    header("Location: main/login/login.php");
    exit();
}


?>
<?php
$currentPage = basename($_SERVER['PHP_SELF']);

switch ($currentPage) {
    case 'dashboard.php':
        $pageTitle = "Homeli - Dashboard";
        break;
    case 'menu.php':
        $pageTitle = "Homeli - Menu";
        break;
    case 'orders.php':
        $pageTitle = "Homeli - Orders";
        break;
    case 'settings.php':
        $pageTitle = "Homeli - Settings";
        break;
    case 'messages.php':
        $pageTitle = "Homeli - Messages";
        break;
    default:
        $pageTitle = "Homeli";
        break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="styles-dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fontsource/cal-sans@latest/index.css" rel="stylesheet">

    
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <main class="content-wrapper">
        <div id="dynamic-content">
            <!-- Default content will be loaded here -->
            <section class="hero">
                <div class="content">
                    <div class="search">
                        <input type="text" placeholder="Search">
                    </div>
                    <br>
                    <h1>Fastest Delivery & Easy Pickup!</h1>
                    <p>Order any meal at any time and we will deliver it directly to your home.</p>
                    <a href="main/menu/menu.php"><button class="order-btn" >Make an order</button></a>
                    <br>
                    <a href="main/menu/menu.php?category=lunch" class="specials">Specials for lunch →</a>
                </div>
                <div class="image">
                    <img src="./assets/images/main.png" alt="Main Dish" />
                </div>
            </section>

            <section class="food-inspiration">
                <h2>Inspiration for your first order</h2>
                <div class="food-container">
                    <div class="food-item">
                        <img src="./assets/images/pizza.avif" alt="Pizza">
                        <p>Pizza</p>
                    </div>
                    <div class="food-item">
                        <img src="./assets/images/biriyani.avif" alt="Biryani">
                        <p>Biryani</p>
                    </div>
                    <div class="food-item">
                        <img src="./assets/images/burger.avif" alt="Burger">
                        <p>Burger</p>
                    </div>
                    <div class="food-item">
                        <img src="./assets/images/cake.avif" alt="Cake">
                        <p>Cake</p>
                    </div>
                    <div class="food-item">
                        <img src="./assets/images/chicken.avif" alt="Chicken">
                        <p>Chicken</p>
                    </div>
                    <div class="food-item">
                        <img src="./assets/images/sandwich.avif" alt="Sandwich">
                        <p>Sandwich</p>
                    </div>
                </div>
                <br><br>

                <section class="features" >
                    <h2>Why Homeli?</h2>
                    <br>
                    <div class="feature-container">
                        <div class="feature">
                            <img src="./assets/images/order.png" alt="Easy to Order">
                            <h3>Easy to Order</h3>
                            <p>Keep healthy food readily available. When you get hungry, you're more likely to.</p>
                        </div>
                        <div class="feature">
                            <img src="./assets/images/tasty.png" alt="Delicious Taste">
                            <h3>Delicious Taste</h3>
                            <p>Keep healthy food readily available. When you get hungry, you're more likely to.</p>
                        </div>
                        <div class="feature">
                            <img src="./assets/images/delivery.png" alt="Fastest Delivery">
                            <h3>Fastest Delivery</h3>
                            <p>Keep healthy food readily available. When you get hungry, you're more likely to.</p>
                        </div>
                    </div>
           
                </section>
                           <!-- Footer Section -->
            <footer>
                <div class="footer-container">
                    <div class="footer-column brand">
                        <h2><span class="highlight">Home</span>li</h2>
                        <p><i class="fa-regular fa-envelope"></i> info@homeli.com</p>
                        <p><i class="fa-solid fa-phone"></i> 910 468 587 1235</p>
                        <p><i class="fa-solid fa-location-dot"></i> Avenue 6th floor, Bangalore,Karnataka</p>
                    </div>
                    <div class="footer-column">
                        <h3>Our Menu</h3>
                        <ul>
                            <li><a href="#" class="active">Breakfast</a></li>
                            <li><a href="#" class="active">Lunch</a></li>
                            <li><a href="#" class="active">Dinner</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h3>Information</h3>
                        <ul>
                            <li><a href="./main/about_us/about.html" class="active">About Us</a></li>
                            <li><a href="#" class="active">Testimonials</a></li>
                            <li><a href="#" class="active">Blog</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h3>Useful Links</h3>
                        <ul>
                            <li><a href="#" class="#">Services</a></li>
                            <li><a href="#" class="active">Help & Support</a></li>
                            <li><a href="#" class="active">Terms & Conditions</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h3>Social</h3>
                        <ul class="social-icons">
                            <li><i class="fa-brands fa-facebook"></i>Facebook</li>
                            <li><i class="fa-brands fa-instagram"></i>Instagram  </li>
                            <li><i class="fa-brands fa-youtube"></i>&nbsp;&nbsp;Youtube</li>
                        </ul>
                    </div>
                </div>
            </footer>
            </section>
        </div>
        
    </main>
    

    <script>
        // Function to load content dynamically
        const pageTitles = {
    'dashboard': 'Homeli Dashboard',
    'menu': 'Menu',
    'orders': 'My Orders',
    'profile': 'My Profile',
    'settings': 'Settings',
    'messages': 'Messages'
};
            
            // Update page title
            document.querySelector('.page-title').textContent = pageTitles[page] || page;
            document.title = `Homeli | ${pageTitles[page] || page}`;
            updateSidebarActiveState(page);
            
            // Handle dashboard content
            if (page === 'dashboard') {
                document.getElementById('dynamic-content').innerHTML = `
                    <section class="hero">
                        <div class="content">
                            <div class="search">
                                <input type="text" placeholder="Search">
                            </div>
                            <br>
                            <h1>Fastest Delivery & Easy Pickup.</h1>
                            <p>Order any meal at any time and we will deliver it directly to your home.</p>
                            <button class="order-btn" onclick="loadContent('menu')">Make an order</button>
                            <br>
                            <a href="#" class="specials">Specials for lunch →</a>
                        </div>
                        <div class="image">
                            <img src="./assets/images/main.png" alt="Main Dish" />
                        </div>
                    </section>

                    <section class="food-inspiration">
                        <h2>Inspiration for your first order</h2>
                        <div class="food-container">
                            <div class="food-item">
                                <img src="./assets/images/pizza.avif" alt="Pizza">
                                <p>Pizza</p>
                            </div>
                            <div class="food-item">
                                <img src="./assets/images/biriyani.avif" alt="Biryani">
                                <p>Biryani</p>
                            </div>
                            <div class="food-item">
                                <img src="./assets/images/burger.avif" alt="Burger">
                                <p>Burger</p>
                            </div>
                            <div class="food-item">
                                <img src="./assets/images/cake.avif" alt="Cake">
                                <p>Cake</p>
                            </div>
                            <div class="food-item">
                                <img src="./assets/images/chicken.avif" alt="Chicken">
                                <p>Chicken</p>
                            </div>
                            <div class="food-item">
                                <img src="./assets/images/sandwich.avif" alt="Sandwich">
                                <p>Sandwich</p>
                            </div>
                        </div>
                        <br><br>

                        <section class="features">
                            <h2>Why Homeli?</h2>
                            <br>
                            <div class="feature-container">
                                <div class="feature">
                                    <img src="./assets/images/order.avif" alt="Easy to Order">
                                    <h3>Easy to Order</h3>
                                    <p>Keep healthy food readily available. When you get hungry, you're more likely to.</p>
                                </div>
                                <div class="feature">
                                    <img src="./assets/images/tasty.avif" alt="Delicious Taste">
                                    <h3>Delicious Taste</h3>
                                    <p>Keep healthy food readily available. When you get hungry, you're more likely to.</p>
                                </div>
                                <div class="feature">
                                    <img src="./assets/images/delivery.jpg" alt="Fastest Delivery">
                                    <h3>Fastest Delivery</h3>
                                    <p>Keep healthy food readily available. When you get hungry, you're more likely to.</p>
                                </div>
                            </div>
                        </section>
                          <!-- Footer Section -->
            <footer>
                <div class="footer-container">
                    <div class="footer-column brand">
                        <h2><span class="highlight">Home</span>li</h2>
                        <p><i class="fa-regular fa-envelope"></i> info@foodexpress.com</p>
                        <p><i class="fa-solid fa-phone"></i> 910 468 587 1235</p>
                        <p><i class="fa-solid fa-location-dot"></i> Avenue 6th floor, NYC</p>
                    </div>
                    <div class="footer-column">
                        <h3>Our Menu</h3>
                        <ul>
                            <li><a href="#" class="active">Breakfast</a></li>
                            <li><a href="#" class="active">Lunch</a></li>
                            <li><a href="#" class="active">Dinner</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h3>Information</h3>
                        <ul>
                            <li><a href="./main/about_us/about.html" class="active">About Us</a></li>
                            <li><a href="#" class="active">Testimonials</a></li>
                            <li><a href="#" class="active">Blog</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h3>Useful Links</h3>
                        <ul>
                            <li><a href="#" class="#">Services</a></li>
                            <li><a href="#" class="active">Help & Support</a></li>
                            <li><a href="#" class="active">Terms & Conditions</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h3>Social</h3>
                        <ul class="social-icons">
                            <li><i class="fa-brands fa-facebook"></i> Facebook</li>
                            <li><i class="fa-brands fa-instagram"></i> Instagram</li>
                            <li><i class="fa-brands fa-youtube"></i> Youtube</li>
                        </ul>
                    </div>
                </div>
            </footer>
                    </section>
                `;
                return;
            }
            
            // Define correct paths for each page
            const pagePaths = {
                'menu': 'main/menu/menu.php',
                'orders': 'main/orders/orders.php'
            };
            
            // Load the content
            fetch(pagePaths[page])
    .then(response => {
        if (!response.ok) {
            // If 401 unauthorized, redirect to login
            if (response.status === 401) {
                window.location.href = 'main/login/login.php';
                return;
            }
            throw new Error(`Failed to load ${page} (Status: ${response.status})`);
        }
        return response.text();
    })

                .then(html => {
                    document.getElementById('dynamic-content').innerHTML = html;
                    // Initialize page-specific scripts
                    if (page === 'menu') initMenuPage();
                    if (page === 'orders') initOrdersPage();
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('dynamic-content').innerHTML = `
                        <div class="error-message">
                            Error loading ${page} content. Please try again.
                            <br><small>${error.message}</small>
                        </div>
                    `;
                });
        }

        function updateSidebarActiveState(activePage) {
            document.querySelectorAll('.sidebar-nav li').forEach(li => {
                li.classList.remove('active');
                if (li.querySelector('a').getAttribute('data-page') === activePage) {
                    li.classList.add('active');
                }
            });
        }

        function initMenuPage() {
            // Category switching
            document.querySelectorAll('.category').forEach(btn => {
                btn.addEventListener('click', function() {
                    const category = this.dataset.category;
                    fetch(`main/menu/menu.php?category=${category}`)
                        .then(response => response.text())
                        .then(html => {
                            const menuContainer = document.querySelector('#menuItemsContainer');
                            if (menuContainer) {
                                menuContainer.innerHTML = html;
                                attachMenuEventHandlers();
                            }
                        });
                });
            });
            
            attachMenuEventHandlers();
            fetchCart();
        }

        function initOrdersPage() {
            // Any order-specific initialization
            fetchCart();
            
            // Attach event handlers for order actions
            document.querySelectorAll('.cancel-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const orderId = this.dataset.orderId;
                    cancelOrder(orderId);
                });
            });
            
            document.querySelectorAll('.reorder-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const itemIds = JSON.parse(this.dataset.items);
                    reorderItems(itemIds);
                });
            });
        }

        function attachMenuEventHandlers() {
            document.querySelectorAll('.add-icon').forEach(icon => {
                icon.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const itemId = this.closest('.menu-item').dataset.id;
                    addToCart(itemId);
                });
            });
        }

        function addToCart(itemId) {
            fetch('main/menu/add_to_cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `itemId=${itemId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    fetchCart();
                    showNotification('Item added to cart!', 'success');
                }
            });
        }

        function fetchCart() {
            fetch('main/menu/get_cart_items.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const cartBadge = document.querySelector('.cart-badge');
                        if (cartBadge) cartBadge.textContent = data.totalItems || '0';
                    }
                });
        }

        function cancelOrder(orderId) {
            if (confirm('Are you sure you want to cancel this order?')) {
                fetch('main/orders/cancel_order.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ order_id: orderId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Order cancelled successfully', 'success');
                        loadContent('orders'); // Refresh orders list
                    }
                });
            }
        }

        function reorderItems(itemIds) {
            fetch('main/menu/add_to_cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ items: itemIds.map(id => ({ id, quantity: 1 })) })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Items added to cart!', 'success');
                    loadContent('menu');
                }
            });
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            // Set up navigation
            document.querySelectorAll('[data-page]').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const page = this.getAttribute('data-page');
                    loadContent(page);
                    history.pushState({ page }, '', `?page=${page}`);
                });
            });
            
            // Handle browser navigation
            window.addEventListener('popstate', function(event) {
                loadContent(event.state?.page || 'dashboard');
            });
            
            // Load initial page
            const urlParams = new URLSearchParams(window.location.search);
            loadContent(urlParams.get('page') || 'dashboard');
        });

        // Add to your existing JavaScript
function checkSession() {
    fetch('config/session_check.php')
        .then(response => response.json())
        .then(data => {
            if (!data.valid) {
                window.location.href = 'main/login/login.php';
            }
        });
}

// Check every 5 minutes
setInterval(checkSession, 300000);
    </script>
</body>
</html>