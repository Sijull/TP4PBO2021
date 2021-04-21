<?php

include("config.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

// Memanggil method getTask di kelas Task
$otask->getTask();

// Proses mengisi tabel dengan data
$data = null;
$no = 1;

while (list($id, $tnama, $tdetail, $ttipe, $tpriority, $tmasuk, $tstatus) = $otask->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	if($tstatus == "Terjual"){
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tnama . "</td>
		<td>" . $tdetail . "</td>
		<td>" . $ttipe . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tmasuk . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}

	// Tampilan jika status task nya belum dikerjakan
	else{
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tnama . "</td>
		<td>" . $tdetail . "</td>
		<td>" . $ttipe . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tmasuk . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' ><a href='index.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Selesai</a></button>
		</td>
		</tr>";
		$no++;
	}
}

// Menutup koneksi database
$otask->close();

if(isset($_POST['add'])){
	$tnama = $_POST['tnama'];
	$tdetail = $_POST['tdetail'];
	$ttipe = $_POST['ttipe'];
	$tmasuk = $_POST['tmasuk'];
	$tpriority = $_POST['tpriority'];

	$otask->open();
	$otask->addTask($tnama,$tdetail,$ttipe,$tpriority,$tmasuk);
	$otask->close();
    header("Location:index.php");
}

if(isset($_GET['id_hapus'])){
	$otask->open();
	$otask->deleteTask($_GET['id_hapus']);
	$otask->close();
    header("Location:index.php");
}

if(isset($_GET['id_status'])){
	$otask->open();
	$otask->updateStatus($_GET['id_status']);
	$otask->close();
    header("Location:index.php");
}

// Membaca template skin.html
$tpl = new Template("templates/skin.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();
?>