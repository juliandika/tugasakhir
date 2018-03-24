<?php



function hitungVektor(){

	include 'connect.php';


	$redirect = "upload.php";

	mysqli_query($conn, "TRUNCATE TABLE tbvektor_copy");

	$resDocId = mysqli_query($conn, "SELECT DISTINCT docid FROM tbindex_copy");

	$num_rows = mysqli_num_rows($resDocId);

	while($rowDocId = mysqli_fetch_array($resDocId)) {

		$docId = $rowDocId['docid'];

		$resVektor = mysqli_query($conn, "SELECT bobot FROM tbindex_copy WHERE docid = '$docId'");
		
		$panjangVektor = 0;		
		while($rowVektor = mysqli_fetch_array($resVektor)) {
			$panjangVektor = $panjangVektor + $rowVektor['bobot']  *  $rowVektor['bobot'];	
		}
		
		$panjangVektor = sqrt($panjangVektor);
				
		$resInsertVektor = mysqli_query($conn, "INSERT INTO tbvektor_copy (docId, panjang) VALUES ('$docId', $panjangVektor)");	
	}

	//header('Location: '.$redirect);

}


?>