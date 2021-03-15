<!-- The first include should be config.php -->
<?php require_once('config.php') ?>

<?php require_once( ROOT_PATH . '/includes/_head.php') ?>
	<title> List Paket Wisata | WISATAKU.COM </title>
</head>
<body>
    
<?php require_once( ROOT_PATH . '/includes/_nav.php') ?>

<div class="album py-5">
    <div class="container">

      <div class="row">
        <div class="col-md-12">
            <h3>List Paket Wisata</h3>
            <form action="" method="">
                <div class="form-group row">
                    <label for="search" class="col-sm-2 col-form-label">Pencarian</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="search" placeholder="Nama Paket Wisata...">
                    </div>
                    <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary mb-2">Cari</button>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <div class="frameimage">  
            <img style="max-height: 225px; display: block; margin: auto; width: 100%;" src="https://cdn.idntimes.com/content-images/post/20180720/50fb122a46bd518fdaef76358fb48b56_600x400.jpg" class="card-img-top" alt=""></div>

            <div class="card-body">
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
              <button type="button" class="btn btn-primary">Pesan</button>
                <small class="text-muted">Rp. 1.500.000</small>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <div class="frameimage">  
            <img style="max-height: 225px; display: block; margin: auto; width: 100%;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSJGbSQxDcE6hORikaKt1NWiSdvdHZo5f9jAXI7f9_erzHtcSKGteGJwpRt25yAxUoc46I&usqp=CAU" class="card-img-top" alt=""></div>

            <div class="card-body">
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
              <button type="button" class="btn btn-primary">Pesan</button>
                <small class="text-muted">Rp. 3.000.000</small>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <div class="frameimage">  
            <img style="max-height: 225px; display: block; margin: auto; width: 100%;" src="https://cdn.idntimes.com/content-images/community/2019/05/30602506-417968652008233-7139213051659550720-n-e85a2e5c532c4970990d5415ab69f7ad.jpg" class="card-img-top" alt=""></div>

            <div class="card-body">
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-primary">Pesan</button>
                <small class="text-muted">Rp. 2.500.000</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php require_once( ROOT_PATH . '/includes/_foot.php') ?>
    
  </body>
</html>