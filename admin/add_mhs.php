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

  $sql_fakultas = mysqli_query($conn, "SELECT * FROM tb_fakultas");

?>
      <!-- Small boxes (Stat box) -->
  <div class="box box-success">
        <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Mahasiswa</h3>
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
                        <select class="form-control" name="fakultas" id="fakultas">
                          <option value="">--Pilih Fakultas--</option>
                            <?php while($row_fakultas = mysqli_fetch_array($sql_fakultas)){ ?>
                                    <option value="<?php echo $row_fakultas['id_fakultas'] ?>"><?php echo $row_fakultas['nama_fakultas']; ?></option>
                            <?php   } ?>
                        </select>
                    </div>
                    <div class="form-group">
                      <label>Pilih Jurusan</label>
                        <select class="form-control" name="jurusan" id="jurusan" width="300">
                          <option value="">--Pilih Jurusan--</option>
                          <option></option>
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
  
  $(document).ready(function(){
      $('#fakultas').change(function() {

        var id_fakultas = $(this).val();

        $.ajax({
          type: 'POST',
          url: 'jurusan.php',
          data: 'id_fakultas='+id_fakultas,
          success: function(response) {
              $('#jurusan').html(response);
          }

        });

      })
  });
</script>




<?php

include "footer.php";

?>