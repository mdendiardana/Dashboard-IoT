<?php 
require('koneksi.php');

header("Location: data.php");

$id = $_GET ['id'];

$row = mysqli_query("DELETE FROM read_sensor WHERE id ='$id'");

if (hapus($id)>0){
	echo"
	<script>
		alert('Data Berhasil di Hapus');
		document.location.href = 'data.php';
	</script>";

}	else {
	echo "
		<script>
			alert('Data Gagal di Hapus');
			document.location.href = 'data.php';
		</script>";
}

 ?>