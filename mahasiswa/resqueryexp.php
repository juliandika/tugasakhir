<?php

include "header.php";
include 'connect.php';
include 'sim_queryexpansion.php';

$query = $_GET['keyword'];

?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>#007612</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

<section class="content">
    <div class="row">
		<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <?php


              hitungsim($query);

				      $result = mysqli_query($conn, "SELECT DISTINCT judul, nama, nama_jurusan, label, docid, semua.doc AS nama_doc, nilai FROM semua INNER JOIN tbcache_copy ON semua.doc = tbcache_copy.docid WHERE query = '$query' ORDER BY nilai DESC");


            ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Judul</th>
                  <th>Nama Jurusan</th>
                  <th>Label</th>
                  <th>Nama Dokumen</th>
                  <th>SIM</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php while($row = mysqli_fetch_array($result)){ ?>
	                <tr>
	                  <td><?php echo $row["judul"]; ?></td>
	                  <td><?php echo $row["nama_jurusan"]; ?></td>
	                  <td><?php echo $row["label"]; ?></td>
	                  <td><?php echo $row["nama_doc"]; ?></td>
	                  <td><?php echo $row["nilai"]; ?></td>
                    <td><a href="view_doc_queryexp.php?docid=<?php echo $row["docid"]; ?>"><button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;"></i>Lihat Dokumen</button></td>
	                </tr>
	              <?php } ?>

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
       </div>
     </section>
     <div class="clearfix"></div>
  </div>

<?php

include "footer.php";

?>