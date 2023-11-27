<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: index.php');
}
?>

<span style="font-family: verdana, geneva, sans-serif;">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="css/style.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>
<body>
  <div class="container">
    <nav>
      <ul>
        <li><a href="#" class="logo">
          <img src="img/user/user.png">
          <span class="nav-item">Admin</span>
        </a></li>
        <li><a href="dashboard.php">
          <i class="fas fa-menorah"></i>
          <span class="nav-item">Dashboard</span>
        </a></li>
        <li><a href="kategori.php">
          <i class="fas fa-comment"></i>
          <span class="nav-item">Kategori</span>
        </a></li>
        <li><a href="produk.php">
          <i class="fas fa-database"></i>
          <span class="nav-item">Produk</span>
        </a></li>
        <li><a href="point-of-sales.php">
          <i class="fas fa-chart-bar"></i>
          <span class="nav-item">POS System</span>
        </a></li>
        <li><a href="transaksi.php">
          <i class="fas fa-cog"></i>
          <span class="nav-item">Transaksi</span>
        </a></li>

        <li><a href="api/logout.php" onclick="return confirm('Are you sure you want to Log Out?')" class="logout">
          <i class="fas fa-sign-out-alt"></i>
          <span class="nav-item">Log out</span>
        </a></li>
      </ul>
    </nav>


    <section class="main">
      <div class="main-top">
        <h1>Dashboard</h1>
        <!-- <i class="fas fa-user-cog"></i> -->
      </div>
      <div class="users">
        <div class="card">
          <img src="img/dashboard/category.png">
          <h4>Kategori Produk</h4>
          <p>Berikut adalah jumlah data kategori</p>
          <div class="per">
            <table style="text-align:center">
              <tr>
                <td><span id="kategori">5</span></td>
              </tr>
              <tr>
                <td>Total Kategori</td>
              </tr>
            </table>
          </div>
          <a href="kategori.php"><button> Show Data </button></a>
        </div>
        <div class="card">
          <img src="img/dashboard/product.png">
          <h4>Produk</h4>
          <p>Berikut adalah jumlah data produk</p>
          <div class="per">
            <table style="text-align:center">
              <tr>
                <td><span id="produk">50</span></td>
              </tr>
              <tr>
                <td>Total Produk</td>
              </tr>
            </table>
          </div>
          <a href="produk.php"><button> Show Data </button></a>
        </div>
        <div class="card">
          <img src="img/dashboard/transaction.png">
          <h4>Total Transaksi</h4>
          <p>Berikut adalah jumlah data transaksi</p>
          <div class="per">
            <table style="text-align:center">
              <tr>
                <td><span id="transaksi">50</span></td>
              </tr>
              <tr>
                <td>Total Transaksi</td>
              </tr>
            </table>
          </div>
          <a href="transaksi.php"><button> Show Data </button></a>
        </div>
        <div class="card">
          <img src="img/dashboard/pos.png">
          <h4>POS System</h4>
          <p>Berikut adalah fitur Point of Sales</p>
          <div class="per">
            <table style="text-align:center">
              <tr>
                <td><span>POS</span></td>
              </tr>
              <tr>
                <td>Point of Sales</td>
              </tr>
            </table>
          </div>
          <a href="point-of-sales.php"><button> Open POS </button></a>
        </div>
      </div>
    </section>
  </div>
  <script src="js/dashboard.js"></script>
</body>
</html>
<!-- </span> -->