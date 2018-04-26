<?php

include "header.php";
include "connect.php";

$fakultas = mysqli_query($conn, "SELECT * FROM tb_fakultas");

$jurusan = mysqli_query($conn, "SELECT * FROM tb_jurusan");


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>


<section class="content">

<?php

  $Doc = mysqli_query($conn, "SELECT COUNT(*) AS jumlah_dokumen FROM tbvektor_copy");

  $jmlDoc = mysqli_fetch_array($Doc);


  $Mhs = mysqli_query($conn, "SELECT COUNT(*) AS jumlah_mahasiswa FROM tb_mahasiswa");

  $jmlMhs = mysqli_fetch_array($Mhs);

?>
      <!-- Small boxes (Stat box) -->
  <div class="box box-success">
        <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Mahasiswa</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <form name="form1" action="add_mhs_action.php" method="post">
              <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nomor Induk Mahasiwa</label>
                      <input type="text" class="form-control" placeholder="NIM" name="nim">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nama</label>
                      <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Pilih Fakultas</label>
                        <select class="form-control" name="fakultas" id="Fakultas">
                          <option value="">--Pilih Fakultas--</option>
                            <?php while($row = mysqli_fetch_array($fakultas)){ ?>
                                <?php extract($row); ?>
                                    <option value="<?php echo $id_fakultas; ?>"><?php echo $nama_fakultas; ?></option>
                            <?php   } ?>
                        </select>
                    </div>
                    <div class="form-group">
                      <label>Pilih Jurusan</label>
                        <select class="form-control" name="jurusan" id="Jurusan" width="300">
                          <option value="">--Pilih Jurusan--</option>
                            <?php while($row = mysqli_fetch_array($jurusan)){ ?>
                                <?php extract($row); ?>
                                    <option value="<?php echo $id_jurusan; ?>"><?php echo $nama_jurusan; ?></option>
                            <?php   } ?>
                        </select>

                    </div>
                  </div>
                  <div class="box-footer">
                      <button type="submit" name="submit1" class="btn btn-primary" value="Register">Submit</button>
                  </div>
                  </div>
                  
            </form>
          </div>
                  
          </div>
      </div>
</section>


<script type="text/javascript" src="jquery.min.js"></script>




<?php

include "footer.php";

?>