<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datasensors";

$koneksi = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) { //mengecek apakah koneksi database error
    echo 'Gagal melakukan koneksi ke Database : ' . mysqli_connect_error(); //pesan ketika koneksi database error
}

function query($sql){
    global $koneksi;
    $result = mysqli_query($koneksi, $sql);
    $rows = [];
    while($row = mysqli_fetch_assoc($result) ) {
        $rows[]=$row;
    }
    return $rows;
}


function hapus($id) {
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM read_sensor WHERE id ='$id'");

    return mysqli_affected_rows($koneksi);
}

function ubah($data) {
    global $conn;
    $id = $data["id"];
    $topic = htmlspecialchars($data["topic"]);
    $payload = htmlspecialchars($data["payload"]);
    $waktu = htmlspecialchars($data["waktu"]);

    //  query ubah data
        $query = "UPDATE read_sensor SET 
        topic ='$topic',
        payload ='$payload',
        waktu ='$waktu',
        WHERE id =$id
        ";
    
mysqli_query($koneksi, $sql);
    return mysqli_affected_rows($koneksi); 
}
?>