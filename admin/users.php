<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/users_function.php'); ?>
<?php
  $users = getAllUsers();
?>

<?php require_once( ROOT_PATH . '/admin/includes/_head.php') ?>
	<title> Users Page | <?= $namasitus ?> </title>
</head>
<body>
    
<?php require_once( ROOT_PATH . '/admin/includes/_nav.php') ?>
<div class="container">
  <div class="card">
    <div class="card-header">
      List Users 
    </div>
    <div class="card-body small">
      <div class="row">
        <!-- BAGIAN FORM -->
        <div class="col-sm-4">
          <h4>Tambah/Ubah Data</h4>
          <?php if ($isEditingUser === true): ?>
            <form action="<?php echo BASE_URL . 'admin/users.php?edit-user='.$user_id; ?>" method="post">
            <?php else: ?>
              <form action="<?php echo BASE_URL . 'admin/users.php'; ?>" method="post">

            <?php endif ?>

            <!-- validation errors for the form -->
            <?php include(ROOT_PATH . '/includes/errors.php') ?>

            <!-- if editing user, the id is required to identify that user -->
            <?php if ($isEditingUser === true): ?>
              <input type="hidden" name="user_id" value="<?= $user_id; ?>">
            <?php endif ?>

            <div class="form-group">
              <label>Nama Lengkap*</label>
              <input type="text" required="" name="nama" value="<?= $nama ?>" class="form-control" placeholder="Nama Lengkap">
            </div>
            <div class="form-group">
              <label>Username*</label>
              <input type="text" required="" name="username" value="<?= $username ?>" class="form-control" placeholder="Username">
            </div>
            <div class="form-group">
              <label>Email*</label>
              <input type="email" required="" name="email" value="<?= $email ?>" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
              <label>Role User*</label>
              <select class="form-control" required="" name="role" value="<?= $role ?>">
                <option value="admin" <?= ($role=='admin'?'selected':'')?> >Admin</option>
                <option value="customer" <?= ($role=='customer'?'selected':'')?> >Customer</option>
              </select>
            </div><?php if ($isEditingUser === true): ?>
                <hr><small>Kosongi kolom password jika tidak ingin merubahnya</small>
              <?php endif ?>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control" placeholder="Password">
              <small>&nbsp;&nbsp;<input type="checkbox" id="see"> <label for="see">Tampilkan</label></small>
             
            </div>

            <!-- if editing user, display the update button instead of create button -->
            <?php if ($isEditingUser === true): ?>
              <button type="submit" name="update_user" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update</button>
              <a href="users.php" class="btn btn-warning">Reset</a>
            <?php else: ?>
              <button type="submit" name="create_user" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Simpan</button>
            <?php endif ?>
            
          </form>
        </div>
        <!-- BAGIAN TABEL -->
        <div class="col-sm-8">
          <?php if (empty($users)): ?>
            <h2 class="text-center">Users tidak ditemukan.</h2>
          <?php else: ?>
            <div class="table-responsive">
              <table class="table table-striped" id="datatable">
                <thead>
                  <tr>
                    <th>NAMA</th>
                    <th>USERNAME</th>
                    <th>ROLE</th>
                    <th>LAST LOGIN</th>
                    <th style="min-width:100px">#</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($users as $key): ?>
                    <tr>
                      <td>
                        <strong><?= $key['nama'] ?></strong>
                      </td>
                      <td>
                        <?= $key['username'] ?> <br/>
                        <strong><?= $key['email'] ?></strong>
                      </td>
                      <td>
                        <?= ucwords($key['role']) ?> <br/>
                        <?php if($key['status'] == 1): ?>
                          <span class="badge badge-success">Active</span>
                        <?php else: ?>
                          <span class="badge badge-danger">Suspended</span>
                        <?php endif ?>

                      </td>
                      <td>
                      <?php if($key['last_login'] == NULL): ?>
                        -
                      <?php else: ?>
                        <?= date("d F Y", $key['last_login']) ?> <br/>
                        <?= date("H:i:s", $key['last_login']) ?>
                      <?php endif ?>
                      </td>
                      <td>
                        <a href="users.php?edit-user=<?= $key['id'] ?>" title="Ubah" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>

                        <a href="users.php?change-user=<?= $key['id'] ?>" title="Aktif/Nonaktif" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" onclick="return confirm('are you sure?')"><i class="fa fa-eye"></i></a>

                        <a href="users.php?delete-user=<?= $key['id'] ?>" title="Hapus" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" onclick="return confirm('are you sure?')"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          <?php endif ?>
        </div>

      </div>
    </div>
  </div>

</div>

<?php require_once( ROOT_PATH . '/admin/includes/_foot.php') ?>
    <script>
    $('input[type="checkbox"]').click(function(){
      if($(this).prop("checked") == true){
        $('input[name="password"]').attr("type","text");
      }
      else if($(this).prop("checked") == false){
        $('input[name="password"]').attr("type","password");
      }
    });
    </script>
  </body>
</html>