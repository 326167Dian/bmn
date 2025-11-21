<?php
include "../../../configurasi/koneksi.php";

	$kod = $_POST['nm_pelanggan'];
	
	$pecah = explode("/", $kod);
	$nm_pelanggan = $pecah[0];
	$tlp_pelanggan = $pecah[1];
	
	$ubah=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM pelanggan WHERE nm_pelanggan = '$nm_pelanggan'AND tlp_pelanggan = '$tlp_pelanggan'");
	$re=mysqli_fetch_array($ubah);
	
	  $json[] = array('nm_pelanggan'=> $re['nm_pelanggan'],
					'tgl_lahir'=> date('Y-m-d', strtotime($re['tgl_lahir'])));

	 echo json_encode($json);

?>
