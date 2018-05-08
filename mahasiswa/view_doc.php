<?php

include "header.php";
include 'connect.php';

$id_dokumen = $_GET["id_dokumen"];

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hasil Pencarian
      </h1>
      <ol class="breadcrumb">
      </ol>
    </section>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-book"></i> Detail Dokumen
          </h2>
        </div>
        <!-- /.col -->
      </div>


      <?php

        $result = mysqli_query($conn, "SELECT tb_mahasiswa.nim, judul, nama, nama_jurusan, nama_fakultas, nama_label, tb_dokumen.nama_dokumen AS nama_dokumen, nilai_sim FROM tb_dokumen INNER JOIN tb_cache ON tb_dokumen.id_dokumen = tb_cache.id_dokumen INNER JOIN tb_mahasiswa ON tb_mahasiswa.nim = tb_dokumen.nim INNER JOIN tb_fakultas ON tb_mahasiswa.id_fakultas = tb_fakultas.id_fakultas INNER JOIN tb_jurusan ON tb_mahasiswa.id_jurusan = tb_jurusan.id_jurusan INNER JOIN tb_label ON tb_label.id_label = tb_dokumen.id_label  WHERE tb_cache.id_dokumen='".$id_dokumen."'");


      ?>

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                </tr>
                </thead>
                <tbody>

                <?php $row = mysqli_fetch_array($result); ?>
                  <tr>
                    <td><b>Judul</b></td>
                    <td><?php echo $row["judul"]; ?></td>
                  </tr>
                  <tr>
                    <td><b>Nama</b></td>
                    <td><?php echo $row["nama"]; ?></td>
                  </tr>
                  <tr>
                    <td><b>NIM</b></td>
                    <td><?php echo $row["nim"]; ?></td>
                  </tr>
                  <tr>
                    <td><b>Nama Jurusan</b></td>
                    <td><?php echo $row["nama_jurusan"]; ?></td>
                  </tr>
                  <tr>
                    <td><b>Nama Fakultas</b></td>
                    <td><?php echo $row["nama_fakultas"]; ?></td>
                  </tr>
                  <tr>
                    <td><b>Jenis File</b></td>
                    <td><?php echo $row["nama_label"]; ?></td>
                  </tr>

                </tbody>
              </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


      <div class="row no-print">
        <div class="col-xs-12">
          <a href="download.php?nama_dokumen=<?php echo $row['nama_dokumen']; ?>"><button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i>Download Dokumen
          </button>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>

<?php

include "footer.php";

?>