<!-- checkout.php -->
<script>
// When handling checkout
const cart = JSON.parse(localStorage.getItem('cart')) || [];

// Example: Send cart data to server
fetch('/process-checkout.php', {
    method: 'POST',
    body: JSON.stringify(cart)
});
</script>