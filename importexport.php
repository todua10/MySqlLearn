<?php
	// Старт сессии для использования ID авторизованного пользователя
	session_start();
	// Проверка на загрузку файла для импорта
	if ($_FILES && $_FILES["myfile"]["error"]== UPLOAD_ERR_OK){
		$myFile = $_FILES['myfile'];
		$name = $myFile['name'];
		move_uploaded_file($myFile['tmp_name'], "C:/openserver/domains/MySqlLearn/uploadfiles/".$name);
	} else{
		header('Location: import.php');
		exit;
	}
	// Подключение БД
	require_once "db.php";
	// Класс импорта/экспорта
	class Import_Export{
        	private DBConn $conn;
		public int $num_of_add;
		public int $num_of_update;
		// Функция импорта
	        function import($filename, $authuserid): void
	        {
			$this->num_of_add = 0;
			$this->num_of_update = 0;
	            	$this->conn = new DBConn();
	            	$this->conn->connect('localhost', 'root', 'root', 'test');
	        	$productanduserid = $this->conn->mysql->query("SELECT `id`, `user_id` FROM `product`");
			$productanduserid = mysqli_fetch_all($productanduserid);
			$productid = array();
			$userid = array();
			for($i = 0; $i < count($productanduserid); $i++){
				array_push($productid, $productanduserid[$i][0]);
				array_push($userid, $productanduserid[$i][1]);
			}
			$file = fopen($filename, 'r');
			while (!feof($file)) {
				$str = fgetcsv($file, 1024, ";");
				if (in_array($str[0], $productid) && $userid[$str[0]-1]==$authuserid) {
					$this->conn->mysql->query("UPDATE 
								`product` 
								SET 
									`name`='$str[1]',
									`name_trans`='$str[2]',
									`price`='$str[3]',
									`small_text`='$str[4]',
									`big_text`='$str[5]',
									`user_id`='$authuserid' 
								WHERE id = '$str[0]'");
					$this->num_of_update++;
				} else if(in_array($str[0], $productid) && $userid[$str[0]-1]!=$authuserid){
					$this->conn->mysql->query("INSERT INTO
				                                   `product`
				                                           (`name`,
				                                            `name_trans`,
				                                            `price`,
				                                            `small_text`,
				                                            `big_text`,
				                                            `user_id`)
				                                   VALUES ('$str[1]',
				                                           '$str[2]',
				                                           '$str[3]',
				                                           '$str[4]',
				                                           '$str[5]',
				                                           '$authuserid')");
					$this->num_of_add++;
				}
				else{
					$this->conn->mysql->query("INSERT INTO
				                                   `product`
				                                           (`id`,
				                                            `name`,
				                                            `name_trans`,
				                                            `price`,
				                                            `small_text`,
				                                            `big_text`,
				                                            `user_id`)
				                                   VALUES ('$str[0]',
				                                           '$str[1]',
				                                           '$str[2]',
				                                           '$str[3]',
				                                           '$str[4]',
				                                           '$str[5]',
				                                           '$authuserid')");
					$this->num_of_add++;
				}
			}
	        	fclose($file);
	        	$this->conn->disconnect();
	        }
	        // Функция экспорта
	        function export($filename): void
	        {
	        	$this->conn = new DBConn();
			$this->conn->connect('localhost', 'root', 'root', 'test');
			$file = fopen($filename, 'w');
			$results = $this->conn->mysql->query("SELECT * FROM `product`");
			while ($row = mysqli_fetch_assoc($results)){
				fputcsv($file, $row,';');
			}
			fclose($file);
			$this->conn->disconnect();
	        }
   	}
   	// Создание экземпляра класса импорта/экспорта и импорт загруженного файла
    	$import = new Import_Export();
    	$import->import("uploadfiles/".$name, $_SESSION["ID"]);
    	//Закомментированная функция экспорта
    	//$import->export('dbincsv.csv');
?>
<script>
	alert("Импорт завершен. \nДобавлено <?=$import->num_of_add?>/обновлено <?=$import->num_of_update?>")
	window.location.href = 'import.php';
</script>