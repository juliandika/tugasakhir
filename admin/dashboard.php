<?php

include "header.php";
include "connect.php";

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

  $Doc = mysqli_query($conn, "SELECT COUNT(*) AS jumlah_dokumen FROM tb_vektor");

  $jmlDoc = mysqli_fetch_array($Doc);


  $Mhs = mysqli_query($conn, "SELECT COUNT(*) AS jumlah_mahasiswa FROM tb_mahasiswa");

  $jmlMhs = mysqli_fetch_array($Mhs);

?>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $jmlDoc['jumlah_dokumen']; ?></h3>

              <p>Jumlah Dokumen</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $jmlMhs['jumlah_mahasiswa']; ?></h3>

              <p>Jumlah Mahasiswa</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>
              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

          <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Dokumen</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <?php

        $result = mysqli_query($conn, "SELECT tb_mahasiswa.nim,tb_mahasiswa.nama,tb_dokumen.id_dokumen, tb_dokumen.nama_dokumen,tb_dokumen.nama_dokumen,tb_fakultas.nama_fakultas, tb_jurusan.nama_jurusan,tb_label.nama_label, tb_dokumen.status_index FROM tb_mahasiswa INNER JOIN tb_dokumen ON tb_mahasiswa.nim = tb_dokumen.nim INNER JOIN tb_fakultas ON tb_mahasiswa.id_fakultas = tb_fakultas.id_fakultas INNER JOIN tb_jurusan ON tb_mahasiswa.id_jurusan = tb_jurusan.id_jurusan INNER JOIN tb_label ON tb_label.id_label = tb_dokumen.id_label");


            ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>Nama Jurusan</th>
                  <th>Nama Fakultas</th>
                  <th>Label</th>
                  <th>Action</th>
                  <th>Index</th>
                </tr>
                </thead>
                <tbody>

                <?php while($row = mysqli_fetch_array($result)){ ?>
                  <tr>
                    <td><?php echo $row["nim"]; ?></td>
                    <td><?php echo $row["nama"]; ?></td>
                    <td><?php echo $row["nama_jurusan"]; ?></td>
                    <td><?php echo $row["nama_fakultas"]; ?></td>
                    <td><?php echo $row["nama_label"]; ?></td>
                    <td>

                      <a href="delete_file.php?nama_dokumen=<?php echo $row['nama_dokumen']; ?>" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>

                      
                    </td>
                    <td>
                      <?php if($row["status_index"] == 0){ ?>

                          <a href="toIndex.php?id_dokumen=<?php echo $row['id_dokumen']; ?>" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-refresh"></span> Belum terindeks</a>
                      
                      <?php }else{ ?>

                          <a href="#view<?php echo $row['nama_dokumen']; ?>" data-toggle="modal" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>    Terindeks</a>

                    <?php } ?>

                    <?php include('button_file.php'); ?>
                   
                    </td>
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

<script type = "text/javascript">

  function updateAjax(id_doc,obj){
    $.ajax({

      type: 'get',
      url: 'toIndex.php',
      data: {nama_file:id_doc},

      success:function(data){
        data = JSON.parse(data);

        if(data){
          
          alert("Data berhasil diupdate");
        
        }else{

            alert("Data gagal diupdate");
        }
      }

    });
  }
 
</script>

<?php

include "footer.php";

?>