<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Kategori</title>
  <link rel="stylesheet" href="css/style.css" />
  <style>
    .btn{
      outline: none;
      padding: 7px 18px;
      border-radius: 10px;
      font-size: 14px;
      cursor: pointer;
      margin-top: 20px;
    }
    .btn-primary{
      background-color: #0652DD;
      color: white;
    }
    .btn:active{
      transform:scale(.9)
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
      <div class="container-alert">
          <div class="alerts">
              <div class="alert alert-success">gg</div>
              <div class="alert alert-danger">ee</div>
          </div>
      </div>
      <div class="main-top">
        <h1>Kategori</h1>
        <!-- <i class="fas fa-user-cog"></i> -->
      </div>
      
      <section class="attendance">
        <div class="attendance-list">
          <h1>Data Kategori ( <span id="total"></span> )</h1>
          <button class="btn btn-primary" id="create">Tambah Data</button>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Kategori</th>
                <th>Image</th>
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

  <!-- <div class="container"> -->
  <div class="modal" id="create-kategori">
      <div class="modal-body">
          <h3>Input Kategori</h3>
          <div class="form-group">
              <label for=""><b>Masukkan Nama Kategori</b></label>
              <input type="text" placeholder="Kategori" id="kategori" class="form-control">
          </div>
          <div class="form-group">
              <label for=""><b>Masukkan Gambar Kategori</b></label>
              <input type="file" placeholder="Gambar" id="image" class="form-control">
          </div>
          <div class="form-group buttons">
              <button class="btn btn-success" type="submit" id="save">Save</button>
              <button class="btn btn-danger" type="submit" id="close">Close</button>
          </div>
      </div>
  </div>
  <!-- </div> -->

  <!-- edit student -->
  <div class="modal" id="update-kategori">
      <div class="modal-body">
          <h3>Update Kategori</h3>
          <div class="form-group">
              <label for=""><b>Masukkan Nama Kategori</b></label>
              <input type="text" placeholder="Kategori" id="edit_kategori" class="form-control">
              <input type="hidden" placeholder="Id" id="id" class="form-control">
              <input type="hidden" placeholder="Gambar" id="gambar" class="form-control">
          </div>
          <div class="form-group">
              <label for=""><b>Masukkan Gambar Kategori</b></label>
              <input type="file" placeholder="Gambar" id="edit_image" class="form-control">
              <p>Kosongkan bila tidak ingin mengubah gambar.</p>
          </div>
          <div class="form-group buttons">
              <button class="btn btn-success" id="update" type="submit">Update</button>
              <button class="btn btn-danger" type="submit" id="update_close">Close</button>
          </div>
      </div>
  </div>
  <script src="js/kategori.js"></script>
</body>
</html>
<!-- </span> -->