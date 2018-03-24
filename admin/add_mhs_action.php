<?php

            include('connect.php');

            $str = "1234567890";

            $defaultPass = md5($str);

            $pass = md5($defaultPass);

            if(isset($_POST["submit1"]))
            {
                    mysqli_query($conn, "INSERT INTO mahasiswa(nim, nama, id_fakultas, id_jurusan, username, password, status) VALUES('$_POST[nim]','$_POST[nama]','$_POST[cmbFakultas]','$_POST[cmbJurusan]','$_POST[nim]','$defaultPass', 'no')");


            }

            header('location:view_mhs.php');

?>