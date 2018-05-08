<?php

include "header.php";
include 'connect.php';
include 'sim.php';

$keyword = $_GET['keyword'];

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

              hitungsim($keyword);


				      $result = mysqli_query($conn, "SELECT tb_dokumen.id_dokumen AS id_dokumen, judul, nama, nama_jurusan, nama_fakultas, nama_label, tb_dokumen.nama_dokumen AS nama_dokumen, nilai_sim FROM tb_dokumen INNER JOIN tb_cache ON tb_dokumen.id_dokumen = tb_cache.id_dokumen INNER JOIN tb_mahasiswa ON tb_mahasiswa.nim = tb_dokumen.nim INNER JOIN tb_fakultas ON tb_mahasiswa.id_fakultas = tb_fakultas.id_fakultas INNER JOIN tb_jurusan ON tb_mahasiswa.id_jurusan = tb_jurusan.id_jurusan INNER JOIN tb_label ON tb_label.id_label = tb_dokumen.id_label ORDER BY tb_cache.nilai_sim DESC");


            ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Judul</th>
                  <th>Nama Jurusan</th>
                  <th>Nama Fakultas</th>
                  <th>Label</th>
                  <th>Similarity</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                 <?php while($row = mysqli_fetch_array($result)){ ?>
                  <tr>
                    <td><?php echo $row["nilai_sim"]; ?></td>
                    <td><?php echo $row["judul"]; ?></td>
                    <td><?php echo $row["nama_jurusan"]; ?></td>
                    <td><?php echo $row["nama_fakultas"]; ?></td>
                    <td><?php echo $row["nama_label"]; ?></td>
                    <td><a href="view_doc.php?id_dokumen=<?php echo $row["id_dokumen"]; ?>"><button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;"></i>Lihat Dokumen</button></td>
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