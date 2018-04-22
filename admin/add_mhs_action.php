<?php

            include('connect.php');

            $str = "1234567890";

            $defaultPass = md5($str);

            $pass = md5($defaultPass);

            if(isset($_POST["submit1"]))
            {

                    $sql = "INSERT INTO mahasiswa(nim, nama, id_fakultas, id_jurusan, username, password, status_upload) VALUES('".$_POST['nim']."','".$_POST['nama']."','".$_POST['cmbFakultas']."','".$_POST['cmbJurusan']."','".$_POST['nim']."','".$defaultPass."', 'no')";

                    $conn->query($sql);

            		//mysqli_query($conn, "INSERT INTO mahasiswa(nim, nama) VALUES('$_POST[nim]','$_POST[nama]')");


            }

            

            header('location:view_mhs.php');

?>