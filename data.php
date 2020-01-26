<?php 

$conn = mysqli_connect("localhost","root","","praktikumblog") or die(mysqli_error());

function tampil($conn, $tbname)
{
	$query = mysqli_query($conn, "SELECT * FROM $tbname");
	return $query;
}


function tampil_id($conn, $tbname, $id)
{
	$query = mysqli_query($conn, "SELECT * FROM $tbname WHERE id = '$id'");
	return $query;
}

function tambah($conn, $data)
{
	$id = time();
	$nm_tanaman = $data['nm_tanaman'];
	$hasil = $data['hasil'];
	$lama = $data['lama'];
	$tgl_panen = $data['tgl_panen'];
	$query = mysqli_query($conn, "INSERT INTO tabel_panen (id,nama_tanaman, hasil_panen, lama_tanam, tanggal_panen) VALUES(".$id.",'".$nm_tanaman."','".$hasil."','".$lama."','".$tgl_panen."')");
	return $query;
}

function update($conn, $data, $id)
{
		$nm_tanaman = $data['nm_tanaman'];
		$hasil = $data['hasil'];
		$lama = $data['lama'];
		$tgl_panen = $data['tgl_panen'];
	$perubahan = "nama_tanaman='".$nm_tanaman."',hasil_panen=".$hasil.",lama_tanam=".$lama.",tanggal_panen='".$tgl_panen."'";
	$update = mysqli_query($conn, "UPDATE tabel_panen SET ".$perubahan." WHERE id=$id");
	return $update;
}

function hapus($conn, $id)
{
	$query = mysqli_query($conn, "DELETE FROM tabel_panen WHERE id=" . $id);
	return $query;
}

 ?>