<?php 

class Task extends DB{
	
	// Mengambil data
	function getTask(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_stok";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function addTask($tnama,$tdetail,$ttipe,$tpriority,$tmasuk){
		$query = "INSERT INTO tb_stok(nama_td, detail_td, tipe_td, priority_td, masuk_td, status_td)VALUES('$tnama','$tdetail','$ttipe','$tpriority','$tmasuk','Tersedia')";
		$this->execute($query);
        //header("Location : index.php");
	}

	function deleteTask($id){
		$query = "DELETE FROM tb_stok WHERE id = {$id}";
		$this->execute($query);
        //header("Location : index.php");
	}

	function updateStatus($id){
		$query = "UPDATE tb_stok SET status_td = 'Terjual' WHERE id = {$id}";
		$this->execute($query);
        //header("Location : index.php");
	}
}



?>