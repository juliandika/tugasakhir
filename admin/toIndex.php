<?php

include ('PdfToText.phpclass');
include 'connect.php';
include 'hitungbobot.php';
include 'hitungvektor.php';

$nama_file = $_GET['nama_file'];

/*function toIndex($nama_file){

    include 'connect.php';

    $file = $nama_file;

	$string = (string) new PdfToText ("../mahasiswa/fileupload/" . $file);

    //$nama_file = basename( $_FILES['file']['name']);

    //echo basename( $_FILES['file']['name']);

    $teks = preg_replace('/[^a-zA-Z -]/', '', $string);

    $teks2 = preg_replace('/\b\w\b\s?/', '', $teks);

    $teks3 = preg_replace('/\s\s+/', ' ', $teks2);

    $teks4 = preg_replace('/[-\n\r]/', ' ', $teks3);


    $teks5 = strtolower($teks4);

    //echo $teks5;

    $teks6 = explode(" ",$teks5);

    $remove_stopword = "SELECT * FROM stopwords";

    $hasil = $conn->query($remove_stopword);

    if($hasil->num_rows > 0){

        while($row = $hasil->fetch_array()) {

            $stopword[] = $row['stopword'];
        }
    }
    else{

        //echo "Gagal";
    }


    $filter = array_diff($teks6,$stopword);

    $teks7 = implode(" ",$filter);

    for($i=0; $i<count($filter); $i++){

        if(!empty($filter[$i]) && strlen($filter[$i]) > 2){

            //mysqli_query($conn, "INSERT INTO dok8 (nama_file, tokenstem) VALUES($file, $filter[$i])");

            //echo "jdajda";

            mysqli_query($conn, "INSERT INTO dok9 (nama_file, tokenstem) VALUES('".$file."', '".$filter[$i]."')");

        }

              
    }

    mysqli_query($conn, "UPDATE documents SET status_index = 1 WHERE nama_file='".$nama_file."'");   

}*/

//toIndex($nama_file);
//hitungBobot();
//hitungVektor();
$nama_file = $_GET['nama_file'];

$update = "UPDATE documents SET status_index = 1 WHERE nama_file='".$nama_file."'";

if($conn->query($update)){
        
        echo json_encode(true);
        

    }else{

        echo json_encode(false);
    }
//header('Location: '.$redirect);


?>