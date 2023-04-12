<?php 	
require('koneksi.php');

// ambil data di URL
$id = $_GET['id']; 

// query data mahasiswa berdasarkan berdasarkan id
$row = mysqli_query("SELECT * FROM read_sensor WHERE id = '$id'")[0];


// cek apakah tombol submit sudah ditekan atau belum
if ( isset($_POST["submit"]) ) {
	
	// cek apakah data berhasil diubah
	if (ubah($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href='data.php'
			</script>";
	} else {
		echo "
		<script>
				alert('data gagal diubah!');
				document.location.href='data.php'
			</script>";
	}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ubah Data</title>
</head>
<body>
	<h1>UBAH DATA BARU</h1>

<form action="" method="POST">
	<input type="hidden" name="id" value="<?=	$row['id']; ?>">
	<ul>
		<li>
			<label for="topic">topic  : </label>
			<input type="text" name="no" id="no" required value="<?=	$data["topic"]; ?>">
		</li>
		<li>
			<label for="payload">payload :</label>
			<input type="text" name="payload" id="payload" required value="<?=	$data["payload"]; ?>">
		</li>
		<li>
			<label for="waktu">waktu</label>
			<input type="text" name="waktu" id="waktu" required value="<?=	$data["waktu"]; ?>">
		</li>
		<li>
			<button type="submit" name="submit">UBAH DATA</button>
		</li>

	</ul>
</form>
</body>
</html>