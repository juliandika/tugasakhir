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


  $Mhs = mysqli_query($conn, "SELECT COUNT(*) AS jumlah_mahasiswa FROM mahasiswa");

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

              <p>User Registrations</p>
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
              <h3 class="box-title">Data mahasiswa</h3>
            </div>
            <!-- /.box-header -->


            <div class="box-body">

            <?php

        $result = mysqli_query($conn, "SELECT * FROM sinonim");


            ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Kata</th>
                  <th>Jenis Kata</th>
                  <th>Sinonim</th>
                </tr>
                </thead>
                <tbody>

                <?php while($row = mysqli_fetch_array($result)){ ?>
                  <tr>
                    <td><?php echo $row["kata"]; ?></td>
                    <td><?php echo $row["jenis_kata"]; ?></td>
                    <td><?php echo $row["sinonim"]; ?></td>
                    <td>

                    <a href="#edit<?php echo $row['nim']; ?>" data-toggle="modal" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                    
                    <a href="#del<?php echo $row['nim']; ?>" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>

                    <button onclick="deleteAjax(<?php echo $row['nim']; ?>,this)" class="btn btn-danger">Delete</button>
                      
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