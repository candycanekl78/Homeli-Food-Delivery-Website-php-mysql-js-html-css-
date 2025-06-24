<?php
// homeli/includes/footer.php
?>
        </div> <!-- Close main-content -->
    </div> <!-- Close admin-container -->
    
    <!-- All your footer scripts -->
    <script>
        // Sidebar toggle functionality
        function toggleSidebar() {
            const sidebar = document.querySelector('.admin-sidebar');
            const header = document.querySelector('.admin-header');
            
            sidebar.classList.toggle('collapsed');
            
            if (sidebar.classList.contains('collapsed')) {
                header.style.left = '80px';
            } else {
                header.style.left = '280px';
            }
            
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        }

        // Initialize sidebar state
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.admin-sidebar');
            const header = document.querySelector('.admin-header');
            const isCollapsed = localStorage.getItem('sidebarCollapsed') !== 'false';
            
            if (isCollapsed) {
                sidebar.classList.add('collapsed');
                header.style.left = '80px';
            } else {
                sidebar.classList.remove('collapsed');
                header.style.left = '280px';
            }
        });
    </script>
</body>
</html>