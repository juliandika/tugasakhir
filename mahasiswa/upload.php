<?php

include "header.php";

?>

<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Upload Dokumen Anda</h3>
          </div>
          <form enctype="multipart/form-data" method="POST" action="upload_dokumen.php" role="form">
            <div class="box-body">

              <div class="form-group">
                <label for="exampleInputFile">Upload Cover</label>
                <input type="file" name="cover" id="exampleInputFile">
                <p class="help-block">Upload file .pdf dengan maksimal ukuran 5 MB</p>
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Upload Lembar Pengesahan</label>
                <input type="file" name="pengesahan" id="exampleInputFile">
                <p class="help-block">Upload file .pdf dengan maksimal ukuran 5 MB</p>
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Upload Daftar Isi, Abstrak, BAB I</label>
                <input type="file" name="daftarisi" id="exampleInputFile">
                <p class="help-block">Upload file .pdf dengan maksimal ukuran 5 MB</p>
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Upload BAB II</label>
                <input type="file" name="babii" id="exampleInputFile">
                <p class="help-block">Upload file .pdf dengan maksimal ukuran 5 MB</p>
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Upload BAB III</label>
                <input type="file" name="babiii" id="exampleInputFile">
                <p class="help-block">Upload file .pdf dengan maksimal ukuran 5 MB</p>
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Upload BAB IV</label>
                <input type="file" name="babiv" id="exampleInputFile">
                <p class="help-block">Upload file .pdf dengan maksimal ukuran 5 MB</p>
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Upload BAB V</label>
                <input type="file" name="babv" id="exampleInputFile">
                <p class="help-block">Upload file .pdf dengan maksimal ukuran 5 MB</p>
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Upload Daftar Pustaka</label>
                <input type="file" name="dapus" id="exampleInputFile">
                <p class="help-block">Upload file .pdf dengan maksimal ukuran 5 MB</p>
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Upload Halaman Belakang Lainnya</label>
                <input type="file" name="halbelakang" id="exampleInputFile">
                <p class="help-block">Upload file .pdf dengan maksimal ukuran 5 MB</p>
              </div>

              <div class="checkbox">
                <label>
                  <input type="checkbox"> Check me out
                </label>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

<?php

include "footer.php";

?>