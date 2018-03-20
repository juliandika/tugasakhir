<?php

include ('PdfToText.phpclass');
include 'connect.php';

function toIndex($nama_file_cover){

    include 'connect.php';
    //include ('PdfToText.phpclass');

    $file = $nama_file_cover;

    echo $file . "jkajsa";

	$string = (string) new PdfToText ("fileupload/" . $file);

    //$nama_file = basename( $_FILES['file']['name']);

    //echo basename( $_FILES['file']['name']);

    echo '<br>';

    $teks = preg_replace('/[^a-zA-Z -]/', '', $string);

    $teks2 = preg_replace('/\b\w\b\s?/', '', $teks);

    $teks3 = preg_replace('/\s\s+/', ' ', $teks2);

    $teks4 = preg_replace('/[-\n\r]/', ' ', $teks3);


    $teks5 = strtolower($teks4);

    //echo $teks5;

    $teks6 = explode(" ",$teks5);

    //var_dump($teks5);

    $remove_stopword = "SELECT * FROM stopwords";

    $hasil = $conn->query($remove_stopword);

    if($hasil->num_rows > 0){

        while($row = $hasil->fetch_array()) {

            $stopword[] = $row['stopword'];
        }
    }
    else{

        echo "Gagal";
    }


    $filter = array_diff($teks6,$stopword);

    $teks7 = implode(" ",$filter);

    print_r($filter);

    echo $teks7;

    for($i=0; $i<count($filter); $i++){

        if(!empty($filter[$i]) && strlen($filter[$i]) > 2){

            echo $filter[$i]. "<br>";

            mysqli_query($conn, "INSERT INTO dok8 (nama_file, tokenstem) VALUES('".$file."', '".$filter[$i]."')");

            //mysqli_query($conn, "INSERT INTO dok_copy (nama_file, tokenstem) VALUES('daddsd', 'fsds')");

        }

              
    }

}



?>