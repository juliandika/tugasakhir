<?php

include "header.php";
include 'connect.php';

$docid = $_GET["docid"];

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>#007612</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Detail Dokumen
            <small class="pull-right">Date: 2/10/2014</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>


      <?php

        $result = mysqli_query($conn, "SELECT DISTINCT nim, judul, nama, nama_jurusan, nama_unit_panjang, label, semua.doc AS docid, nilai FROM semua INNER JOIN tbcache ON semua.doc = tbcache.docid WHERE docid='".$docid."'");


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
                    <td><?php echo $row["nama_unit_panjang"]; ?></td>
                  </tr>
                  <tr>
                    <td><b>Jenis File</b></td>
                    <td><?php echo $row["label"]; ?></td>
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