<nav class="navbar navbar-expand navbar-dark bg-dark" style="margin-bottom: 80px">
    <div class="container">
        <!-- BRAND/LOGO -->
         <a href="products.php" class="navbar-brand">
            <h4 class="mb-0">MINIMART CATALOG</h4>
         </a>

         <!-- LINKS/ITEMS -->
          <ul class="navbar-nav">
            <li class="nav-item"><a href="products.php" class="nav-link">Products</a></li>
            <li class="nav-item"><a href="section.php" class="nav-link">Sections</a></li>
          </ul>

          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a href="profile.php" class="nav-link fw-bold"><?= $_SESSION['username']?></a>
            </li>
            <li class="nav-item">
                <a href="logout.php" class="nav-link">Log out</a>
            </li>
          </ul>
    </div>
</nav>