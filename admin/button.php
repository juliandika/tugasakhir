  <!-- Edit data -->

  <div class="modal fade" id="edit<?php echo $row['nim']; ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Data Mahasiswa</h4>
        </div>
        <div class="modal-body">
        <?php
          
          $edit = mysqli_query($conn,"SELECT * FROM mahasiswa WHERE nim='".$row['nim']."'");
          $erow = mysqli_fetch_array($edit);

        ?>
       
          <form name="form1" action="edit.php?id=<?php echo $erow['nim']; ?>" method="post">
            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Nomor Induk Mahasiwa</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="NIM" name="nim" value="<?php echo $erow['nim']; ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Nama</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Nama Lengkap" name="nama" value="<?php echo $erow['nama']; ?>">
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
    </div>         <!-- /.modal-dialog -->
</div>

<!-- Delete data -->

<div class="modal fade" id="del<?php echo $row['nim']; ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Data Mahasiswa</h4>
        </div>
        <div class="modal-body">
        <?php
          
          $del = mysqli_query($conn,"SELECT * FROM mahasiswa WHERE nim='".$row['nim']."'");
          $drow = mysqli_fetch_array($del);

        ?>
        <div class="container-fluid">
          <h5><center>Apakah anda yakin ingin menghapus <strong><?php echo $drow['nama']; ?></strong>?</center></h5> 
        </div> 

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
          <a href="delete.php?id=<?php echo $row['nim']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>         <!-- /.modal-dialog -->
</div>
