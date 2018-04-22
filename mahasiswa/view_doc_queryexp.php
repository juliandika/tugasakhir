<?php

include "header.php";
include 'connect.php';

$docid = $_GET["docid"];

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Detail Dokumen
          </h2>
        </div>
        <!-- /.col -->
      </div>


      <?php

        $result = mysqli_query($conn, "SELECT mahasiswa.nim, judul, nama, nama_jurusan, nama_fakultas, nama_label, documents.nama_file AS nama_doc, nilai FROM documents INNER JOIN tbcache ON documents.nama_file = tbcache.docid INNER JOIN mahasiswa ON mahasiswa.nim = documents.nim INNER JOIN fakultas ON mahasiswa.id_fakultas = fakultas.id_fakultas INNER JOIN jurusan ON mahasiswa.id_jurusan = jurusan.id_jurusan INNER JOIN label ON label.id_label = documents.id_label  WHERE docid='".$docid."'");


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
          <a href="download.php?docid=<?php echo $docid; ?>"><button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
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