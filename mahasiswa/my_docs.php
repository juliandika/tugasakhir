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
            <i class="fa fa-globe"></i>Dokumen saya
            <small class="pull-right">Date: 2/10/2014</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>


      <?php

        $result = mysqli_query($conn, "SELECT documents.id_doc, documents.judul, documents.nama_file, label.nama_label, documents.upload_date FROM documents INNER JOIN label ON documents.id_label = label.id_label WHERE nim = $nim");


      ?>

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Judul</th>
                  <th>Jenis File</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php while($row = mysqli_fetch_array($result)) { ?>

                <tr>
                    <td><?php echo $row["judul"]; ?></td>
                    <td><?php echo $row["nama_label"]; ?></td>
                    <td>
                      <a href="#view<?php echo $row['id_doc']; ?>" data-toggle="modal" class="btn btn-info"><span class="glyphicon glyphicon-info-sign"></span> Detail</a>
                      <a href="#del<?php echo $row['id_doc']; ?>" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>

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