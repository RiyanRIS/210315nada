<?php require_once('config.php') ?>
<?php require_once('includes/paket_function.php') ?>
<?php 
  $paket = getAllPaket();
?>

<?php require_once( ROOT_PATH . '/includes/_head.php') ?>
	<title> List Paket Wisata |  <?= $namasitus ?> </title>
</head>
<body>
    
<?php require_once( ROOT_PATH . '/includes/_nav.php') ?>

<div class="album py-5">
    <div class="container">

      <div class="row" id="content">
        <div class="col-md-12">
            <h3>List Paket Wisata</h3>
            <div style="display:none;" id="myAlert">
              <div class='alert alert-danger alert-dismissable' id='myAlert2'> <button type='button' class='close' data-dismiss='alert'  aria-hidden='true'>&times;</button> Anda belum login! klik <a href="login.php">disini</a> untuk masuk.</div>
            </div>
            
            <div class="form-group row">
              <label for="search" class="col-sm-2 col-form-label">Pencarian</label>
              <div class="col-sm-8">
              <input type="text" id="myInput" class="form-control" id="search" placeholder="Nama Paket Wisata...">
              </div>
              <div class="col-sm-2">
              <button type="submit" class="btn btn-primary mb-2">Cari</button>
              </div>
            </div>
        </div>

        <?php if (empty($paket)): ?>
          <h2 class="text-center">Paket wisata tidak ditemukan.</h2>
        <?php else: ?>
          <?php foreach ($paket as $key): ?>
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              <div class="frameimage">  
              <img style="max-height: 225px; display: block; margin: auto; width: 100%;" src="<?= BASE_URL . "/assets/uploads/" . $key['gambar'] ?>" class="card-img-top" alt=""></div>
              <div class="card-body">
                <h3 class="texxt"><?= $key['nama'] ?></h3>
                <p class="card-text texxt"><?= $key['deskripsi'] ?></p>
                <div class="d-flex justify-content-between align-items-center">
                <?php if(!isLogin()) : ?>
                  <button type="button" class="btn btn-primary" onclick="showAlert()">Pesan</button>
                <?php else: ?>
                  <a href="pesan.php?psnpaket=<?= $key['id'] ?>&psnusers=<?= $_SESSION['user']['id'] ?>" class="btn btn-primary">Pesan</a>
                <?php endif; ?>
                  <small class="text-muted"><?= toRp($key['harga']) ?></small>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        <?php endif; ?>
        
      </div>
    </div>
  </div>

  <?php require_once( ROOT_PATH . '/includes/_foot.php') ?>
<script>
  function showAlert(){
    if($("#myAlert").find("div#myAlert2").length==0){
      $("#myAlert").append("<div class='alert alert-danger alert-dismissable' id='myAlert2'> <button type='button' class='close' data-dismiss='alert'  aria-hidden='true'>&times;</button> Anda belum login! klik <a href='login.php'>disini</a> untuk masuk.</div>");
    }
    $("#myAlert").css("display", "");
  }

  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#content .col-md-4").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  
</script>
  </body>
</html>