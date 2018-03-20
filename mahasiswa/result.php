<?php

include "header.php";
include 'connect.php';

?>

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

				$result = mysqli_query($conn, "SELECT DISTINCT judul, nama, nama_jurusan, label, semua.doc AS nama_doc, nilai FROM semua INNER JOIN tbcache ON semua.doc = tbcache.docid ORDER BY nilai DESC");


            ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Judul</th>
                  <th>Nama Jurusan</th>
                  <th>Label</th>
                  <th>Nama Dokumen</th>
                  <th>SIM</th>
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

<?php

include "footer.php";

?>