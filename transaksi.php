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
  <title>Transaksi</title>
  <link rel="stylesheet" href="css/style.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <style>
    .btn{
      outline: none;
      padding: 7px 18px;
      border-radius: 10px;
      font-size: 14px;
      cursor: pointer;
      margin-top: 20px;
    }

    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }
  </style>
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
        <h1>Transaksi</h1>
        <!-- <i class="fas fa-user-cog"></i> -->
      </div>
      
      <section class="attendance">
        <div class="attendance-list">
          <h1>Data Transaksi ( <span id="total"></span> )</h1>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Pelanggan</th>
                <th>Kasir</th>
                <th>Total Harga</th>
                <th>Total Bayar</th>
                <th>Kembalian</th>
                <th>Tanggal</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="tbody">
              
            </tbody>
          </table>
        </div>
      </section>
    </section>
  </div>

  <div class="modal" id="detail-trans">
      <div class="modal-body">
          <h3>Detail Transaction</h3>
          <div class="form-group">
              <label for=""><b>Nama Pelanggan</b></label>
              <input type="text" id="nama_pelanggan" class="form-control" disabled>
          </div>
          <div class="form-group">
          <label for=""><b>Data Pesanan:</b></label>
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Produk</th>
                  <th>Harga</th>
                  <th>Qty</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody id="tbody-detail">
                
              </tbody>
            </table>
          </div>
          <div class="form-group">
              <label for=""><b>Total Harga</b></label>
              <input type="text" id="total_harga" class="form-control" disabled>
          </div>
          <div class="form-group">
              <label for=""><b>Total Bayar</b></label>
              <input type="text" id="total_bayar" class="form-control" disabled>
          </div>
          <div class="form-group">
              <label for=""><b>Kembalian</b></label>
              <input type="text" id="kembalian" class="form-control" disabled>
          </div>
          <div class="form-group buttons">
              <button class="btn btn-danger" type="submit" id="close-detail">Close</button>
          </div>
      </div>
  </div>

  <script src="js/transaksi.js"></script>
</body>
</html>
<!-- </span> -->