<?php
$cartItems = [];

if (isset($_COOKIE['cart'])) {
  $decoded = urldecode($_COOKIE['cart']);
  $cartItems = json_decode($decoded, true) ?? [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Your Cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .quantity-control {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .quantity-btn {
      width: 32px;
      height: 32px;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .cart-item {
      transition: background-color 0.2s;
    }
    @media (max-width: 576px) {
      .container {
        padding: 1rem;
      }
      .product-name {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body class="bg-light">
<div class="container py-3">
  <h2 class="mb-3">🛒 Your Order</h2>

  <!-- Cart Items -->
  <div class="card shadow">
    <div class="card-body p-2">
      <?php if(empty($cartItems)): ?>
        <div class="text-center text-muted py-4">
          Your cart is empty
        </div>
      <?php else: ?>
        <div class="list-group">
          <?php foreach($cartItems as $index => $item): ?>
            <div class="list-group-item cart-item d-flex justify-content-between align-items-center gap-2">
              <!-- Item Info -->
              <div class="flex-grow-1">
                <h6 class="mb-0 product-name"><?= htmlspecialchars($item['name']) ?></h6>
                <small class="text-muted">₭<?= number_format($item['price'], 2) ?></small>
              </div>

              <!-- Quantity Controls -->
              <div class="quantity-control">
                <button class="btn btn-sm btn-outline-primary quantity-btn" 
                        onclick="updateQuantity(<?= $index ?>, -1)">
                  -
                </button>
                <span class="quantity"><?= $item['quantity'] ?></span>
                <button class="btn btn-sm btn-outline-primary quantity-btn" 
                        onclick="updateQuantity(<?= $index ?>, 1)">
                  +
                </button>
              </div>

              <!-- Total Price -->
              <div class="text-end" style="min-width: 80px;">
                <span class="badge bg-primary rounded-pill">
                  ₭<?= number_format($item['price'] * $item['quantity'], 2) ?>
                </span>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <!-- Total Price -->
        <div class="d-flex justify-content-between mt-3 p-2 bg-light rounded">
          <h5 class="mb-0">Total:</h5>
          <h5 class="mb-0 fw-bold">
            ₭<?= number_format(array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cartItems)), 2) ?>
          </h5>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Action Buttons -->
  <div class="d-grid gap-2 mt-3">
    <a href="public_order.php" class="btn btn-outline-primary">
      ← Continue Shopping
    </a>
    <?php if(!empty($cartItems)): ?>
      <button class="btn btn-success" onclick="proceedToCheckout()">
        Checkout Now
      </button>
    <?php endif; ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function updateQuantity(index, change) {
  // Get current cart
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  
  // Update quantity
  cart[index].quantity += change;
  
  // Remove item if quantity <= 0
  if(cart[index].quantity <= 0) {
    cart.splice(index, 1);
  }
  
  // Save changes
  localStorage.setItem('cart', JSON.stringify(cart));
  
  // Update cookie
  document.cookie = `cart=${encodeURIComponent(JSON.stringify(cart))}; path=/; max-age=${86400 * 30}; SameSite=Lax`;
  
  // Reload to show changes
  location.reload();
}

function proceedToCheckout() {
  // Add your checkout logic here
  alert('Proceeding to checkout...');
}
</script>
</body>
</html>