<div class="modal fade" id="view<?php echo $row['nama_file']; ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Rincian Dokumen</h4>
        </div>
        <div class="modal-body">
        <?php
          
          $view = mysqli_query($conn,"SELECT mahasiswa.nim,mahasiswa.nama,documents.nama_file,documents.nama_file,fakultas.nama_fakultas, jurusan.nama_jurusan,label.nama_label, documents.judul AS judul, documents.upload_date AS upload_date FROM mahasiswa INNER JOIN documents ON mahasiswa.nim = documents.nim INNER JOIN fakultas ON mahasiswa.id_fakultas = fakultas.id_fakultas INNER JOIN jurusan ON mahasiswa.id_jurusan = jurusan.id_jurusan INNER JOIN label ON label.id_label = documents.id_label WHERE nama_file='".$row['nama_file']."'");

          $eview = mysqli_fetch_array($view);

        ?>

        <table id="example1">
                <thead>
                <tr>
                  <th>Jenis File</th>
                  <th>: </th>
                  <th><?php echo $eview["nama_label"]; ?></th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><b>Nama Pemilik</b></td>
                    <th>: </th>
                    <td><?php echo $eview["nama"]; ?></td>
                  </tr>
                  <tr>
                    <td><b>Nama File</b></td>
                    <th>: </th>
                    <td><?php echo $eview["nama_file"]; ?></td>
                  </tr>
                  <tr>
                    <td><b>Judul</b></td>
                    <th>: </th>
                    <td><?php echo $eview["judul"]; ?></td>
                  </tr>
                  <tr>
                    <td><b>Tanggal Upload</b></td>
                    <th>: </th>
                    <td><?php echo $eview["upload_date"]; ?></td>
                  </tr>
                </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>         <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="del<?php echo $row['id_doc']; ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Dokumen</h4>
        </div>
        <div class="modal-body">
        <?php
          
          $del = mysqli_query($conn,"SELECT * FROM documents WHERE nama_file='".$row['nama_file']."'");
          $drow = mysqli_fetch_array($del);

        ?>
        <div class="container-fluid">
          <h5><center>Apakah anda yakin ingin menghapus <strong><?php echo $drow['nama_file']; ?></strong>?</center></h5> 
        </div> 

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
          <a href="delete_file.php?nama_file=<?php echo $row['nama_file']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>         <!-- /.modal-dialog -->
</div>