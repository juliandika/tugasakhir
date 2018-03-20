<?php

include 'connect.php';


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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Registrasi Mahasiswa Baru</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/custom.min.css" rel="stylesheet">
</head>

<br>

<div class="col-lg-12 text-center ">
    <h1 style="font-family:Lucida Console">E-Library</h1>
</div>


<body class="login" style="margin-top: -20px;">

    <?php
        $result = mysqli_query($conn, "SELECT * FROM fakultas");
    ?>


    <div class="login_wrapper">

            <section class="login_content" style="margin-top: -40px;">
                <form name="form1" action="" method="post">
                    <h2>User Registration Form</h2><br>

                    <div>
                        <input type="text" class="form-control" placeholder="NIM" name="nim" required=""/>
                    </div>
                    <div>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" required=""/>
                    </div>

                    <div>
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
                    <div class="col-lg-12  col-lg-push-3">
                        <input class="btn btn-default submit " type="submit" name="submit1" value="Register">
                    </div>

                </form>
            </section>


            <?php


            $str = "1234567890";

            $defaultPass = md5($str);



            $pass = md5($defaultPass);

            if(isset($_POST["submit1"]))
            {
                    mysqli_query($conn, "INSERT INTO mahasiswa VALUES('$_POST[nim]','$_POST[nama]','$_POST[cmbFakultas]','$_POST[cmbJurusan]','$_POST[nim]','$defaultPass','no')");


                    ?>

                    <div class="alert alert-success col-lg-12 col-lg-push-0">
                        Registration successfully, You will get email when your account is approved
                    </div>

            <?php

            }


            ?>

    </div>

    <script type="text/javascript" src="js/jquery.min.js"></script>

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
</body>
</html>



