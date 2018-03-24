<?php

include "header.php";
include 'connect.php';

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

<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Pencarian Dokumen</h3>
            </div>

            <form entype="multipart/form-data" method="GET" action="result_queryexp.php">
              <div class="box-body">
                <input class="form-control input-lg" name="keyword" type="text" placeholder="Masukkan kata kunci">
                <br>
              </div>
              <div class="box-footer">
              <button type="submit" class="btn btn-primary" value="Submit">Submit</button>
            </div>
            </form>
            <!-- /.box-body -->
          </div>
      </div>
    </div>
  </section>

  <div class="clearfix"></div>
</div>

<?php

include "footer.php";

?>