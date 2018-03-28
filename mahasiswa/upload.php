<?php

error_reporting(0);

include "connect.php";

session_start();

$nim =  $_SESSION['username'];

if(!isset($_SESSION['username'])){

    header('location: login.php');
}

$status_upload = mysqli_query($conn, "SELECT status_upload FROM mahasiswa WHERE nim='".$nim."'");

$baris = mysqli_fetch_array($status_upload);

if($baris['status_upload'] == 'yes'){

  header('Location:my_docs.php');

}else{ 

$nim =  $_SESSION['username'];

include "header.php";
include "toIndex.php";
include "hitungBobot.php";
include "hitungVektor.php";

?>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Invoice
      <small>#007612</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Examples</a></li>
      <li class="active">Invoice</li>
    </ol>
  </section>

  <?php if (!empty($_REQUEST['success'])) { ?>
    
    <div class="pad margin no-print">
      <div class="callout callout-success" style="margin-bottom: 0!important;">
        <h4><i class="icon fa fa-check"></i>Selamat</h4>
        File anda telah berhasil diupload.
      </div>
    </div>
  
  <?php } else if (!empty($_REQUEST['error_size'])) { ?>
    
    <div class="pad margin no-print">
      <div class="callout callout-danger" style="margin-bottom: 0!important;">
        <h4><i class="icon fa fa-ban"></i> Perhatian!</h4>
        Ukuran file tidak boleh lebih dari 5 MB.
      </div>
    </div>
  
  <?php } ?>



<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Upload Dokumen Anda</h3>
          </div>

          <form enctype="multipart/form-data" method="POST" action="upload_dokumen.php" role="form">

            <input type="hidden" name="APC_UPLOAD_PROGRESS" id="progress_key" value="<?php echo $up_id; ?>"/>

            <div class="box-body">

              <div class="form-group">
                      <label for="exampleInputEmail1">Judul Skripsi</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Judul Skripsi" name="judul" required>
                    </div>
              <div class="form-group">
                <label for="exampleInputFile">Upload Cover</label>
                <input type="file" data-file_type="pdf" data-max_size="5000000" name="cover" id="file">
                <p class="help-block">Upload file .pdf dengan maksimal ukuran 5 MB</p>
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Upload Lembar Pengesahan</label>
                <input type="file" name="pengesahan" id="exampleInputFile">
                <p class="help-block">Upload file .pdf dengan maksimal ukuran 5 MB</p>
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Upload Daftar Isi, Abstrak, BAB I</label>
                <input type="file" name="daftarisi" id="file">
                <p class="help-block">Upload file .pdf dengan maksimal ukuran 5 MB</p>
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Upload BAB II</label>
                <input type="file" name="babii" id="file">
                <p class="help-block">Upload file .pdf dengan maksimal ukuran 5 MB</p>
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Upload BAB III</label>
                <input type="file" name="babiii" id="file">
                <p class="help-block">Upload file .pdf dengan maksimal ukuran 5 MB</p>
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Upload BAB IV</label>
                <input type="file" name="babiv" id="file">
                <p class="help-block">Upload file .pdf dengan maksimal ukuran 5 MB</p>
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Upload BAB V</label>
                <input type="file" name="babv" id="file">
                <p class="help-block">Upload file .pdf dengan maksimal ukuran 5 MB</p>
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Upload Daftar Pustaka</label>
                <input type="file" name="dapus" id="file">
                <p class="help-block">Upload file .pdf dengan maksimal ukuran 5 MB</p>
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Upload Halaman Belakang Lainnya</label>
                <input type="file" name="halbelakang" id="file">
                <p class="help-block">Upload file .pdf dengan maksimal ukuran 5 MB</p>
              </div>

              <div class="checkbox">
                <label>
                  <input type="checkbox"> Check me out
                </label>
              </div>
            </div>
            <div class="box-footer">
              <button type="Submit" id="submit" class="btn btn-primary" onclick="Upload()">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

<?php } ?>

<?php

include "footer.php";

?>



