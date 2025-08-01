<!DOCTYPE html>
<html>
<head>
  <style>
    .number-selector {
      font-size: 24px;
      cursor: pointer;
      user-select: none;
    }
    .number {
      margin: 0 10px;
      display: inline-block;
      width: 20px;
      text-align: center;
    }
  </style>
</head>
<body>

<div class="number-selector">
  <span onclick="increase()">&#60;</span> <!-- < symbol -->
  <span id="number" class="number">8</span>
  <span onclick="decrease()">&#62;</span> <!-- > symbol -->
</div>

<script>
  let current = 8;

  function increase() {
    current++;
    document.getElementById('number').textContent = current;
  }

  function decrease() {
    current--;
    document.getElementById('number').textContent = current;
  }
</script>

</body>
</html>
