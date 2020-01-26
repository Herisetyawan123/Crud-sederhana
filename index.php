<?php 

include 'data.php';
if (isset($_POST['btn_simpan'])) {
  $simpan = tambah($conn, $_POST);
  if ($simpan) {
    echo "<script>alert('data berhasil disimpan')</alert>";
    header("Location: index.php");
  }else{
    $pesan = '<p class="alert alert-danger">Data belum disimpan</p>';
  }
}

if (isset($_POST['update'])) {
  $simpan = update($conn, $_POST, $_GET['id']);
  if ($simpan) {
    echo "<script>alert('data berhasil disimpan')</alert>";
    header("Location: index.php");
  }else{
    $pesan = '<p class="alert alert-danger">Data belum disimpan</p>';
  }
}


 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>CRUD praktikum tugas</title>
  </head>
  <body>

  <header class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <h2>Tugas Curd Pertanian</h2>
      </div>
    </div>
  </header>

<?php 
if (isset($_GET['aksi'])){ 
  ?>
  
  <?php 
  if ($_GET['aksi'] == 'tambah'){ 
    ?>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <form action="" method="POST">
              <h2>Tambah data</h2>
              <?php echo isset($pesan) ? $pesan : "" ?>

              <div class="form-group">
                <label for="exampleFormControlInput1">Nama tanaman</label>
                <input type="text" name="nm_tanaman"  class="form-control" id="exampleFormControlInput1" placeholder="Nama tanaman">
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Hasil panen </label>
                <input type="number" name="hasil"  class="form-control" id="exampleFormControlInput1">
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Lama tanam </label>
                <input type="number" name="lama" class="form-control" id="exampleFormControlInput1">
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Tanggal panen </label>
                <input type="date" name="tgl_panen"  class="form-control" id="exampleFormControlInput1">
              </div>
              <br>
              <label>
                <input type="submit" name="btn_simpan" class="btn btn-primary" value="Simpan"/>
                <input type="reset" name="reset" class="btn btn-warning" value="Besihkan"/>
              </label>
            
          </form>
        </div>
      </div>
    </div>    
  <?php 
    }elseif($_GET['aksi'] == "delete"){
      hapus($conn, $_GET['id']);
      header("Location: index.php");
    }elseif ($_GET['aksi'] == "update") {
      $data = mysqli_fetch_array(tampil_id($conn, "tabel_panen", $_GET['id']));
  

  ?>


    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <form action="" method="POST">
              <h2>Tambah data</h2>
              <?php echo isset($pesan) ? $pesan : "" ?>

              <div class="form-group">
                <label for="exampleFormControlInput1">Nama tanaman</label>
                <input type="text" name="nm_tanaman"  class="form-control" id="exampleFormControlInput1" value="<?= $data['nama_tanaman'] ?>">
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Hasil panen </label>
                <input type="number" name="hasil"  class="form-control" id="exampleFormControlInput1" value="<?= $data['hasil_panen'] ?>">
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Lama tanam </label>
                <input type="number" name="lama" class="form-control" id="exampleFormControlInput1" value="<?= $data['lama_tanam'] ?>">
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Tanggal panen </label>
                <input type="date" name="tgl_panen"  class="form-control" id="exampleFormControlInput1" value="<?= $data['tanggal_panen'] ?>">
              </div>
              <br>
              <label>
                <input type="submit" name="update" class="btn btn-primary" value="Simpan"/>
                <input type="reset" name="reset" class="btn btn-warning" value="Besihkan"/>
              </label>
            
          </form>
        </div>
      </div>
    </div> 
  
  <?php
        
      
    } 
  ?> 

<?php } ?>


  <div class="container">
    <div class="row mt-5 justify-content-center">
      <div class="col-m-8">
        <a href="?aksi=tambah" class="btn btn-primary">Tambah</a>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">Nama Tanaman</th>
              <th scope="col">Hasil panen</th>
              <th scope="col">Lama tanam</th>
              <th scope="col">Tanggal panen</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 

              $query = tampil($conn, "tabel_panen");
              while($data = mysqli_fetch_array($query)){
                ?>
                  <tr>
                    <td><?php echo $data['id']; ?></td>
                    <td><?php echo $data['nama_tanaman']; ?></td>
                    <td><?php echo $data['hasil_panen']; ?> Kg</td>
                    <td><?php echo $data['lama_tanam']; ?> bulan</td>
                    <td><?php echo $data['tanggal_panen']; ?></td>
                    <td>
                      <a href="index.php?aksi=update&id=<?php echo $data['id']; ?>" class="badge badge-success">Ubah</a> |
                      <a href="index.php?aksi=delete&id=<?php echo $data['id']; ?>" class="badge badge-danger">Hapus</a>
                    </td>
                  </tr>
                <?php
              }
             ?>          
          </tbody>
        </table>
      </div>
    </div>
  </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>