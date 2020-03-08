<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <a class="navbar-brand" href="<?= URLROOT ?>carts/index">
    <h4>
        <i class="fas fa-shopping-basket"></i> <?= SITENAME ?>
    </h4>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExample04">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?= URLROOT ?>carts/index">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= URLROOT ?>pages/about">About</a>
      </li>
      <?php if(isset($_SESSION['user_id'])): ?>
      <li class="nav-item">
        <a class="nav-link" href="<?= URLROOT ?>users/logout">Logout</a>
      </li>
      <?php else:?>
      <li class="nav-item">
        <a class="nav-link" href="<?= URLROOT ?>users/login">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= URLROOT ?>users/register">Register</a>
      </li>
      <?php endif; ?>
    </ul>
    <div class="navbar-nav">
        <a href="#" class="nav-item nav-link active">
            <h5 class="cart pr-5">
                <i class="fas fa-shopping-cart"></i> Cart
                <span id="cart_count" class="text-warning bg-light">0</span>
            </h5>
        </a>
    </div>
  </div>
</nav>