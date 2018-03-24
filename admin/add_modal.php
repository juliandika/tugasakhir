<?php

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

<div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Mahasiswa</h4>
              </div>
              <div class="modal-body">
                <form name="form1" action="add_new.php" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nomor Induk Mahasiwa</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="NIM" name="nim">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nama</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Nama Lengkap" name="nama">
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
            </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
  </div>
          <!-- /.modal-dialog -->
</div>

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



