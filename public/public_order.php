<?php
require_once __DIR__ . '/../mvc/core/DB.php';
require_once __DIR__ . '/../mvc/models/tbl_product.php';

$db = new DB();
$productModel = new tbl_product($db->con);
$menu_items = $productModel->GetActiveProducts();

$menu_items = array_map(function($item) {
    return [
        'id' => $item['id'],
        'name' => $item['name'],
        'price' => $item['price'],
        'image' => $item['image'],
        'category' => ($item['type'] == 1) ? 'food' : 'drink'
    ];
}, $menu_items);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>BamBoo Restaurant</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .menu-card {
      transition: transform 0.2s;
      margin-bottom: 1rem;
    }
    .menu-card:hover {
      transform: translateY(-3px);
    }
    .cart-icon {
      width: 32px;
      height: 32px;
    }
    .search-input {
      border-radius: 20px;
    }
    .category-btn {
      flex: 1;
      white-space: nowrap;
      font-size: 0.9rem;
    }
    .product-image {
      height: 150px;
      object-fit: cover;
    }
  </style>
</head>
<body class="bg-light">
<div class="container-fluid p-2">
  <!-- Header -->
  <div class="row mb-3">
    <div class="col-12 text-center">
      <h2 class="restaurant-title mb-0">🍜 BamBoo</h2>
    </div>
  </div>

  <!-- Search and Cart -->
  <div class="row mb-2">
    <div class="col-12">
      <div class="d-flex align-items-center gap-2">
        <div class="flex-grow-1">
          <input id="searchInput" 
                 class="form-control search-input" 
                 placeholder="Search menu..." 
                 onkeyup="filterItems()">
        </div>
        <a href="cart.php" class="btn btn-primary position-relative p-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart">
            <circle cx="9" cy="21" r="1"></circle>
            <circle cx="20" cy="21" r="1"></circle>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
          </svg>
          <span id="cart-badge" class="badge rounded-pill bg-danger position-absolute top-0 end-0 translate-middle">
            <?= array_sum(array_column(json_decode($_COOKIE['cart'] ?? '[]', true), 'quantity')) ?: 0 ?>
          </span>
        </a>
      </div>
    </div>
  </div>

  <!-- Category Filters -->
  <div class="row mb-3">
    <div class="col-12">
      <div class="d-flex gap-1 flex-nowrap overflow-auto">
        <button class="btn btn-outline-primary category-btn active" 
                onclick="filterCategory('all')">All</button>
        <button class="btn btn-outline-primary category-btn" 
                onclick="filterCategory('food')">🍔 Food</button>
        <button class="btn btn-outline-primary category-btn" 
                onclick="filterCategory('drink')">🥤 Drinks</button>
      </div>
    </div>
  </div>

  <!-- Menu Grid -->
  <div class="row row-cols-2 g-2" id="menu-grid">
    <?php foreach ($menu_items as $item): ?>
      <div class="col">
        <div class="card h-100 menu-card border-0 shadow-sm"
             data-category="<?= htmlspecialchars($item['category']) ?>"
             data-name="<?= htmlspecialchars(strtolower($item['name'])) ?>">
          <img src="images/product/<?= rawurlencode($item['image']) ?>" 
               class="card-img-top product-image" 
               alt="<?= htmlspecialchars($item['name']) ?>">
          <div class="card-body p-2 text-center">
            <h6 class="card-title mb-1 fw-bold"><?= htmlspecialchars($item['name']) ?></h6>
            <p class="card-text text-success mb-0">₭<?= number_format($item['price'], 2) ?></p>
            <button class="btn btn-primary btn-sm w-100 mt-1" 
                    onclick="addToCart(<?= $item['id'] ?>, '<?= htmlspecialchars($item['name']) ?>', <?= $item['price'] ?>)">
              Add +
            </button>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Mobile-optimized JavaScript
let currentCategory = 'all';
let searchQuery = '';
const menuItems = Array.from(document.querySelectorAll('.menu-card'));

function filterItems() { 
  searchQuery = document.getElementById('searchInput').value.toLowerCase();
  applyFilters();
}

function filterCategory(category) { 
  currentCategory = category;
  document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
  event.target.classList.add('active');
  applyFilters();
}

function applyFilters() { 
  menuItems.forEach(item => {
    const categoryMatch = currentCategory === 'all' || item.dataset.category === currentCategory;
    const nameMatch = item.dataset.name.includes(searchQuery);
    item.closest('.col').style.display = (categoryMatch && nameMatch) ? 'block' : 'none';
  });
}

// Cart System
let cart = JSON.parse(localStorage.getItem('cart')) || [];
updateCart();

function addToCart(id, name, price) {
  const existing = cart.find(item => item.id === id);
  if(existing) {
    existing.quantity++;
  } else {
    cart.push({ id, name, price, quantity: 1 });
  }
  updateCart();
}

function updateCart() {
  const cartString = JSON.stringify(cart);
  
  // Update localStorage
  localStorage.setItem('cart', cartString);
  
  // Update cookie (with proper encoding/expiry)
  document.cookie = `cart=${encodeURIComponent(cartString)}; path=/; max-age=${86400 * 30}; SameSite=Lax`;
  
  // Update badge
  document.getElementById('cart-badge').textContent = 
    cart.reduce((sum, item) => sum + item.quantity, 0);
}

</script>
</body>
</html>