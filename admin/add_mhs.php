<?php

include "header.php";
include "connect.php";

$sql = "
SELECT
     id_fakultas,
     nama_fakultas
FROM
     fakultas
ORDER BY nama_fakultas
";

$getComboFakultas = mysqli_query($conn, $sql) or die ('Query Gagal');

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
  <div class="box box-success">
        <div class="box-header with-border">
              <h3 class="box-title">General Elements</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <form name="form1" action="add_mhs_action.php" method="post">
              <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nomor Induk Mahasiwa</label>
                      <input type="text" class="form-control" placeholder="NIM" name="nim">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nama</label>
                      <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Pilih Fakultas</label>
                        <select class="form-control" name="cmbFakultas" id="cmbFakultas">
                          <option value="">--Pilih Fakultas--</option>
                            <?php
                               while($data = mysqli_fetch_array($getComboFakultas)){
                                    echo '<option value="'.$data['id_fakultas'].'">'.$data['nama_fakultas'].'</option>';
                               }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                      <label>Pilih Jurusan</label>
                        <select class="form-control" name="cmbJurusan" id="cmbJurusan" width="300">
                        <option value="">--Pilih Jurusan--</option>
                        </select>

                    </div>
                  </div>
                  <div class="box-footer">
                      <button type="submit" name="submit1" class="btn btn-primary" value="Register">Submit</button>
                  </div>
                  </div>
                  
            </form>
          </div>
                  
          </div>
      </div>
</section>

<script type="text/javascript" src="jquery.min.js"></script>

    <script type="text/javascript">
        $(function() {
             $("#cmbFakultas").change(function(){
                  
                  var id_fakultas = $(this).val();
         
                  $.ajax({
                     type: "POST",
                     dataType: "html",
                     url: "getJurusan.php",
                     data: "id_fakultas="+id_fakultas,
                     success: function(msg){
                         if(msg == ''){
                                 $("select#cmbJurusan").html('<option value="">--Pilih Jurusan--</option>');
                                 //$("select#cmbKota").html('<option value="">--Pilih Kota--</option>');
                         }else{
                                   $("select#cmbJurusan").html(msg);                                                       
                         }
                         $("img#imgLoad").hide();
         
                         getAjaxAlamat();                                                        
                     }
                  });                    
             });
         
                
        });
    </script>

<?php

include "footer.php";

?>