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
      </div>

            <form name="form1" action="" method="post">
              <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nomor Induk Mahasiwa</label>
                      <input type="text" class="form-control" placeholder="NIM" name="nim">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nama</label>
                      <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama">
                    </div>
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
                    <div>
                        <select class="form-control" name="cmbJurusan" id="cmbJurusan" width="300">
                        <option value="">--Pilih Jurusan--</option>
                        </select>

                    </div>
                  </div>
                  <div class="col-lg-12  col-lg-push-3">
                        <input class="btn btn-default submit " type="submit" name="submit1" value="Register">
                  </div>
            </form>



            <?php
            $str = "1234567890";

            $defaultPass = md5($str);

            $pass = md5($defaultPass);

            if(isset($_POST["submit1"]))
            {
                    mysqli_query($conn, "INSERT INTO mahasiswa(nim, nama, id_fakultas, id_jurusan, username, password, status) VALUES('$_POST[nim]','$_POST[nama]','$_POST[cmbFakultas]','$_POST[cmbJurusan]','$_POST[nim]','$defaultPass', 'no')");

                    ?>

                        <div class="alert alert-success col-lg-12 col-lg-push-0">
                            Registration successfully, You will get email when your account is approved
                        </div>

            <?php

            }

          ?>

</section>

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