<div class="container">
  <footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md-2 col-lg-2">
        <!-- https://dribbble.com/shots/3582576-Tugu-Jogja -->
        <img class="mb-2" src="<?= BASE_URL ?>assets/jogja.webp" alt="" width="72" height="72">
        <small class="d-block mb-3 text-muted">&copy; 2020-2021</small>
      </div>
      <div class="col-6 col-md-5 col-lg-5">
        <h5>Features</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Pelayanan Professional Dari Tim Kami</a></li>
          <li><a class="text-muted" href="#">Keselamatan Anda Menjadi Hal Utama Bagi Kami</a></li>
          <li><a class="text-muted" href="#">Dapatkan Keseruan Bersama Keluarga</a></li>
          <li><a class="text-muted" href="#">Anda Bisa Pilih Rute Semau Anda</a></li>
          <li><a class="text-muted" href="#">Dan masih banyak lagi</a></li>
        </ul>
      </div>
      <div class="col-6 col-md-5 col-lg-5">
        <h5>About</h5>
        <p>wisataku.com adalah website yang menyediakan beberapa paket wisata sesuai dengan kebutuhan anda. Kami mengandalkan kualitas pelayanan dan kepuasan pelanggan sebagai prioritas kami, dengan harga yang murah anda dapat menikmati berbagai tempat wisata di Yogyakarta dengan aman dan nyaman. </p>
      </div>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="assets/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/notify.min.js"></script>
  <script>
  $(document).ready(function() {
    $('.alert').alert();
    $('#datatable').DataTable();
    $('[data-toggle="tooltip"]').tooltip()

    <?php if (isset($_SESSION['message'])) : ?>
      $.notify("<?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']);
      ?>", "success");
    <?php endif ?>

  } );
  
  </script>
</div>