<!DOCTYPE html>
<html>
<head>
  <style>
    .quantity-selector {
      display: flex;
      align-items: center;
      font-size: 24px;
    }
    .quantity-btn {
      width: 32px;
      height: 32px;
      border: 1px solid #ccc;
      background: #f8f8f8;
      cursor: pointer;
      text-align: center;
      line-height: 32px;
      font-size: 24px;
      user-select: none;
    }
    .quantity-value {
      width: 40px;
      text-align: center;
      font-size: 24px;
      margin: 0 10px;
    }
  </style>
</head>
<body>

<div class="quantity-selector">
  <span class="quantity-btn" onclick="decrease()">-</span>
  <span id="quantity" class="quantity-value">1</span>
  <span class="quantity-btn" onclick="increase()">+</span>
</div>

<script>
  let quantity = 1;
  const min = 1;
  const max = 99;

  function updateDisplay() {
    document.getElementById('quantity').textContent = quantity;
  }

  function increase() {
    if (quantity < max) {
      quantity++;
      updateDisplay();
    }
  }

  function decrease() {
    if (quantity > min) {
      quantity--;
      updateDisplay();
    }
  }
</script>

</body>
</html>
