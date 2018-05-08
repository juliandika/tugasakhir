<?php

include "header.php";
include 'connect.php';
$nim =  $_SESSION['username'];


?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
      </ol>
    </section>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-book"></i> Dokumen saya
          </h2>
        </div>
        <!-- /.col -->
      </div>


      <?php

        $result = mysqli_query($conn, "SELECT tb_dokumen.nama_dokumen, tb_dokumen.judul, tb_dokumen.nama_dokumen AS nama_dokumen, tb_label.nama_label, tb_dokumen.upload_date FROM tb_dokumen INNER JOIN tb_label ON tb_dokumen.id_label = tb_label.id_label WHERE nim = $nim");


      ?>

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Judul</th>
                  <th>Jenis File</th>
                  <th>Waktu Terupload</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php while($row = mysqli_fetch_array($result)) { ?>

                <tr>
                    <td><?php echo $row["judul"]; ?></td>
                    <td><?php echo $row["nama_label"]; ?></td>
                    <td><?php echo $row["upload_date"]; ?></td>
                    <td>
                      <a href="#del<?php echo $row['nama_file']; ?>" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>

                      <?php include('button.php'); ?>
                
                    </td>
                  </tr>
                <?php } ?>

                </tbody>
              </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>

<?php

include "footer.php";

?>