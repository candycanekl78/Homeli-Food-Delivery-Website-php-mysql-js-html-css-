<?php

require_once '../config/config.php';

$pageTitle = "Dashboard";
require_once 'includes/header.php';

// Get stats with error handling
try {
    // Total orders count
    $orders = $conn->query("SELECT COUNT(*) as count FROM orders")->fetch()['count'];
    
    // Total users count
    $users = $conn->query("SELECT COUNT(*) as count FROM users")->fetch()['count'];
    
    // Total revenue (handle NULL case)
    $revenueResult = $conn->query("SELECT SUM(total_amount) as total FROM orders")->fetch();
    $revenue = $revenueResult['total'] ?? 0;
    
    // Total menu items
    $menuItems = $conn->query("SELECT COUNT(*) as count FROM menu_items")->fetch()['count'];
    
    // Recent orders (last 5)
    $recentOrders = $conn->query("
        SELECT o.*, u.name as customer 
        FROM orders o 
        JOIN users u ON o.user_id = u.id 
        ORDER BY o.created_at DESC 
        LIMIT 5
    ")->fetchAll();
    
    // Order status counts
    $statusCounts = $conn->query("
        SELECT status, COUNT(*) as count 
        FROM orders 
        GROUP BY status
    ")->fetchAll(PDO::FETCH_KEY_PAIR);
    
} catch (PDOException $e) {
    error_log("Dashboard Error: " . $e->getMessage());
    // Initialize empty values to prevent errors
    $orders = $users = $revenue = $menuItems = 0;
    $recentOrders = [];
    $statusCounts = [];
}
?>

<style>


/* Add to your header.css or create dashboard.css */
.dashboard-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    width: 300px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    color: white;
}

.card-primary .card-header { background: var(--primary); }
.card-success .card-header { background: var(--success); }
.card-info .card-header { background: var(--info); }
.card-warning .card-header { background: var(--warning); }

.card-body {
    padding: 20px;
    text-align: center;
}

.card-body h3 {
    font-size: 2rem;
    margin-bottom: 5px;
}

.card-body p {
    color: var(--gray);
    font-size: 0.9rem;
}

.card-footer {
    padding: 10px 20px;
    background: var(--light-gray);
    font-size: 0.8rem;
    color: var(--gray);
    
}

.content-wrapper {
    padding: 20px;
    transition: all 0.3s ease;
}

.dashboard-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -250px;
   
 
}

.col-md-8 {
    flex: 0 0 66.666667%;
    max-width: 66.666667%;
    padding: 0 15px;
}

.col-md-4 {
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
    padding: 0 15px;
}

@media (max-width: 992px) {
    .col-md-8,
    .col-md-4 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
.chart-container{

   margin-right:300px;
}
</style>
<div class="content-wrapper">
    <div class="dashboard-cards">
        <!-- Revenue Card -->
        <div class="card card-primary">
            <div class="card-header">
                <h3>Total Revenue</h3>
                <i class="fas fa-rupee-sign"></i>
            </div>
            <div class="card-body">
                <h3>₹<?= number_format($revenue, 2) ?></h3>
                <p>All time revenue</p>
            </div>
            <div class="card-footer">
                <i class="fas fa-calendar-alt"></i> Updated <?= date('H:i') ?>
            </div>
        </div>
        
        <!-- Orders Card -->
        <div class="card card-success">
            <div class="card-header">
                <h3>Total Orders</h3>
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="card-body">
                <h3><?= number_format($orders) ?></h3>
                <p>Orders placed</p>
            </div>
            <div class="card-footer">
                <i class="fas fa-calendar-alt"></i> Updated <?= date('H:i') ?>
            </div>
        </div>
        
        <!-- Users Card -->
        <div class="card card-info">
            <div class="card-header">
                <h3>Registered Users</h3>
                <i class="fas fa-users"></i>
            </div>
            <div class="card-body">
                <h3><?= number_format($users) ?></h3>
                <p>Active customers</p>
            </div>
            <div class="card-footer">
                <i class="fas fa-calendar-alt"></i> Updated <?= date('H:i') ?>
            </div>
        </div>
        
        <!-- Menu Items Card -->
        <div class="card card-warning">
            <div class="card-header">
                <h3>Menu Items</h3>
                <i class="fas fa-utensils"></i>
            </div>
            <div class="card-body">
                <h3><?= number_format($menuItems) ?></h3>
                <p>Available dishes</p>
            </div>
            <div class="card-footer">
                <i class="fas fa-calendar-alt"></i> Updated <?= date('H:i') ?>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="data-table-container" >
                <div class="table-header">
                    <h2 style="margin-left:250px;">Recent Orders</h2>
                    <a href="orders/" class="btn btn-primary btn-sm" style="margin-left:250px; border-radius:8px; border:2px solid #ff5511cc; padding:5px; background-color: #ff5511cc; color: white; text-decoration: none;">View All</a>
                    
                </div>
                <br>
                
                <div class="table-responsive">
                    <table class="data-table" style="margin-right:500px";>
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recentOrders)): ?>
                                <?php foreach ($recentOrders as $order): ?>
                                <tr>
                                    <td><?= htmlspecialchars($order['order_number']) ?></td>
                                    <td><?= htmlspecialchars($order['customer']) ?></td>
                                    <td>₹<?= number_format($order['total_amount'], 2) ?></td>
                                    <td>
                                        <span class="status-badge <?= htmlspecialchars($order['status']) ?>">
                                            <?= ucfirst(htmlspecialchars($order['status'])) ?>
                                        </span>
                                    </td>
                                    <td><?= date('d M Y', strtotime($order['created_at'])) ?></td>
                                    <td class="actions">
                                        <a href="orders/details.php?id=<?= $order['id'] ?>" class="btn btn-view btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No recent orders found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4" >
            <div class="data-table-container" >
                <div class="table-header">
                    <h2>Order Status</h2>
                </div>
                
                <div class="chart-container">
                    <canvas id="statusChart" height="250"></canvas>
                </div>
                
                <div class="status-summary">
                    <?php if (!empty($statusCounts)): ?>
                        <?php foreach ($statusCounts as $status => $count): ?>
                        <div class="status-item">
                            <span class="status-badge <?= htmlspecialchars($status) ?>">
                                <?= ucfirst(htmlspecialchars($status)) ?>
                            </span>
                            <span class="status-count"><?= number_format($count) ?></span>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-3">No order data available</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize chart if element exists and we have data
    const ctx = document.getElementById('statusChart');
    if (ctx) {
        const statusData = <?= json_encode($statusCounts) ?>;
        
        if (Object.keys(statusData).length > 0) {
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(statusData).map(label => label.charAt(0).toUpperCase() + label.slice(1)),
                    datasets: [{
                        data: Object.values(statusData),
                        backgroundColor: [
                            '#FF7B25', // pending
                            '#28a745', // confirmed
                            '#17a2b8', // dispatched
                            '#ffc107', // delivered
                            '#dc3545'  // cancelled
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 10,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        }
                    },
                    cutout: '70%'
                }
            });
        }
    }
    
    // Handle sidebar state on load
    const sidebar = document.querySelector('.admin-sidebar');
    const mainContent = document.querySelector('.main-content');
    const header = document.querySelector('.admin-header');
    
    if (localStorage.getItem('sidebarCollapsed') === 'true') {
        sidebar.classList.add('collapsed');
        mainContent.style.marginLeft = '80px';
        header.style.left = '80px';
    }
});
</script>

