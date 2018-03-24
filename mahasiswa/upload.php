<?php

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

  <div class="pad margin no-print">
    <div class="callout callout-info" style="margin-bottom: 0!important;">
      <h4><i class="fa fa-info"></i> Note:</h4>
      This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
    </div>
  </div>

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
  <div class="clearfix"></div>
</div>


<script>
  
function Upload() {
        var fileUpload = document.getElementById("fileUpload");
        if (typeof (fileUpload.files) != "undefined") {
            var size = parseFloat(fileUpload.files[0].size / 1024).toFixed(2);
            alert(size + " KB.");
        } else {
            alert("This browser does not support HTML5.");
        }
    }


</script>




<?php

include "footer.php";

?>



