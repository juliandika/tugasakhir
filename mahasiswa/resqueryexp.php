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
        Hasil Pencarian
      </h1>
      <ol class="breadcrumb">
      </ol>
    </section>

<section class="content">
    <div class="row">
		<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <?php


              hitungsim($query);

				      $result = mysqli_query($conn, "SELECT judul, nama, nama_jurusan, nama_fakultas, nama_label, documents.nama_file AS nama_doc, nilai FROM documents INNER JOIN tbcache ON documents.nama_file = tbcache.docid INNER JOIN mahasiswa ON mahasiswa.nim = documents.nim INNER JOIN fakultas ON mahasiswa.id_fakultas = fakultas.id_fakultas INNER JOIN jurusan ON mahasiswa.id_jurusan = jurusan.id_jurusan INNER JOIN label ON label.id_label = documents.id_label ORDER BY nilai DESC");

            ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Judul</th>
                  <th>Nama Jurusan</th>
                  <th>Nama Fakultas</th>
                  <th>Label</th>
                  <th>SIM</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php while($row = mysqli_fetch_array($result)){ ?>
	                <tr>
	                  <td><?php echo $row["judul"]; ?></td>
	                  <td><?php echo $row["nama_jurusan"]; ?></td>
                    <td><?php echo $row["nama_fakultas"]; ?></td>
	                  <td><?php echo $row["label"]; ?></td>
	                  <td><?php echo $row["nilai"]; ?></td>
                    <td><a href="view_doc_queryexp.php?docid=<?php echo $row["nama_doc"]; ?>"><button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;"></i>Lihat Dokumen</button></td>
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