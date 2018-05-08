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

  $Doc = mysqli_query($conn, "SELECT COUNT(*) AS jumlah_dokumen FROM tbvektor_copy");

  $jmlDoc = mysqli_fetch_array($Doc);


  $Mhs = mysqli_query($conn, "SELECT COUNT(*) AS jumlah_mahasiswa FROM tb_mahasiswa");

  $jmlMhs = mysqli_fetch_array($Mhs);

?>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
        
        <!-- ./col -->
        
        <!-- ./col -->
        
        <!-- ./col -->
         <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data mahasiswa</h3>
            </div>
            <!-- /.box-header -->


            <div class="box-body">

            <?php

        $result = mysqli_query($conn, "SELECT tb_mahasiswa.nim,tb_mahasiswa.nama,tb_fakultas.nama_fakultas, tb_jurusan.nama_jurusan FROM tb_mahasiswa INNER JOIN tb_fakultas ON tb_mahasiswa.id_fakultas = tb_fakultas.id_fakultas INNER JOIN tb_jurusan ON tb_mahasiswa.id_jurusan = tb_jurusan.id_jurusan");


            ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>Nama Jurusan</th>
                  <th>Nama Fakultas</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php while($row = mysqli_fetch_array($result)){ ?>
                  <tr>
                    <td><?php echo $row["nim"]; ?></td>
                    <td><?php echo $row["nama"]; ?></td>
                    <td><?php echo $row["nama_jurusan"]; ?></td>
                    <td><?php echo $row["nama_fakultas"]; ?></td>
                    <td>

                      <a href="#edit<?php echo $row['nim']; ?>" data-toggle="modal" data-target="#edit<?php echo $row['nim']; ?>" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                       <a href="#edit<?php echo $row['nim']; ?>" data-toggle="modal" data-target="#edit<?php echo $row['nim']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                      <?php include('button.php'); ?>

                    </td>
                  </tr>

                <?php 

                } 

                ?>

                </tbody>
              </table>
              <a href="add_mhs.php" class="btn btn-primary" role="button">Tambah Data</a>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

      </div>
</section>

<script type = "text/javascript">

  function deleteAjax(nim,obj){
    $.ajax({

      type: 'get',
      url: 'delete.php',
      data: {id:nim},

      success:function(data){
        data = JSON.parse(data);
        if(data){
          
          $(obj).closest('tr').remove();
        
        }else{

            alert("Data was succesfully captured");
        }
      }

    });
  }
 
</script>

<?php

include "footer.php";

?>