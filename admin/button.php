<?php

include "connect.php";

$sql_fakultas = mysqli_query($conn, "SELECT * FROM tb_fakultas");

?>


<div class="modal fade" id="edit<?php echo $row['nim']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Edit</h4></center>
                </div>
                <div class="modal-body">
                <?php
                    $edit=mysqli_query($conn,"SELECT tb_mahasiswa.nim,tb_mahasiswa.nama,tb_fakultas.nama_fakultas AS nama_fakultas, tb_jurusan.nama_jurusan FROM tb_mahasiswa INNER JOIN tb_fakultas ON tb_mahasiswa.id_fakultas = tb_fakultas.id_fakultas INNER JOIN tb_jurusan ON tb_mahasiswa.id_jurusan = tb_jurusan.id_jurusan WHERE nim ='".$row['nim']."'");
                    $erow=mysqli_fetch_array($edit);

                    echo $erow['nama_fakultas'];
                ?>
                <div class="container-fluid">
                <form method="POST" action="edit.php?id=<?php echo $erow['nim']; ?>">
                    <div class="row">
                        <div class="col-lg-2">
                            <label style="position:relative; top:7px;">NIM</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" name="firstname" class="form-control" value="<?php echo $erow['nim']; ?>">
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-2">
                            <label style="position:relative; top:7px;">Nama</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" name="firstname" class="form-control" value="<?php echo $erow['nama']; ?>">
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-2">
                            <label style="position:relative; top:7px;">Fakultas</label>
                        </div>
                        <div class="col-lg-10">
                            <select class="form-control" name="fakultas" id="edit-fakultas">
                                <option value="<?php $erow['id_fakultas']; ?>"><?php echo $erow['nama_fakultas']; ?></option>
                                <?php while($row_fakultas = mysqli_fetch_array($sql_fakultas)){ ?>
                                        <option value="<?php echo $row_fakultas['id_fakultas'] ?>"><?php echo $row_fakultas['nama_fakultas']; ?></option>
                            <?php   } ?>
                            </select>
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-2">
                            <label style="position:relative; top:7px;">Jurusan</label>
                        </div>
                        <div class="col-lg-10">
                            <select class="form-control" name="jurusan" id="jurusanx">
                                <option value="<?php $erow['id_jurusan']; ?>"><?php echo $erow['nama_jurusan']; ?></option>
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-check"></span> Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

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

  $(document).ready(function(){
      $('#edit-fakultas').change(function() {

        var id_fakultas = $(this).val();

        $.ajax({
          type: 'POST',
          url: 'jurusan.php',
          data: 'id_fakultas='+id_fakultas,
          success: function(response) {
              $('#jurusanx').html(response);
          }

        });

      })
  });
</script>