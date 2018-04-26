<?php

include ('PdfToText.phpclass');
include 'connect.php';
include 'hitungbobot.php';
include 'hitungvektor.php';

$id_dokumen = $_GET['id_dokumen'];

$result = mysqli_query($conn, "SELECT nama_dokumen FROM tb_dokumen WHERE id_dokumen='".$id_dokumen."'");

$row = mysqli_fetch_array($result);

$nama_file = $row['nama_dokumen'];

$redirect = "dashboard.php";

function convertToString($nama_file, $id_dokumen){

    include 'connect.php';

    $file = $nama_file;

	$string = (string) new PdfToText ("../mahasiswa/fileupload/" . $nama_file);

    return $string;

}

function caseFolding($string){

    $cleaning_text1 = preg_replace('/[^a-zA-Z -]/', '', $string);

    $cleaning_text2 = preg_replace('/[-\n\r]/', ' ', $cleaning_text1);

    $case_folding = strtolower($cleaning_text2);

    return $case_folding;

}

function tokenize($case_folding){

    $tokenize = explode(" ",$case_folding);

    return $tokenize;

}

function filtering($tokenize){

    include 'connect.php';

    $remove_stopwords = "SELECT * FROM tb_stopwords";

    $hasil = $conn->query($remove_stopwords);

    if($hasil->num_rows > 0){

        while($row = $hasil->fetch_array()) {

            $stopword[] = $row['stopword'];
        }
    }

    $filter = array_diff($tokenize,$stopword);

    return $filter;

}

function indexing($filter, $nama_file, $id_dokumen, $tokenize){

    include 'connect.php';
    $term = array();
    $data = array();

    $file = $nama_file;

    for($i=0; $i<count($tokenize); $i++){

        if(!empty($filter[$i]) && strlen($filter[$i]) > 2){

            echo $filter[$i] . "<br>";

            $term[] = array($id_dokumen, $file, $filter[$i]);

        }


              
    }

    
    foreach($term as $row) {
        $id_dokumen = (int) $row[0];
        $file = mysqli_real_escape_string($conn, $row[1]);
        $filter = mysqli_real_escape_string($conn, $row[2]);
        $data[] = "($id_dokumen, '$file', '$filter')";
    }

    $values = implode(',', $data);

    $insert = "INSERT INTO tb_term (id_dokumen, nama_dokumen, term) VALUES $values";

    $conn->query($insert);


}

$string = convertToString($nama_file, $id_dokumen);

$case_folding = caseFolding($string);

$tokenize = tokenize($case_folding);

$filter = filtering($tokenize);

indexing($filter, $nama_file, $id_dokumen, $tokenize);
hitungBobot();
hitungVektor();

mysqli_query($conn, "UPDATE tb_dokumen SET status_index = 1 WHERE id_dokumen='".$id_dokumen."'");

//header('Location: '.$redirect);




?>