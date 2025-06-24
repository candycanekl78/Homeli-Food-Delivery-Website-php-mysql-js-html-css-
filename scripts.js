// scripts.js

// Toggle password visibility for sign-in and sign-up forms
const togglePassword = document.querySelectorAll('.toggle-password'); // Get all the eye icons
const passwordInputs = document.querySelectorAll('.password-input'); // Get all password input fields

togglePassword.forEach((icon, index) => {
    icon.addEventListener('click', () => {
        // Toggle the type of the corresponding password input (password <-> text)
        const input = passwordInputs[index];
        if (input.type === 'password') {
            input.type = 'text'; // Show password
        } else {
            input.type = 'password'; // Hide password
        }
    });
});


// Cart functionality
function toggleCartPopup() {
    document.getElementById('cartPopup').classList.toggle('open');
    document.getElementById('overlay').style.display = 'block';
    loadCartItems();
}

function closeCartPopup() {
    document.getElementById('cartPopup').classList.remove('open');
    document.getElementById('overlay').style.display = 'none';
}

function loadCartItems() {
    fetch('get_cart_items.php')
        .then(response => response.json())
        .then(data => {
            const cartItemsContainer = document.getElementById('cartItems');
            const cartCountElement = document.getElementById('cart-count');
            
            if (data.items.length === 0) {
                cartItemsContainer.innerHTML = '<div class="empty-cart">Your cart is empty</div>';
                document.getElementById('subtotal').textContent = '₹0.00';
                document.getElementById('gst').textContent = '₹0.00';
                document.getElementById('total').textContent = '₹0.00';
                cartCountElement.textContent = '0';
                return;
            }
            
            let html = '';
            let subtotal = 0;
            
            data.items.forEach(item => {
                html += `
                    <div class="cart-item" data-id="${item.id}">
                        <img src="${item.image}" alt="${item.name}" class="cart-item-img">
                        <div class="cart-item-details">
                            <div class="cart-item-title">${item.name}</div>
                            <div class="cart-item-price">₹${item.price.toFixed(2)}</div>
                            <div class="quantity-controls">
                                <button class="quantity-btn" onclick="updateCartItem(${item.id}, -1)">-</button>
                                <span class="quantity-value">${item.quantity}</span>
                                <button class="quantity-btn" onclick="updateCartItem(${item.id}, 1)">+</button>
                            </div>
                        </div>
                        <i class="fas fa-times remove-item" onclick="removeFromCart(${item.id})"></i>
                    </div>
                `;
                subtotal += item.price * item.quantity;
            });
            
            cartItemsContainer.innerHTML = html;
            
            const gst = subtotal * 0.05;
            const total = subtotal + gst;
            
            document.getElementById('subtotal').textContent = `₹${subtotal.toFixed(2)}`;
            document.getElementById('gst').textContent = `₹${gst.toFixed(2)}`;
            document.getElementById('total').textContent = `₹${total.toFixed(2)}`;
            cartCountElement.textContent = data.totalItems;
        });
}

function updateCartItem(itemId, change) {
    fetch('update_cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `itemId=${itemId}&change=${change}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadCartItems();
        }
    });
}

function removeFromCart(itemId) {
    if (confirm('Remove this item from cart?')) {
        fetch('remove_from_cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `itemId=${itemId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadCartItems();
            }
        });
    }
}

function proceedToCheckout() {
    const location = document.getElementById('deliveryLocation').value;
    if (!location) {
        alert('Please select a delivery location');
        return;
    }
    
    // Save location to session
    fetch('save_location.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `location=${location}`
    })
    .then(() => {
        window.location.href = 'checkout.php';
    });
}