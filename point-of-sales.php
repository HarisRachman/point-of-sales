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
  <title>Point of Sales</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/pos-style.css" />
  <style>
    .btn{
      outline: none;
      border: none;
      padding: 7px 18px;
      border-radius: 10px;
      font-size: 14px;
      cursor: pointer;
      margin-top: 20px;
    }
    .container-alert{
      width: 80%;
      margin: 0px auto;
    }
    .alert{
      position:fixed;
      top: 10px;
      right: 20px;
      padding: 10px 20px;
      border-radius: 10px;
      color: white;
      font-size: 18px;
    }
    .alert-success{
      background-color: rgb(31, 192, 31);
      display:none;
    }

    .alert-danger{
      background-color: rgb(194, 27, 27);
      display:none;
    }
  </style>
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
        <h1>Point of Sales System</h1>
        <!-- <i class="fas fa-user-cog"></i> -->
      </div>
      <div class="sellables-container">
        <div class="sellables">
            <div class="categories" id="list-kategori">
              <div class='category' onclick='getProduk()'><center><img src='img/dashboard/category.png' height='50px' width='auto'><p style='text-align:center'>All Category</p></center></div>

            </div>

            <div class="item-group-wrapper">
                <div class="item-group" id="list-produk">
                    
                </div>
            </div>
        </div>

        <div class="register-wrapper">
            <div class="container-alert">
                <div class="alerts">
                    <div class="alert alert-success">gg</div>
                    <div class="alert alert-danger">ee</div>
                </div>
            </div>

            <div class="register">
                <div class="products">
                  <div class='product-bar'>
                    <table width="100%" id="table-cart">
                      
                    </table>
                  </div>
                </div>
            <div class="pay-button" id="total">
                
            </div>
        </div>
    </section>
  </div>

  <!-- edit student -->
  <div class="modal" id="add-cart">
      <div class="modal-body">
          <h3>Add To Cart</h3>
          <div class="form-group">
              <label for=""><b>Nama Produk</b></label>
              <input type="text" id="edit_produk" class="form-control" disabled>
              <input type="hidden" placeholder="Id" id="id" class="form-control">
          </div>
          <div class="form-group">
              <label for=""><b>Harga Produk</b></label>
              <input type="text" id="edit_harga" class="form-control" disabled>
          </div>
          <div class="form-group">
              <label for=""><b>Qty</b></label>
              <input type="number" placeholder="qty" id="qty" min="1" max="" class="form-control">
          </div>
          <div class="form-group buttons">
              <button class="btn btn-success" id="addToCart" type="submit">Add to Cart</button>
              <button class="btn btn-danger" type="submit" id="cancel">Cancel</button>
          </div>
      </div>
  </div>

  <!-- edit student -->
  <div class="modal" id="add-transaksi">
      <div class="modal-body">
          <h3>Transactions</h3>
          <div class="form-group">
              <label for=""><b>Nama Pelanggan</b></label>
              <input type="text" id="nama_pelanggan" class="form-control">
          </div>
          <div class="form-group">
              <label for=""><b>Total Harga</b></label>
              <input type="text" id="total_harga" class="form-control" disabled>
          </div>
          <div class="form-group">
              <label for=""><b>Nominal Bayar</b></label>
              <input type="text" id="total_bayar" class="form-control" onkeyup="cal()">
          </div>
          <div class="form-group">
              <label for=""><b>Kembalian</b></label>
              <input type="text" id="kembalian" class="form-control" disabled>
          </div>
          <div class="form-group buttons">
              <button class="btn btn-success" id="finish-trans" type="submit">Finish Transaction</button>
              <button class="btn btn-danger" type="submit" id="cancel-trans">Cancel</button>
          </div>
      </div>
  </div>

  <script src="js/point-of-sales.js"></script>
  <script>
    function cal(){
        let harga = document.getElementById("total_harga").value;
        let bayar = document.getElementById("total_bayar").value;
        let kembalian;
        kembalian = bayar - harga;
        document.getElementById("kembalian").value = kembalian;
    }
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $("[type='number']").keypress(function (evt) {
        evt.preventDefault();
    });
  </script>
</body>
</html>
<!-- </span> -->