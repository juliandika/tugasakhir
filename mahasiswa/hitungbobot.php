<?php

function hitungBobot(){

	include 'connect.php';

	$redirect = "upload.php";

	mysqli_query($conn, "TRUNCATE TABLE tbindex_copy");
	$resn = "INSERT INTO tbindex_copy (term, docid, count) SELECT tokenstem,nama_file,count(*) FROM dok9 GROUP BY nama_file,tokenstem";

	if ($conn->query($resn) === TRUE) {
	} else {
    echo "Error: ";

	}

	$n = mysqli_num_rows($resn);
	
	$resn = mysqli_query($conn, "SELECT DISTINCT docid FROM tbindex_copy");
	$n = mysqli_num_rows($resn);

	$resBobot = mysqli_query($conn, "SELECT * FROM tbindex_copy ORDER BY Id");
	$num_rows = mysqli_num_rows($resBobot);

	while($rowbobot = mysqli_fetch_array($resBobot)) {
		
		$term = $rowbobot['term'];		
		$tf = $rowbobot['count'];
		$id = $rowbobot['id'];
		
		$resNTerm = mysqli_query($conn, "SELECT Count(*) as N FROM tbindex_copy WHERE Term = '$term'");
		$rowNTerm = mysqli_fetch_array($resNTerm);
		$NTerm = $rowNTerm['N'];
		
		$w = $tf * log10($n/$NTerm);
		
		$resUpdateBobot = mysqli_query($conn, "UPDATE tbindex_copy SET Bobot = $w WHERE Id = $id");		
  	}

  	//header('Location: '.$redirect);
 }

?>